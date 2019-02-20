<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public static function findOrFail(int $id)
    {
    }

    public static function findOrFall(int $id)
    {
    }
}
