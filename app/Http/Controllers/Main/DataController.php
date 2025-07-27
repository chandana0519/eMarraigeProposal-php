<?php

namespace App\Http\Controllers\Main;

use Request;
use Response;
use App\Http\Controllers\Controller;

use App\Country;
use App\State;

class DataController extends Controller
{
    public function getLocation()
    {
        $loctype = Request::input('loctype'); 
        $id = Request::input('id');         
        if(Request::ajax()){
            if($loctype==3) {
                $results = State::find($id)->cities->lists('name','id');                
                return $results;          
            }else if($loctype==2) {
                $results = Country::find($id)->states->lists('name','id'); 
                return $results;
            }else if($loctype==1) {
            }else{
            }
        }
        return Response::json([
                'success' => true,            
         ]);
    }
    
}
