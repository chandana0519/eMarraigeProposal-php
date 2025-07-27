<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/email', function () {
	Mail::send('email.emailverification',['link'=>'www.emarriageproposal.com','username'=>'chandana','token'=>'f8923hsdf'],function($message){
    	$message->to('chandana.mirihane@gmail.com','Test User')->subject('eMarriageProposal Registration');
    });    
});

Route::get('/emailtest', function () {
    $data = ['link' => 'www.emarriageproposal.com'];
	Mail::send('email.emailverification', $data, function($m){
	   $m->to('d_kithmini@yahoo.com.au', 'Deepthi Wettasinghe');
	   $m->subject('Welcome!!');
	});
});


Route::get('/login', function () {
    return view('index');
});

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Authentication routes...
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/', 'Auth\AuthController@postLogin');

Route::group(['middleware' => 'auth'], function () {
	Route::get('logout', 'Auth\AuthController@getLogout');
	Route::get('/test', 'TestController@index');
	Route::get('/verifyEmail', 'User\UserController@confirmEmailAddress');
	Route::post('/verifyEmail', 'User\UserController@verifyEmailAddress');
	Route::get('/myprofile', 'User\UserController@getMyProfile');
	Route::get('/resendverification', 'User\UserController@resendToken');
	Route::post('/update', 'User\UserController@update');
	//user routes
	Route::group(['middleware' => 'hasAccess'], function () {
		Route::get('/profile/{id}', 'User\UserController@getProfile');
		Route::post('/photo/profile', 'User\PhotoController@profilePicture');
		Route::post('/photo/upload', 'User\PhotoController@upload');
		Route::get('/inbox', 'User\MailController@inbox');
		Route::get('/message/sent', 'User\MailController@sent');
		Route::get('/message/trash', 'User\MailController@trash');
		Route::post('/message/new', 'User\MailController@newMail');
		Route::get('/message/read/{id}', 'User\MailController@readMail');
		Route::post('/message/reply', 'User\MailController@replyMail');
		Route::get('/message/delete/{id}', 'User\MailController@deleteMail');
		Route::get('/message/sent/delete/{id}', 'User\MailController@deleteSentMail');
		Route::get('/message/restore/{id}', 'User\MailController@restoreMail');
		Route::get('/message/trash/delete/{id}', 'User\MailController@deleteTrashMail');
		Route::get('/interest', 'User\ActivityController@getInterests');
		Route::post('/interest', 'User\ActivityController@newInterest');
		Route::get('/favourite', 'User\ActivityController@getFlavourites');
		Route::post('/favourite', 'User\ActivityController@newFlavourite');
		Route::get('/visiror', 'User\ActivityController@getProfileVisitor');

		//Main routes
		Route::get('/online', 'Main\MainController@online');
		Route::post('/location', 'Main\DataController@getLocation');
	});	
});