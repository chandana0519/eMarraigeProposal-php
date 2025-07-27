<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'state';

    /**
     * Whether or not to enable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the cities for the state. a one-to-many relationship.
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }

    /**
     * Get the country that belongs the state. An inverse one-to-one relationship.
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

}