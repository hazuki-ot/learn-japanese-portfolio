<?php

namespace App\Http\Controllers;

use App\Models\Kanji;
use App\Models\Sound;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class KanjiController extends Controller
{
    private $kanji;
    private $category;
    private $language;
    private $sound;

    public function __construct(Kanji $kanji, Category $category, Language $language, Sound $sound)
    {
        $this->kanji    = $kanji;
        $this->category = $category;
        $this->language = $language;
        $this->sound    = $sound;
    }
    
    public function index()
    {
        $words_count = $this->kanji->count();
        $categories = $this->category->get();
        return view('admin.a-kanji')->with('categories', $categories)
                                    ->with('words_count', $words_count);
    }

    public function home()
    {
        $categories = $this->category->get();

        return view('guest.letter.kanji')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kanji' => 'required|max:20|unique:kanjis,word',
            'read' => 'required|max:20|unique:kanjis,read',
            'category' => 'required'
        ]);

        $this->kanji->word = $request->kanji;
        $this->kanji->read = $request->read;
        $this->kanji->category_id = $request->category;

        $this->kanji->save();

        return redirect()->back();
    }

    public function show($category) //show all words chosen category
    {
        $words = $this->kanji->where('category_id', $category)->paginate(25);
    //id of category

        return view('guest.letter.kanji-show')->with('words', $words);
    }

    public function search(Request $request)
    {
        $kanjis = $this->kanji->where('word', 'like', '%' . $request->search . '%')->paginate(20);
        $languages = $this->language->get();
        $all_sounds = $this->sound->get();

        return view('admin.search-result')->with('kanjis', $kanjis)
                                          ->with('search', $request->search)
                                          ->with('languages', $languages)
                                          ->with('all_sounds', $all_sounds);
    }

    public function delete($id)
    {
        $this->kanji->destroy($id);

        return redirect()->route('admin.kanji');
    }
}
