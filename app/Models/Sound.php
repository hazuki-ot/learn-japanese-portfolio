<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    protected $fillable = ['name', 'file_name', 'language_id'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function katakanaSound()
    {
        return $this->hasMany(KatakanaSound::class);
    }

    public function hiraganaSound()
    {
        return $this->hasMany(HiraganaSound::class);
    }

    public function kanjiSound()
    {
        return $this->hasMany(KanjiSound::class);
    }
}
