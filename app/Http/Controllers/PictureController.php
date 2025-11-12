<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    private $picture;
    private $category;
    const IMAGES_FOLDER = 'images/';

    public function __construct(Picture $picture, Category $category)
    {
        $this->picture = $picture;
        $this->category = $category;
    }

    public function index()  //go to pictures page of admin
    {
        $pictures_count = $this->picture->count();
        $categories = $this->category->get();
        return view('admin.a-pictures')->with('categories', $categories)
                                       ->with('pictures_count', $pictures_count);
    }

    public function store(Request $request) //form data from admin pictures
    {
        $request->validate([
            'image'    => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'name'     => 'required|unique:pictures,name|max:20',
            'category' => 'required',
            // 'sound'    => 'required|file|mimes:mp3,wav,ogg|max:20480', 
        ]);

        $this->picture->image       = $this->saveImage($request->image);
                                            //image name of $request->image
        $this->picture->name        = $request->name;
        // $this->picture->sound       = 'data:audio/' . $request->sound->extension() . ';base64,' . base64_encode(file_get_contents($request->sound));
       
        $this->picture->category_id = $request->category;

        $this->picture->save();

        return redirect()->back();
    }

    public function saveImage($image)
    {
        //renaming the image file. ex:1345876.jpg
        //           1345876  .           jpg
        $image_name = time().'.'.$image->extension();

        //saved image location: [saving inside laravel project]
        //images/1345876.jpg
        $image->storeAs('images/',$image_name);

        //return the file name 1345876.jpg
        //we need to save the file name in the database
        return $image_name;
    }

    public function delete($id, $image)
    {
        $image_path = self::IMAGES_FOLDER . $image;

        if(Storage::disk('public')->exists($image_path)){
           Storage::disk('public')->delete($image_path);
        }

        $id = $this->picture->findOrFail($id);
        $id->delete();

        return redirect()->route('admin.pictures');
    }

    public function home() //guest page, picteres home, chose learn category
    {
        $categories = $this->category->get();

        return view('guest.picture.pictures')->with('categories', $categories);
    }

    public function show($id) //show all pictures chosen category
    {
        $category = $this->category->findOrFail($id);
    //id of category

        return view('guest.picture.pictures-show')->with('category', $category);
    }

    public function search(Request $request)
    {
        $pictures = $this->picture->where('name', 'like', '%' . $request->search . '%')->paginate(10);

        return view('admin.search-result')->with('pictures', $pictures)
                                          ->with('search', $request->search);
    }

}
