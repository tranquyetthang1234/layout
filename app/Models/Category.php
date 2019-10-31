<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
