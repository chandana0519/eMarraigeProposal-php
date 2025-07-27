<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileVisitor extends Model 
{
       
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profilevisitors';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','fromuser_id','touser_id','fromuser_status','touser_status','is_new'];

    /**
     * Get the sender.
     */
    public function fromUser()
    {
        return $this->belongsTo('App\User','fromuser_id');
    }

    /**
     * Get the receiver.
     */
    public function toUser()
    {
        return $this->belongsTo('App\User','touser_id');
    }

    /**
     * Get the receiver.
     */
    public function receivedAt()
    {
        $days = $this->created_at->diffInDays()<=7?$this->created_at->diffForHumans():$this->created_at;        
        return $days;
    }    
    
}