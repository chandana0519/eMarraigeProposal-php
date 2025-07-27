<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model 
{
       
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','fromuser_id','fromuser_name','touser_id','touser_name','subject','body','attachment','fromuser_status','touser_status','is_read'];

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
        $days = $this->created_at->diffInDays()<=7?$this->created_at->diffForHumans():$this->created_at->format('Y-m-d');        
        return $days;
    } 

    /**
     * Get the received time by period.
     */
    public function receivedTime()
    {
        $days = $this->created_at->diffForHumans();
        return $days;
    }    
    
}