<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hiragana;
use App\Models\Language;
use App\Models\Sound;
use Illuminate\Http\Request;

class HiraganaController extends Controller
{
    private $hiragana;
    private $category;
    private $language;
    private $sound;

    public function __construct(Hiragana $hiragana, Category $category, Language $language, Sound $sound)
    {
        $this->hiragana = $hiragana;
        $this->category = $category;
        $this->language = $language;
        $this->sound    = $sound;
    }
    
    public function index() //admin page of hiragana
    {
        $words_count = $this->hiragana->count();
        $categories = $this->category->get();
        return view('admin.a-hiragana')->with('categories', $categories)
                                       ->with('words_count', $words_count);
    }

    public function home() //guest home page of hiragana
    {
        $categories = $this->category->get();
        
        return view('guest.letter.hiragana')->with('categories', $categories);
    }

    public function store(Request $request) //form data from a-hiragana page
    {
        $request->validate([
            'hiragana' => 'required|max:20|unique:hiraganas,word',
            'category' => 'required'
        ]);

        $this->hiragana->word = $request->hiragana;
        $this->hiragana->category_id = $request->category;

        $this->hiragana->save();

        return redirect()->back();
    }

    
    public function show($id) //show all words chosen category
    {
        $category = $this->category->findOrFail($id);
        // $language = $language_id;
    //id of category

        return view('guest.letter.hiragana-show')->with('category', $category);
    }

    
    public function search(Request $request)
    {
        $hiraganas = $this->hiragana->where('word', 'like', '%' . $request->search . '%')->paginate(20);
        $languages = $this->language->get();
        $all_sounds = $this->sound->get();

        return view('admin.search-result')->with('hiraganas', $hiraganas)
                                          ->with('search', $request->search)
                                          ->with('languages', $languages)
                                          ->with('all_sounds', $all_sounds);;

    }

    public function delete($id)
    {
        $this->hiragana->destroy($id);

        return redirect()->route('admin.hiragana');
    }

}
