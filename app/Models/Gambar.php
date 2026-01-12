<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $table = 'gambars';
    
    protected $fillable = [
        "path",
        "description",
        "content_id"  // TAMBAHAN: ini perlu ada di fillable
    ];

    public function content() 
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
    
    public function isiContent()
    {
        return $this->hasMany(IsiContent::class, 'gambar_id');
    }
}