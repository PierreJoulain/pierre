<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;

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
        return view ('form');
    }

    public function contact()
    {
        return view('contact');

    }
    public function createComment(Request $request, $id){
        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->content = $request->get('content');
        $post->comments()->saveMany([
            $comment
        ]);

        return redirect()->route("posts.show",$post->id);
    }

    public function store(Request $request){
       /* $post = new Post();
        $post->title = $request->title;
        $post->content = $request->get('content');
        $post->save(); */

      //  return redirect()->route("posts.show",$post->id);
        $request->validate([
           'title'=> 'required',
           'content' => 'required'
        ]);

        Post::create([
            'title'=>$request->title,
            'content'=>$request->get('content')
        ]);
    }

    public function register(){
        $post = Post::find(1);
        $video = Video::findOrFail(1);

        $comment1 = new Comment(['content'=> 'Mon premier commentaire']);
        $comment2 = new Comment(['content'=> 'Mon deuxieme commentaire']);
        $post->comments()->saveMany([
            $comment1,
            $comment2
        ]);
        $comment3 = new Comment(['content'=> 'Mon troisieme commentaire']);
        $video->comments()->save($comment3);
    }
}

