<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model 
{
       
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profileimages';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','name','is_private'];
    
    /**
     * Get the user that online.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}