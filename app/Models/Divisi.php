<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $fillable = ['name', 'slug'];
    protected $table = 'divisis';

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function members()
    {
        return $this->hasMany(OrganizationalStructure::class);
    }

    public function structures()
    {
        return $this->hasMany(OrganizationalStructure::class, 'divisi_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blogs::class);
    }
    public function logoBidang()
    {
        return $this->hasOne(AboutDivisionLogo::class, 'divisi_id');
    }
}
