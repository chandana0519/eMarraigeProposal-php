<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Mailers\AppMailer;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'username';
    protected $loginPath = '/';
    protected $redirectPath = '/test';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    { 
        $messages = [
            'dob.required' => 'The date of birth field is required..',
            'country.min' => 'Please select your country.',
            'sex.min' => 'Please select your Gender.',
        ];
        $validator = Validator::make($data, [
            'username' => 'required|min:4|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:4',
            'dob' => 'required',
            'sex' => 'required|integer|min:1',
            'country' => 'required|integer|min:1',
        ],$messages);
        //'country' => 'required|numeric|min:1',
        if ($validator->fails())
        {
            $validator->errors()->add('RegValidator', 'RegValidator');
        };
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $arrCountry = config('constants.country');
        $arrSex = config('constants.sex');
        
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'pswdhash' => $data['password'],
            'dateofbirth' => $data['dob'],
            'sex_id' => $data['sex'],
            'sex' => array_pull($arrSex, $data['sex']),
            'country_id' => $data['country'],
            'country' => array_pull($arrCountry, $data['country']),
            'token' => str_random(15),
        ]);
    }
   
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        //$this->validate($request, [
        //    $this->loginUsername() => 'required|email', 'password' => 'required',
        //]);

        $validator = Validator::make($request->request->all(),  [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]); 
         if ($validator->fails()){
            return redirect($this->loginPath())
                       ->withInput($request->only($this->loginUsername(), 'remember'))
                       ->withErrors([
                           'errorMesg' => 'User Name and Password is required.','LoginValidator'=>'LoginValidator',
                       ]);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                'errorMesg' => $this->getFailedLoginMessage(),'LoginValidator'=>'LoginValidator',
            ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request, AppMailer $mailer)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));

        $user = Auth::user();
        $mailer->sendEmailConfirmationTo($user);
        
        return redirect($this->redirectPath());
    }

}
