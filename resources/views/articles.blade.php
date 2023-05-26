@extends('layouts.app')

@section('content')



    @if ($posts->count())
        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
            <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Mon Blog Dragon Ball</h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Bienvenue sur mon blog, je m'appelle Piccolo le gros namek et  je suis la pour vous montrez mon blog.</p>
        </div>
        <div class="grid gap-8 lg:grid-cols-2 ">
            @foreach($posts as $post)
                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$post->title }}</h2>
                        <span class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</span>
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{$post->content}}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img class="w-7 h-7 rounded-full" src="https://image.jeuxvideo.com/medias-sm/150038/1500383584-9689-capture-d-ecran.jpg" alt="Pierre Joulain avatar" />
                            <span class="font-medium dark:text-white">
                              Piccolo le gros namek
                          </span>
                        </div>
                        <a href="{{ route('posts.show',['id'=>$post->id]) }} " class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </article>


        @endforeach
        </div>
    @else
        <span>Aucun post en base de données</span>
    @endif
    <h1>Liste des vidéos</h1>
        @forelse($post->comments as $comment)
            <div>{{$comment->content}} | crée le {{$comment->created_at->format('d/m/Y')}}</div>
        @empty
            <span>aucun com mgl</span>
        @endforelse
    <hr>
    <h1>Nombre de poste</h1>
    <h2>Le nombre de post est : {{count($posts)}}</h2>



@endsection
