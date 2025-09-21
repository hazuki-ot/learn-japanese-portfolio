<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
       $this->user = $user; 
    }

    public function index()
    {
        return view('admin.admin-home');
    }


    
}
