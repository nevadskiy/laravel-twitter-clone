<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $posts = Post::latest()->get();
        return view('dashboard')->withPosts($posts);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:240'
        ]);
        $post = new Post;
        $post->body = $request->body;
        if ($request->user()->posts()->save($post)) {
            Session::flash('success', 'Post has been created');
        } else {
            Session::flash('error', 'There was an error');
        }
        return redirect()->route('dashboard');
    }

    public function destroy(Request $request, Post $post)
    {
        $this->authorize('destroy', $post);

        //the same like code above
        //if ($request->user()->cannot('destroy', $post))
        //{
        //  return redirect()->back()->with('warning', 'you cant do this!');
        //}

        if ($post->delete()) {
            Session::flash('info', 'Post has been deleted');
        } else {
            Session::flash('error', 'There was an error');
        }
        return redirect()->back();
    }
}
