<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
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

    public function createBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4194304',
        ]);

        $blog = new Blog();
        $blog->title = $request->get('title');
        $blog->content = $request->get('content');
        $blog->category = $request->get('category');
        $blog->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $blog->image = file_get_contents($image->getRealPath());
        }

        $blog->save();

        return redirect('blogs/myblogs')->with('success_create', '¡Blog created successfully!');
    }

    public function editBlog($id)
    {
        $blog = Blog::find($id);

        if ($blog->image) {
            $blog->image_base64 = base64_encode($blog->image);
        }

        return view('edit-blog', compact('blog'));
    }

    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4194304',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->get('title');
        $blog->content = $request->get('content');
        $blog->category = $request->get('category');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $blog->image = file_get_contents($image->getRealPath());
        } else {
            $blog->image = null;
        }

        $blog->save();

        return redirect('blogs/myblogs')->with('success_update', '¡Blog edited successfully!');
    }
}
