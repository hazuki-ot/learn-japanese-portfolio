<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['name', 'image', 'sound'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
