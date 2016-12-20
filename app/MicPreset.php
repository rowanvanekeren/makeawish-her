<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MicPreset extends Model
{
    protected $table = "mic_presets";

    protected $fillable = [
        'name', 'max', 'created_at','updated_at',
    ];
}
