<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = [
        'name', 'wish', 'created_at','updated_at',
    ];
}
