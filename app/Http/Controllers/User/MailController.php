<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use URL;
//use App\User;
use App\Message; 
use App\Mailers\AppMailer;
use common;

class MailController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inbox(Request $request)
    {
        $inbox =  Message::where('touser_id', Auth::user()->id)
                ->where('touser_status', 0)
                ->orderBy('id', 'desc')->paginate(5);
        $request->session()->put('parent-url', 'inbox');
        return view('user.inbox',['page'=>'inbox','content' => $inbox,'page_title' => 'Message Inbox']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sent(Request $request)
    {
        $sent =  Message::where('fromuser_id', Auth::user()->id)
                ->where('fromuser_status', 0)
                ->paginate(5);
        $request->session()->put('parent-url', 'sent');
        return view('user.sent',['page'=>'sent','content' => $sent,'page_title' => 'Sent Messages']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        /*
        $trash =  Message::where(function($query) {
                        $query->where('fromuser_id', Auth::user()->id)
                          ->where('fromuser_status', 1);
                    })->orWhere(function($query) {
                        $query->where('touser_id', Auth::user()->id)
                          ->where('touser_status', 1);
                })
                ->orderBy('id', 'desc')->paginate(5);
        */
        $trash =  Message::where('touser_status', 1)
                ->orderBy('id', 'desc')->paginate(5);
        $request->session()->put('parent-url', 'trash');
        return view('user.trash',['page'=>'trash','content' => $trash,'page_title' => 'Deleted Messages']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function newMail(Request $request, AppMailer $mailer)
    {
        if($request->ajax())
        {
            $user = Auth::user();
            $input = $request->only('txtSendMailSubject','txtSendMailBody','hdnSendMailToId','hdnSendMailToName');
            $mail = new Message;
            $mail->fromuser_id = $user->id;
            $mail->fromuser_name = $user->username;
            $mail->touser_id = $input['hdnSendMailToId'];
            $mail->touser_name = $input['hdnSendMailToName'];
            $mail->subject = $input['txtSendMailSubject'];
            $mail->body = $input['txtSendMailBody'];
            $mail->save();
            //$toUser = User::where('id',$mail->touser_id)->first();
            $mailer->sendNewMailAlert($user, $mail->touser_name);
            return response()->json([
                'success' => true,
                //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
                ]);
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function replyMail(Request $request, AppMailer $mailer)
    {
        if($request->ajax())
        {
            $user = Auth::user();
            $input = $request->only('txtReplyMailSubject','txtReplyMailBody','hdnReplyMailToId');
            $id=common::getDecrypt($input['hdnReplyMailToId']);
            $mail =  Message::find($id);
            $prevmesg = "\n\n"."On ".$mail->created_at.", ".$mail->fromuser_name." wrote :\n".$mail->body;
            $reply = new Message;
            $reply->fromuser_id = $user->id;
            $reply->fromuser_name = $user->username;
            $reply->touser_id = $mail->fromuser_id;
            $reply->touser_name = $mail->fromuser_name;
            $reply->subject = $input['txtReplyMailSubject'];
            $reply->body = $input['txtReplyMailBody'].$prevmesg;
            $reply->save();

            $mailer->sendNewReplyAlert($user, $mail->fromuser_name);

            return response()->json([
                'success' => true,
                //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
                ]);
        }        
    }

    public function readMail($id,Request $request)
    {
        $url = URL::previous();
        $page = '';
        /*
        if (ends_with($url, '/inbox') || str_contains($url, '/inbox/')){
            $page = 'inbox';            
        }else if (ends_with($url, '/message/sent') || str_contains($url, '/message/sent/')){
            $page = 'sent';            
        }else if (ends_with($url, '/message/trash') || str_contains($url, '/message/trash/')){
            $page = 'trash';            
        }*/
       $page = $request->session()->get('parent-url','inbox');
       $id = common::getDecrypt($id);
       Message::where('id',$id)->first()->update(['is_read' => 1]);
       $mail =  Message::where('id',$id)->with('fromUser')->first();
       if ($page=='inbox'){
            return view('user.readmail',['page'=>$page,'mail' =>  $mail]);
       }elseif ($page=='sent'){
            return view('user.readsent',['page'=>$page,'mail' =>  $mail]);
       }elseif ($page=='trash'){
            return view('user.readtrash',['page'=>$page,'mail' =>  $mail]);
       }else{
            return redirect('/inbox');
       }       
    }
    
    public function deleteMail($id)
    {
        $id = common::getDecrypt($id);
        Message::where('id',$id)->first()->update(['touser_status' => 1]);
        flash()->success('Message successfully deleted.');
        return redirect()->back();
    }

    public function deleteSentMail($id)
    {
        $id = common::getDecrypt($id);
        Message::where('id',$id)->first()->update(['fromuser_status' => 2]);
        flash()->success('Message successfully deleted.');
        return redirect()->back();
    }

    public function deleteTrashMail($id)
    {
        $id = common::getDecrypt($id);
        Message::where('id',$id)->first()->update(['touser_status' => 2]);
        flash()->success('Message permanently deleted.');
        return redirect()->back();
    }

    public function restoreMail($id)
    {
        $id = common::getDecrypt($id);
        Message::where('id',$id)->first()->update(['touser_status' => 0]);
        flash()->success('Message successfully move to inbox.');
        return redirect()->back();
    }
}
