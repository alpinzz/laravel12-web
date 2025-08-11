<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutVisionMision extends Model
{
    protected $table = 'about_vision_mision';

    protected $fillable = [
        'vision',
        'mission'
    ];
}
