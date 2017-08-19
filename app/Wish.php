<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $table = "wish";

    protected $fillable = [
        'name', 'wish', 'image' ,'created_at','updated_at',
    ];
}
