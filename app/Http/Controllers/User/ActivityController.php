<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Interest; 
use App\Flavourite;
use App\ProfileVisitor;
use App\Mailers\AppMailer;
use common;

class ActivityController extends Controller
{
    /**
     * get all interest related to the logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInterests()
    {
        /*
        $activitylist =  Interest::where('touser_id', Auth::user()->id)                       
                ->with('fromUser')
                ->groupBy('fromuser_id')
                ->orderBy('id', 'desc')              
                ->first();
                dd($activitylist);
        */
        $activitylist =  Interest::whereIn('id', function ($sub) {
                    $sub->selectRaw('max(id)')
                       ->from('interests as t')
                       ->where('t.touser_id', Auth::user()->id)
                       ->groupBy('t.fromuser_id');
                    })
                ->with('fromUser')
                ->orderBy('id', 'desc')              
                ->paginate(10);
                
        return view('user.activitylist',['page'=>'interest','content' => $activitylist]);
    }

     /**
     * get all interest sent by logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sentInterests()
    {
        $activitylist = Interest::whereIn('id', function ($sub) {
                    $sub->selectRaw('max(id)')
                       ->from('interests as t')
                       ->where('t.fromuser_id', Auth::user()->id)
                       ->groupBy('t.touser_id');                    
                    })
                ->with('toUser')
                ->orderBy('id', 'desc')              
                ->paginate(10);             
        return view('user.activitysent',['page'=>'sentinterest','content' => $activitylist]);
    }

    /**
     * send interest by logged in user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function newInterest(Request $request)
    {
        if($request->ajax())
        {
            $user = Auth::user();
            $input = $request->only('toUser');
            $interest = new Interest;
            $interest->fromuser_id = $user->id;
            $interest->touser_id = $input['toUser'];
            $interest->save();

            $toUserName = $input['toUserName'];

            $mailer->sendNewInterestAlert($user, $toUserName);

            return response()->json([
                'success' => true,
                //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
                ]);
        }        
    }

    /**
     * get all flavourites related to the logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFlavourites()
    {
        /*
        $activitylist =  Interest::where('touser_id', Auth::user()->id)                       
                ->with('fromUser')
                ->groupBy('fromuser_id')
                ->orderBy('id', 'desc')              
                ->first();
                dd($activitylist);
        */
        $activitylist =  Flavourite::whereIn('id', function ($sub) {
                    $sub->selectRaw('max(id)')
                       ->from('flavourites as t')
                       ->where('t.touser_id', Auth::user()->id)
                       ->groupBy('t.fromuser_id');
                    })
                ->with('fromUser')
                ->orderBy('id', 'desc')              
                ->paginate(10);
                
        return view('user.activitylist',['page'=>'flavourites','content' => $activitylist]);
    }

     /**
     * get all flavourites sent by logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sentFlavourites()
    {
        $activitylist = Flavourite::whereIn('id', function ($sub) {
                    $sub->selectRaw('max(id)')
                       ->from('flavourites as t')
                       ->where('t.fromuser_id', Auth::user()->id)
                       ->groupBy('t.touser_id');                    
                    })
                ->with('toUser')
                ->orderBy('id', 'desc')              
                ->paginate(10);             
        return view('user.activitysent',['page'=>'sentflavourites','content' => $activitylist]);
    }

    /**
     * send flavourite by logged in user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function newFlavourite(Request $request)
    {
        if($request->ajax())
        {
            $user = Auth::user();
            $input = $request->only('toUser');
            $interest = new Flavourite;
            $interest->fromuser_id = $user->id;
            $interest->touser_id = $input['toUser'];
            $interest->save();

            return response()->json([
                'success' => true,
                //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
                ]);
        }        
    }

     /**
     * get all profile visitors of the logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProfileVisitor()
    {
        /*
        $activitylist =  Interest::where('touser_id', Auth::user()->id)                       
                ->with('fromUser')
                ->groupBy('fromuser_id')
                ->orderBy('id', 'desc')              
                ->first();
                dd($activitylist);
        */
        $activitylist =  ProfileVisitor::whereIn('id', function ($sub) {
                    $sub->selectRaw('max(id)')
                       ->from('profilevisitors as t')
                       ->where('t.touser_id', Auth::user()->id)
                       ->groupBy('t.fromuser_id');
                    })
                ->with('fromUser')
                ->orderBy('id', 'desc')              
                ->paginate(10);
                
        return view('user.activitylist',['page'=>'visitors','content' => $activitylist]);
    }

}
