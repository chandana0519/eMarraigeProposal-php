<?php

namespace App\Http\Controllers\User;

use URL;
use Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\User;
use App\Message; 
use App\Interest; 
use App\Flavourite;
use App\ProfileVisitor;
use App\Country;
use App\State;
use App\City;
use App\Mailers\AppMailer;

class UserController extends Controller
{
    public function index() {
        $data['tasks'] = [
                [
                        'name' => 'Design New Dashboard',
                        'progress' => '87',
                        'color' => 'danger'
                ],
                [
                        'name' => 'Create Home Page',
                        'progress' => '76',
                        'color' => 'warning'
                ],
                [
                        'name' => 'Some Other Task',
                        'progress' => '32',
                        'color' => 'success'
                ],
                [
                        'name' => 'Start Building Website',
                        'progress' => '56',
                        'color' => 'info'
                ],
                [
                        'name' => 'Develop an Awesome Algorithm',
                        'progress' => '10',
                        'color' => 'success'
                ]
        ];
        return view('test')->with($data);
    }

    public function confirmEmailAddress(){
        $user = Auth::user();
        $data = ['email'=>$user->email, 'page_title' => 'Email Confirmation'];
        return view('user.emailverification')->with($data);
    }

    public function verifyEmailAddress(Request $request){
        $user = Auth::user();
        $token = trim($request::input('verificationcode'));
        $data = ['email'=>$user->email, 'page_title' => 'Email Confirmation'];
        if ($user->token!=$token){
            flash()->warning('Invalid email Verification Code.');
            return view('user.emailverification')->with($data);
        }
        $user->confirmEmail();
        return view('user.activation')->with($data);        
    }

    public function getMyProfile() {
        $user = Auth::user();
        $state = $user->country_id>0?Country::find($user->country_id)->states->lists('name','id'):[];
        $city = $user->state_id>0?State::find($user->state_id)->cities->lists('name','id'):[];
        //flash()->info('Complete your profile to allow other user to see you.');
        return view('user.myprofile', ['page'=>'myprofile','profile' => $user,'state'=>$state,'city'=>$city]);
    }

    public function getProfile($id) {        
        $url = URL::previous();
        //dd($url);
        $page = '';
        if (ends_with($url, '/online') || str_contains($url, '/profile/')){
            $page = 'online';
        }else if (ends_with($url, '/interest') || str_contains($url, '/interest/')){
            $page = 'interest';
        }else if (ends_with($url, '/favourite') || str_contains($url, '/favourite/')){
            $page = 'flavourites';
        }else if (ends_with($url, '/visiror') || str_contains($url, '/visiror/')){
            $page = 'visitors';
        }
        $user = User::find($id);
        $state = $user->country_id>0?Country::find($user->country_id)->states->lists('name','id'):[];
        $city = $user->state_id>0?State::find($user->state_id)->cities->lists('name','id'):[];
        $visitor = new ProfileVisitor;
        $visitor->fromuser_id = $user->id;
        $visitor->touser_id = $id;
        $visitor->save();
        return view('user.profile', ['page'=>$page,'profile' => $user,'state'=>$state,'city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppMailer $mailer)
    {
        if(Request::ajax()){
            $arrConstants = config('constants');
            $usection = Request::input('usection'); 
            if($usection==1) {
                $input = Request::only('title','aboutme','maritalstatus','height','weight','bodytype','complexion','living','kids','smoking','drinking');
                $user = Auth::user();
                $user->title = $input['title'];
                $user->description = $input['aboutme'];
                $user->maritalstatus_id = $input['maritalstatus'];
                $user->maritalstatus = $this->getArrayValue($arrConstants, 'maritalstatus', $input['maritalstatus'], '');
                $user->height_id = $input['height'];
                $user->height = $this->getArrayValue($arrConstants, 'height', $input['height'], '');
                $user->weight_id = $input['weight'];
                $user->weight = $this->getArrayValue($arrConstants, 'weight', $input['weight'], '');
                $user->body_type = $this->getArrayValue($arrConstants, 'bodytype', $input['bodytype'], '');
                $user->appearance = $this->getArrayValue($arrConstants, 'complexion', $input['complexion'], '');
                $user->living_with = $this->getArrayValue($arrConstants, 'living', $input['living'], '');
                $user->kids_id = $input['kids'];
                $user->kids = $this->getArrayValue($arrConstants, 'kids', $input['kids'], '');
                $user->smoking_id = $input['smoking'];
                $user->smoking = $this->getArrayValue($arrConstants, 'smoking', $input['smoking'], '');
                $user->drinking_id = $input['drinking'];
                $user->drinking = $this->getArrayValue($arrConstants, 'drinking', $input['drinking'], '');            
                $user->save();
            } elseif($usection==2) {
                $input = Request::only('work','education');
                $user = Auth::user();
                $user->work_id = $input['work'];
                $user->work = $this->getArrayValue($arrConstants, 'work', $input['work'], '');
                $user->education_id = $input['education'];
                $user->education = $this->getArrayValue($arrConstants, 'education', $input['education'], '');
                $user->save();
            } elseif($usection==3) {
                $input = Request::only('country','state','city','residency');
                $user = Auth::user();
                $user->country_id = $input['country'];
                $user->country = $this->getArrayValue($arrConstants, 'country', $input['country'], '');
                $user->state_id = $input['state'];
                $user->state = $input['state']>0 ? State::find($input['state'])->name : '';
                $user->city_id = $input['city'];
                $user->city = $input['city']>0 ? City::find($input['city'])->name : '';
                $user->residency = $input['residency'];
                $user->save();
            } elseif($usection==4) {
                $input = Request::only('relationship','agepreference','minage','maxage');
                $user = Auth::user();
                $user->relationship_id = $input['relationship'];
                $user->relationship = $this->getArrayValue($arrConstants, 'relationship', $input['relationship'], '');
                $user->age_preference = $input['agepreference'];
                $user->age_min = $input['minage'];
                $user->age_max = $input['maxage'];
                $user->save();
            } elseif($usection==5) {
                $input = Request::only('email','dateofbirth');
                $user = Auth::user();                
                $newemail = $input['email'];
                if ($user->email!=$newemail){
                    $user->email = $newemail;
                    $user->token = str_random(15);
                    $user->email_verified = 0;
                    $mailer->resendEmailConfirmationToken($user);
                }                
                $user->dateofbirth = $input['dateofbirth'];
                $user->save();
            } elseif($usection==6) {
                $input = Request::only('CurrentPassword','NewPassword');
                $user = Auth::user();                
                $curentPassword = $input['CurrentPassword'];
                $newPassword = $input['NewPassword'];
                if ($user->pswdhash!=$curentPassword){
                    return Response::json([
                                'success' => false,
                                'message' => 'Current password does not match',
                            ]);
                }else{
                    $user->password = bcrypt($newPassword);
                    $user->pswdhash = $newPassword;
                    $user->save();
                    Auth::login($user);
                    return Response::json([
                                'success' => true,
                                'message' => 'Password successfully changed',
                            ]);
                }                
            }
        }        
        return Response::json([
            'success' => true,
            //'title' => $input['height'],
            //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
            ]);
        //return Auth::user();
    }

    public function resendToken(AppMailer $mailer){
        $user = Auth::user();
        $mailer->resendEmailConfirmationToken($user);
        flash()->success('Password confirmation token successfully sent.');
        return redirect()->back();
    }

    public function getNotificationCount() {
        $mailCount = Message::where('touser_id', Auth::user()->id)
                ->where('is_read',0)            
                ->count();
        $interestCount = Interest::where('touser_id', Auth::user()->id)
                ->where('is_new',1)            
                ->count();
        $flavouritesCount = Flavourite::where('touser_id', Auth::user()->id)
                ->where('is_new',1)            
                ->count();
        $visitorCount = ProfileVisitor::where('touser_id', Auth::user()->id)
                ->where('is_new',1)            
                ->count();
        return [
                'updated' => $mailCount>0 || $interestCount>0 || $flavouritesCount>0 || $visitorCount>0 ? true:false,
                'mailCount' => 0,
                'interestCount' => $interestCount,
                'flavouritesCount' => $flavouritesCount,
                'visitorCount' => $visitorCount,
            ];
    }

    private function getArrayValue($array, $constant, $value, $default)        
    {
        if(($value === NULL) || ($value == $default))
        {
            return '';
        }else{
            return array_get($array, $constant  . '.' . ($value));
        }        
    }
    
}
