@extends('layouts.app')
@section('content')
    <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
        <h2 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-4xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Découvrez des recettes succulentes</span></h2>
    </div>
    @if ($posts->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 sm:px-6 lg:px-8 w-full">
        @foreach($posts as $post)
            <article class="w-full p-6 bg-white rounded-lg border border-pink-300 shadow-md">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$post->title }}</h2>
                <span class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</span>
                <p class="mb-5 font-light text-gray-500">{{$post->content}}</p>
                <p class="mb-5 font-light text-gray-500">
                    @foreach($post->tags as $tag)
                        <span class="bg-blue-200 text-blue-800 rounded text-xs py-1 px-2">{{$tag->name}}</span>
                    @endforeach
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <span class="font-medium">
                          {{$post->user->name }}
                        </span>
                    </div>
                    <a href="{{ route('posts.show',['id'=>$post->id]) }} " class="inline-flex items-center font-medium text-primary-600 hover:underline">
                        Lire la recette
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </article>
        @endforeach
    </div>
@else
    <span>Aucun post en base de données</span>
@endif
@endsection
