@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <span>{{ $post->image ? $post-> image->path:"pas d\'image" }}</span>
    <p>{{$post->content}}</p>
    <hr>


    <form method="POST" action="{{route('posts.comments.store',$post->id)}}">
        @csrf
    <h2>Déposez un commentaire</h2>
    <textarea name="content" cols="30" rows="10"></textarea>
    <button type="submit">Créer</button>
    </form>
    <h2>Le nombre de commentaire est : {{count($post->comments)}}</h2>

    @forelse($post->comments as $comment)
        <div>{{$comment->content}} | crée le {{$comment->created_at->format('d/m/Y')}}</div>
    @empty
        <span>aucun com mgl</span>
    @endforelse
    <hr>
    @forelse($post->tags as $tag)
        <span>{{$tag->name}}</span>
    @empty
        <span>Aucun tags pour ce post.</span>
    @endforelse


@endsection
