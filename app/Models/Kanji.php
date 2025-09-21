<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kanji extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function kanjiSound()
    {
        return $this->hasMany(KanjiSound::class);
    }
}
