<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Katakana extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function katakanaSound()
    {
        return $this->hasMany(KatakanaSound::class);
    }
}
