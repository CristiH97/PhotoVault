<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Album extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumFactory> */
    use HasFactory;
    protected $fillable = ['owner_id','title'];
    //
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function sharedUsers()
    {
        return $this->belongsToMany(User::class, 'album_users')->withTimestamps();
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
