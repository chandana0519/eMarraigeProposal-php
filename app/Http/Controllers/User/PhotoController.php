<?php

namespace App\Http\Controllers\User;

use Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\ProfileImage;
use Image;

class PhotoController extends Controller
{
   
    public function profilePicture() {
        if(Request::ajax()){
            $user = Auth::user();
            $input = Request::only('profileimage','x','y','w','h');
            $profileimage=$input['profileimage'];            
            $img = Image::make($profileimage->getRealPath());
            $x = $input['x'];
            $y = $input['y'];
            $w = $input['w'];
            $h = $input['h'];
            $r = $img->width() >  $img->height() ? 200/$img->width() : 200/$img->height();
            $filename =  $user->id . '.' . $profileimage->getClientOriginalExtension();
            $path = public_path('p/' . $filename);
            $img->crop(round($w/$r), round($h/$r), round($x/$r), round($y/$r))->resize(100, 100)->save($path);
            $user->profileimage = $filename;
            $user->save();
            return Response::json([
            'success' => true,
            'size' => Image::make($profileimage->getRealPath())->resize(100, 100),
            //'' =>  $file,
            'x' => $input['x'],
            'y' => $input['y'],
            'w' => $input['w'],
            'h' => $input['h'],
            //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
            ]);
        }
        return Response::json([
        'success' => true,
        //'title' => $input['height'],
        //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        if(Request::ajax()){
            $user = Auth::user();

            //$file = $_FILES['file'];
            //$pic = Image::make($file['tmp_name']);
            //$filename =  $user->id . '.' . 'jpg';
            //$path = public_path('p/' . $filename);
            //$pic->resize(100, 100)->save($path);

            $input = Request::only('file');
            $pic=$input['file'];  
            ini_set('memory_limit', '256M');
            $img = Image::make($pic->getRealPath());
            ini_set('memory_limit', '128M');
            $filename =  uniqid($user->id.'-') . '.' . $pic->getClientOriginalExtension();
            $path = public_path('p/' . $filename);
            if($img->width()>$img->height()){
                $img->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();                    
                })->save($path, 50);                
            }else{
                 $img->resize(null, 500, function ($constraint) {
                    $constraint->aspectRatio();                    
                })->save($path, 50);
            }
            $profileimage = new ProfileImage;
            $profileimage->name = $filename;
            $user->Images()->save($profileimage);
            $user->load('Images');           
            return Response::json([
                'success' => true,
                //'title' => $input['height'],
                //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
                ]);
        }
        return Response::json([
        'success' => true,
        //'title' => $input['height'],
        //'maritalstatus' => $this->getArrayValue($arrConstants, 'height', $input['height'], ''),
        ]);
        
    }

    private function getArrayValue($array, $constant, $value, $default)        
    {
             
    }
    
}
