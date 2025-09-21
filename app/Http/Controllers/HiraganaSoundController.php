<?php

namespace App\Http\Controllers;

use App\Models\Hiragana;
use Illuminate\Http\Request;
use App\Models\HiraganaSound;

class HiraganaSoundController extends Controller
{
    private $hiraganasound;

    public function __construct(HiraganaSound $hiraganasound)
    {
        $this->hiraganasound = $hiraganasound;
    }
    
     public function store(Request $request)
    {
         $data = $request->validate([
            'hiragana_id' => 'required|integer|exists:hiraganas,id',
            'sound_id'    => 'required|integer|exists:sounds,id',
        ]);

        // すでに同じ組み合わせがあるかチェックし、なければ作成
        $record = HiraganaSound::firstOrCreate([
            'hiragana_id' => $data['hiragana_id'],
            'sound_id'    => $data['sound_id'],
        ]);

        return response()->json(['success' => (bool) $record]);

    }
}
