<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiraganaSound extends Model
{
    protected $table = 'hiragana_sound';
    protected $fillable = ['hiragana_id', 'sound_id'];
    public $timestamps = false;

    public function hiragana()
    {
        return $this->belongsTo(Hiragana::class);
    }

    public function sound() 
    {
        return $this->belongsTo(Sound::class);
    }
}
