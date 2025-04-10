<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class BlogController extends Controller
{

    public function index()
    {   

        $blogs = Blog::all()->toArray();
        
        return view('blogs', ['blogs'=> $blogs]);
    }


}
