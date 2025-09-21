<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }
    
    
    public function index()
    {
        $languages = $this->language->get();

        return view('guest.home')->with('languages', $languages);
    }

    public function starting()
    {
        return view('guest.starting');
    }
}
