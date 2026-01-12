<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsiContent extends Model
{
    protected $table = 'isi_contents';
    
    protected $fillable = [
        "nomor",
        "subjudul",
        "isi",
        "gambar_id",
        "content_id"
    ];

    public function gambar()
    {
        return $this->belongsTo(Gambar::class, 'gambar_id');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
