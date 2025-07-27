<?php

namespace App\Http\Controllers\Main;

use Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\OnlineUser;

class MainController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function online()
    {
       $users =  OnlineUser::with('user')->paginate(10);
       //dd($users);
       $data = ['page'=>'online','content' => $users, 'page_title' => 'Online Users'];
       return view('main.online')->with($data);
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
