<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'city';

    /**
     * Whether or not to enable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the state that belongs the city. An inverse one-to-one relationship.
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

}