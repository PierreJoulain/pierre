<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('articles', [
            'posts' => $posts
        ]);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        return view('article', ['post' => $post],['tags'=>$tags]);
    }

    public function create(){
        $this->middleware('auth');
        $tags = Tag::all();
        return view ('form', ['tags'=>$tags]);
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

        return redirect()->route("posts.show",$post->id)->with('success','Votre commentaire a bien été créé');
    }

    public function store(Request $request ){
        $this->middleware('auth');

        //validation
        $request->validate([
            'title'=>'required|max:255|min:5|unique:posts',
            'content'=>'required',
            'tags'=>'required'
        ]);


       $post = Post::create([
            'title'=>$request->title,
            'user_id'=>Auth::user()->id,
            'content'=>$request->get('content'),

        ]);

        $tags = $request->input('tags');
        $post->tags()->attach($tags);

        return redirect()->route("posts.show",$post->id)->with('success','Votre post a bien été créé');

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
        return redirect()->route("posts.show",$post->id)->with('success','Votre commentaire a bien été modifié');
    }

    public function updatePost(Request $request, $postId){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'tags'=>'required']);
        $post = Post::find($postId);


        if ($post->user_id == Auth::id()) {
            $post->title = $request->get('title');
            $post->content = $request->get('content');
            $tags = $request->input('tags');
            $post->tags()->sync($tags);
            $post->save();
        }
        return redirect()->route("welcome",$post->id)->with('success','Votre post a bien été modifié');
    }



}

