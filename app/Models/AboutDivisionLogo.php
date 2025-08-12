<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutDivisionLogo extends Model
{
    protected $fillable = [
        'logo',
        'divisi_id'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
