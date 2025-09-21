<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hiragana extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hiraganaSound()
    {
        return $this->hasMany(HiraganaSound::class);
    }
}
