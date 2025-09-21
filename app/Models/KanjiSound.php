<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanjiSound extends Model
{
    protected $table = 'kanji_sound';
    protected $fillable = ['kanji_id', 'sound_id'];
    public $timestamps = false;

    public function kanji()
    {
        return $this->belongsTo(Kanji::class);
    }

    public function sound() 
    {
        return $this->belongsTo(Sound::class);
    }
}
