<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    
    protected $fillable = [
        "judul",
        "slug",
        "user_id",
        "status"
    ];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gambar()
    {
        return $this->hasMany(Gambar::class, 'content_id');
    }

    public function isi()
    {
        return $this->hasMany(IsiContent::class, 'content_id');
    }
}