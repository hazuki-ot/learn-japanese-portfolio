<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KatakanaSound extends Model
{
    protected $table = 'katakana_sound';
    protected $fillable = ['katakana_id', 'sound_id'];
    public $timestamps = false;

    public function katakana()
    {
        return $this->belongsTo(Katakana::class);
    }

    public function sound() 
    {
        return $this->belongsTo(Sound::class);
    }
    
}
