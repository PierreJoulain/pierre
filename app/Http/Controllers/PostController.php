<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
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

        $this->middleware('auth');
        //validation
        $request->validate([
            'content'=>'required'
        ]);
        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->content = $request->get('content');
        $post->comments()->saveMany([
            $comment
        ]);

        return redirect()->route("posts.show",$post->id);
    }

    public function store(Request $request){
        $this->middleware('auth');


        //validation
        $request->validate([
            'title'=>'required|max:255|min:5|unique:posts',
            'content'=>'required'
        ]);

        Post::create([
            'title'=>$request->title,
            'content'=>$request->get('content')
        ]);
    }
}

