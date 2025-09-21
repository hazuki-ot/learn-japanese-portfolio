<?php

use App\Models\Picture;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KanjiController;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HiraganaController;
use App\Http\Controllers\KatakanaController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\KanjiSoundController;
use App\Http\Controllers\HiraganaSoundController;
use App\Http\Controllers\KatakanaSoundController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

#guest
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/start', [SessionController::class, 'startSession'])->name('start.session');
Route::get('/starting',[HomeController::class, 'starting'])->name('starting');
Route::post('/end', [SessionController::class, 'endSession'])->name('end.session');


Route::group(['prefix' => 'pictures', 'as' => 'pictures.'], function(){
    Route::get('/home', [PictureController::class, 'home'])->name('home');
    Route::get('/show/{id}', [PictureController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'letter', 'as' => 'letter.'], function(){
    #hiragana
    Route::get('/hiragana/home', [HiraganaController::class, 'home'])->name('hiragana.home');
    Route::get('/hiragana/show/{id}', [HiraganaController::class, 'show'])->name('hiragana.show');
    #katakana
    Route::get('/katakana/home', [KatakanaController::class, 'home'])->name('katakana.home');
    Route::get('/katakana/show/{id}', [KatakanaController::class, 'show'])->name('katakana.show');
    #kanji
    Route::get('/kanji/home', [KanjiController::class, 'home'])->name('kanji.home');
    Route::get('/kanji/show/{category_id}', [KanjiController::class, 'show'])->name('kanji.show');
});


#admin
Route::group(["middleware" => "auth"], function(){

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
        Route::get('/home', [AdminController::class, 'index'])->name('home');

        #sound
        Route::get('/sound', [SoundController::class, 'index'])->name('sound');
        Route::post('/sound/create', [SoundController::class, 'store'])->name('sound.store');
        Route::get('/sound/search', [SoundController::class, 'search'])->name('sound.search');
        Route::delete('/sound/delete/{id}', [SoundController::class, 'delete'])->name('sound.delete');
        Route::get('sound/all',[SoundController::class, 'seeAll'])->name('sound.see-all');

        #sound in the modal
        Route::get('/sounds/search', [SoundController::class, 'searchByLanguage'])->name('sounds.search');
        Route::get('/sounds/search/kanji', [SoundController::class, 'searchForKanji'])->name('sounds.search.kanji');
        Route::post('/katakana-sounds/store', [KatakanaSoundController::class, 'store'])->name('katakana-sounds.store');
        Route::post('/hiragana-sounds/store', [HiraganaSoundController::class, 'store'])->name('hiragana-sounds.store');
        Route::post('/kanji-sounds/store', [KanjiSoundController::class, 'store'])->name('kanji-sounds.store');



        #picture
        Route::get('/pictures', [PictureController::class, 'index'])->name('pictures');
        Route::post('/pictures/create', [PictureController::class, 'store'])->name('pictures.store');
        Route::get('/pictures/search', [PictureController::class, 'search'])->name('pictures.search');
        Route::delete('/pictures/delete/{id}/{image}', [PictureController::class, 'delete'])->name('pictures.delete');

        #category
        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

        #language
        Route::get('/language', [LanguageController::class, 'index'])->name('language');
        Route::post('/language/create', [LanguageController::class, 'store'])->name('language.store');
        Route::get('/language/edit/{id}', [LanguageController::class, 'edit'])->name('language.edit');
        Route::patch('/language/update/{id}', [LanguageController::class, 'update'])->name('language.update');
        Route::delete('/language/delete/{id}', [LanguageController::class, 'delete'])->name('language.delete');

        #hiragana
        Route::get('/hiragana', [HiraganaController::class, 'index'])->name('hiragana');
        Route::post('/hiragana/create', [HiraganaController::class, 'store'])->name('hiragana.store');
        Route::get('/hiragana/search', [HiraganaController::class, 'search'])->name('hiragana.search');
        Route::delete('/hiragana/delete/{id}', [HiraganaController::class, 'delete'])->name('hiragana.delete');

        #katakana
        Route::get('/katakana', [KatakanaController::class, 'index'])->name('katakana');
        Route::post('/katakana/create', [KatakanaController::class, 'store'])->name('katakana.store');
        Route::get('/katakana/search', [KatakanaController::class, 'search'])->name('katakana.search');
        Route::delete('/katakana/delete/{id}', [KatakanaController::class, 'delete'])->name('katakana.delete');

        #kanji
        Route::get('/kanji', [KanjiController::class, 'index'])->name('kanji');
        Route::post('/kanji/create', [KanjiController::class, 'store'])->name('kanji.store');
        Route::get('/kanji/search', [KanjiController::class, 'search'])->name('kanji.search');
        Route::delete('/kanji/delete/{id}', [KanjiController::class, 'delete'])->name('kanji.delete');
    });
});
