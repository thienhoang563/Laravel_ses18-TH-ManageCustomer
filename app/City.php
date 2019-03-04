<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public static function findOrFail($id)
    {
    }

    public function customers(){
        return $this->hasMany('App\Customer');
    }
}
