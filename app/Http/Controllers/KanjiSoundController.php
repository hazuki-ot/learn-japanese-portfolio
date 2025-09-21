<?php

namespace App\Http\Controllers;

use App\Models\KanjiSound;
use Illuminate\Http\Request;

class KanjiSoundController extends Controller
{
    private $kanjisound;

    public function __construct(KanjiSound $kanjisound)
    {
        $this->kanjisound = $kanjisound;
    }
    
     public function store(Request $request)
    {
         $data = $request->validate([
            'kanji_id' => 'required|integer|exists:kanjis,id',
            'sound_id' => 'required|integer|exists:sounds,id',
        ]);

        // すでに同じ組み合わせがあるかチェックし、なければ作成
        $record = KanjiSound::firstOrCreate([
            'kanji_id' => $data['kanji_id'],
            'sound_id'    => $data['sound_id'],
        ]);

        return response()->json(['success' => (bool) $record]);

    }
}
