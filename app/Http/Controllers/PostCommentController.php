<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCommentsNotification;

class PostCommentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(Post $post)
    {
        $comments = Comment::with('user')->where('post_id', $post->id)->get();

        return view('comments.index',[
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function store(Post $post,Request $request)
    {
        $post->comments()->create([
            'user_id' => $request->user()->id,
            'comments' => $request->comment,
        ]);
        
        Mail::to($post->user->email)->send(new PostCommentsNotification(auth()->user(),$post));

        return back();
    }

    public function destroy(Comment $comment,Request $request)
    {

        $request->user()->comments()->where('id',$comment->id)->delete();

        return back();
    }
}
