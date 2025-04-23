<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function allBlogs()
    {

        $blogs = Blog::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->get();

        $blogs->each(function ($blog) {

            if ($blog->image) {
                $blog->image_base64 = base64_encode($blog->image);
            }
        });

        return view('all-blogs', compact('blogs'));
    }

    public function myBlogs()
    {

        $blogs = Auth::user()->blogs()->get();

        $blogs->each(function ($blog) {

            $blog->publisher = Auth::user()->name;

            if ($blog->image) {
                $blog->image_base64 = base64_encode($blog->image);
            }
        });

        return view('my-blogs', compact('blogs'));
    }

    public function showBlog($id)
    {
        $blog = Blog::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->find($id);

        if ($blog && $blog->image) {
            $blog->image_base64 = base64_encode($blog->image);
        }


        return view('show-blog', compact('blog'));
    }
}
