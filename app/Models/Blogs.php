<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blogs extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'divisi_id',
        'category_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });

        static::updating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
