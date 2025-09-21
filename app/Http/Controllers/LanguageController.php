<?php

namespace App\Http\Controllers;

use App\Models\Sound;
use App\Models\language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $language;
    private $sound;

    public function __construct(Language $language, Sound $sound)
    {
        $this->language = $language;
        $this->sound = $sound;
    }
    
    public function index()
    {
        $all_languages = $this->language->get();
        return view('admin.language')->with('all_languages', $all_languages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required|max:20|unique:languages,language'
        ]);

        $this->language->language = $request->language;
        $this->language->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $language = $this->language->findOrFail($id);

        return view('admin.language-edit')->with('language', $language);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'language' => 'required|max:20|unique:languages,language'
        ]);

        $language = $this->language->findOrFail($id);
        $language->language = $request->language;
        $language->save();

        return redirect()->route('admin.language');
    }

    
    public function delete($id)
    {
        $this->language->destroy($id);

        return redirect()->back();
    }

    public function select(Request $request)
    {
        // バリデーション（存在チェックはlanguagesテーブルがある前提）
        $data = $request->validate([
            'language_id' => 'required|integer|exists:languages,id',
        ]);

        // セッションに保存（上書きされる）
        session(['language_id' => (int)$data['language_id']]);

        // 遷移先はカタカナのホームなど。必要ならwithでフラッシュメッセージ
        return redirect()->view('guest.starting');
    }
}
