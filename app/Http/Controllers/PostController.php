<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function index()
    {
        $posts = Post::all();
        return view('articles', [
            'posts' => $posts
        ]);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view('article', [
            'post' => $post
        ]);
    }

    public function create(){
        $this->middleware('auth');
        return view ('form');
    }

    public function contact()
    {
        return view('contact');

    }
    public function createComment(Request $request, $id){

        //validation
        $request->validate([
            'content'=>'required'
        ]);
        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->user_id= Auth::user()->id;
        $comment->content = $request->get('content');
        $post->comments()->saveMany([
            $comment
        ]);

        return redirect()->route("posts.show",$post->id);
    }

    public function store(Request $request ){
        $this->middleware('auth');

        //validation
        $request->validate([
            'title'=>'required|max:255|min:5|unique:posts',
            'content'=>'required'
        ]);

       $post = Post::create([
            'title'=>$request->title,
            'user_id'=>Auth::user()->id,
            'content'=>$request->get('content')
        ]);

        return redirect()->route("posts.show",$post->id);

    }

    public function destroyComment($commentId)
    {
        $comment = Comment::find($commentId);

        $post=$comment->commentable;
        if ($comment->user_id == Auth::id()) {
            $comment->delete();
        }
        return redirect()->route("posts.show",$post->id);
    }

    public function destroyPost($postId)
    {
        $post = Post::find($postId);

        if ($post->user_id == Auth::id()) {
            $post->delete();
        }
        return redirect()->route("welcome",$post->id);
    }

    public function updateComment(Request $request, $commentId){
        $request->validate([
            'content'=>'required']);
        $comment = Comment::find($commentId);
        $post = $comment->commentable;

        if ($comment->user_id == Auth::id()) {
            $comment->content = $request->get('content');
            $comment->save();
        }
        return redirect()->route("posts.show",$post->id);
    }

    public function updatePost(Request $request, $postId){
        $request->validate([
            'content'=>'required']);
        $post = Post::find($postId);


        if ($post->user_id == Auth::id()) {
            $post->content = $request->get('content');
            $post->save();
        }
        return redirect()->route("welcome",$post->id);
    }
}

