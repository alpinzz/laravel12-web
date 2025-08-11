<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutVisionMision extends Model
{
    protected $table = 'about_vision_misions';

    protected $fillable = [
        'vision',
        'missions',
        'image'
    ];

    protected $casts = [
        'missions' => 'array',
    ];
}
