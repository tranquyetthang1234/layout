<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table= "post";

    public function categoryPost()
    {
        return $this->belongsTo('App\Models\categoryPost', 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\categoryPost', 'category_id', 'id');
    }
}
