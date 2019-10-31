<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = "category_post";

    public function posts()
    {
        return $this->hasMany('App\Post', 'category_id', 'id');
    }
}
