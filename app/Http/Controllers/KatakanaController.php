<?php

namespace App\Http\Controllers;

use App\Models\Sound;
use App\Models\Category;
use App\Models\Katakana;
use App\Models\Language;
use Illuminate\Http\Request;

class KatakanaController extends Controller
{
    private $katakana;
    private $category;
    private $language;
    private $sound;

    public function __construct(Katakana $katakana, Category $category, Language $language, Sound $sound)
    {
        $this->katakana = $katakana;
        $this->category = $category;
        $this->language = $language;
        $this->sound    = $sound;
    }
    
    public function index()
    {
        $words_count = $this->katakana->count();
        $categories = $this->category->get();
        return view('admin.a-katakana')->with('categories', $categories)
                                       ->with('words_count', $words_count);
    }

    public function home()
    {
        $categories = $this->category->get();
        
        return view('guest.letter.katakana')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'katakana' => 'required|max:20|unique:katakanas,word',
            'category' => 'required'
        ]);

        $this->katakana->word = $request->katakana;
        $this->katakana->category_id = $request->category;

        $this->katakana->save();

        return redirect()->back();
    }

    public function show($id) //show all words chosen category
    {
        $category = $this->category->findOrFail($id);
    //id of category

        return view('guest.letter.katakana-show')->with('category', $category);
    }

    public function search(Request $request)
    {
        $katakanas = $this->katakana->where('word', 'like', '%' . $request->search . '%')->paginate(20);
        $languages = $this->language->get();
        $all_sounds = $this->sound->get();

        return view('admin.search-result')->with('katakanas', $katakanas)
                                          ->with('search', $request->search)
                                          ->with('languages', $languages)
                                          ->with('all_sounds', $all_sounds);
    }

    public function delete($id)
    {
        $this->katakana->destroy($id);

        return redirect()->route('admin.katakana');
    }

}
