<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Techinfo extends Model
{
    public function techs(){
        return $this->belongsToMany('App\Tech');
    }
}
