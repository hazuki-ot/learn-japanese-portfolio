<?php

namespace App\Http\Controllers;

use App\Models\Sound;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoundController extends Controller
{
    private $sound;
    private $language;
    const AUDIO_FOLDER = 'audio/';

    public function __construct(Sound $sound, Language $language)
    {
        $this->sound = $sound;
        $this->language = $language;
    }
    
    public function index() //go to sound page admin
    {
        $languages = $this->language->get();
        return view('admin.sound')->with('languages', $languages);
    }

     public function store(Request $request) //form data from admin sound
    {
        $request->validate([
            'name'     => 'required|max:20',
            'sound'    => 'required|file|mimes:mp3,wav,ogg|max:20480|unique:sounds,file_name',
            'language' => 'required', 
        ]);

        $file = $request->file('sound');

        //audio fileのfile名をそのまま使う
        $file_name = $file->getClientOriginalName();

        $file->storeAs('audio', $file_name, 'public');

        $this->sound->name = $request->name;
        $this->sound->file_name = $file_name;
        $this->sound->language_id = $request->language;

        $this->sound->save();

        return redirect()->back()->with('success', 'saving successfully');
        
    }

    public function search(Request $request)
    {
        $sounds = $this->sound->where('name', 'like', '%' . $request->search . '%')->paginate(20);

        return view('admin.search-result')->with('sounds', $sounds)
                                          ->with('search', $request->search);
    }

    // for katakana and hiragana
    public function searchByLanguage(Request $request)
    {
        $request->validate([
            'language_id' => 'required|integer',
            'word' => 'required|string',
        ]);

        $sounds = Sound::where('language_id', $request->language_id)
            ->where('name', $request->word)
            ->get(['id', 'file_name']);

        return response()->json($sounds);
    }

    // for kanji
    public function searchForKanji(Request $request)
    {
        $request->validate([
            'language_id' => 'required|integer',
            'read' => 'required|string',
        ]);

        $sounds = Sound::where('language_id', $request->language_id)
            ->where('name', $request->read)
            ->get(['id', 'file_name']);

        return response()->json($sounds);
    }

    public function delete($id)
    {
        $sound = $this->sound->findOrFail($id);

        $sound_path = self::AUDIO_FOLDER . $sound->file_name;

        if(Storage::disk('public')->exists($sound_path)){
           Storage::disk('public')->delete($sound_path);
        }

        $sound->delete();

        return redirect()->route('admin.sound');
    }

    public function seeAll()
    {
        $all_sounds = $this->sound->orderBy('name', 'asc')->paginate(12);

        return view('admin.sound-all')->with('all_sounds', $all_sounds);
    }


}
