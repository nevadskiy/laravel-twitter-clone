<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Like;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $posts = Post::latest()->get();
//        $posts = Post::latest()->with([
//            'likes' => function($query) {
//                return $like->whereHas('user')
//            }
//        ])->get();
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

    public function destroy(Post $post)
    {
        $this->authorize('update', $post);

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

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $this->validate($request, [
            'body' => 'required|max:240'
        ]);
        $post->body = $request->body;
        $post->save();
        return response()->json(['body' => $post->body], 200);
    }

    public function postLike(Request $request)
    {
        $postId = $request->postId;
        $post = Post::findOrFail($postId);
        $isLike = $request->isLike === 'true';
        $user = $request->user();

        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $isLiked = $like->isLiked;
            if ($isLike == $isLiked) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like;
        }
        $like->isLiked = $isLike;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();
        return null;
    }
}
