<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoProfile extends Model
{
    protected $fillable = ['yt_url'];

    public function getEmbedUrlAttribute()
    {
        $url = $this->yt_url;


        if (preg_match('/youtu\.be\/([^\?&]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }


        if (preg_match('/youtube\.com.*v=([^\?&]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
