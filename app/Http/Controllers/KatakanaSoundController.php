<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KatakanaSound;

class KatakanaSoundController extends Controller
{

    private $katakanasound;

    public function __construct(KatakanaSound $katakanasound)
    {
        $this->katakanasound = $katakanasound;
    }
    
     public function store(Request $request)
    {
         $data = $request->validate([
            'katakana_id' => 'required|integer|exists:katakanas,id',
            'sound_id'    => 'required|integer|exists:sounds,id',
        ]);

        // すでに同じ組み合わせがあるかチェックし、なければ作成
        $record = KatakanaSound::firstOrCreate([
            'katakana_id' => $data['katakana_id'],
            'sound_id'    => $data['sound_id'],
        ]);

        return response()->json(['success' => (bool) $record]);

    }
}
