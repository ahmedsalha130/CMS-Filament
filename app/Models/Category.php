<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name_ar',
        'name_en',
        'parent_id',
        'image',
        'is_active',
    ];
    protected $table = 'categories';
    protected $hidden = ['created_at', 'updated_at'];


    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');

    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }


}
