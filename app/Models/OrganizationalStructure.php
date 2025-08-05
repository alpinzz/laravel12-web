<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationalStructure extends Model
{
    protected $fillable = ['name', 'image', 'position', 'divisi_id', 'order'];

    public function division()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
