<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function hiragana()
    {
        return $this->hasMany(Hiragana::class);
    }

    public function katakana()
    {
        return $this->hasMany(Katakana::class);
    }

    public function kanji()
    {
        return $this->hasMany(Kanji::class);
    }
}
