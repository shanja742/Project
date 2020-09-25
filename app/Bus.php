<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $guarded = [];
    public function seats(){
        return $this->hasMany('App\Seat');
    }
}
