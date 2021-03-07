<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store','destroy']);
    }
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->with(['user','likes','comments'])->paginate(10);

        return view('posts.index',[
            'posts' => $posts
        ]);

    }

    public function show(Post $post)
    {
       return view('posts.show',[
           'posts' => $post
       ]);
    }

    public function store(Request $request)
    {
        $video_contains = Str::contains($request->file('file')->getMimeType(), 'video');
        $file_type = ($video_contains) ? 'video' : 'image' ;

        $request->validate([
            'body' => 'required',
            'file' => 'mimes:mp4,jpg,png,webm'
        ]);

        $insert = $request->user()->posts()->create([
            'body' => $request->body
        ]);

        if($request->has('file')) {
            $insert->update([
               'file_path' => $request->file('file')->store('posty','public'),
               'file_type' => $file_type
           ]);
       }

        return redirect()->back();
    }

    public function destroy(Post $post,Request $request)
    {
        /**
         * Check the user have a Post using Policy
         */

        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }

        $post->delete();
        return back();
    }
}
