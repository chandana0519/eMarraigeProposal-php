<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineUser extends Model 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'onlineusers';
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the user that online.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}