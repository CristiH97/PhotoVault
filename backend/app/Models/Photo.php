<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;
    protected $fillable = ['album_id','uploader_id','uploader_name','filename','type','size','path'];
    //
    
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }
    protected static function booted(): void
    {
        static::deleting(function (Photo $photo) {
            Storage::delete($photo->path);
        });
    }

}
