<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Owner extends Model
{
    protected $table = 'owners';
    protected $fillable = ['email', 'photo', 'name', 'phone', 'password','is_active'];
    protected $hidden = ['password'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($owner) {
            if ($owner->photo) {
                Storage::disk('public')->delete($owner->photo); // Delete the photo from storage
            }
        });
    }

}
