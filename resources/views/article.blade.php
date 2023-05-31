@extends('layouts.app')

@section('content')



    <label for="about" class="block text-lg font-medium leading-6 text-gray-900">Voici le poste qui vous
        interesse</label>
    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">{{$post->title}}</label>
    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">{{$post->content}}</label>
    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Crée {{$post->created_at->diffForHumans()}} par {{$post->user->name}}</label>
    <br><br><br>



    <form method="POST" action="{{route('posts.comments.store',$post->id)}}">
        @csrf

        @include('partials.errors')
        @if (Auth::check())
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <p class="mt-1 text-sm leading-6 text-gray-600">Laissez donc un commentaire sur ce poste.</p>

                <div class="col-span-full">
                    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Votre
                        commentaire</label>
                    <div class="mt-2">
                        <textarea id="content" name="content" rows="3"
                                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-6 gap-x-6 flex justify-center p">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save
            </button>
        </div>
        @else
            <label for="about" class="text-center block text-lg font-medium leading-6 text-gray-900 py-16">Connectez vous pour déposer un commentaire </label>
        @endif
    </form>

    <br>
    <label for="about" class="text-center block text-lg font-medium leading-6 text-gray-900 py-16">Le nombre de
        commentaire est : {{count($post->comments)}}</label><br>
    <section class="bg-white py-8 lg:py-16">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900"></h2>
            </div>

            @forelse($post->comments as $comment)

                <article class="p-6 mb-6 text-base bg-white border-t border-gray-200">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">

                            <p class="text-sm text-gray-600">
                                <time pubdate datetime="2022-03-12"
                                      title="March 12th, 2022">Crée le {{$comment->created_at->format('d/m/Y')}} par {{ $comment->user->name }}</time>
                            </p>
                        </div>

                        <!-- Dropdown menu -->

                    </footer>
                    <p class="text-gray-500">{{$comment->content}}</p>

                </article>
            @empty

            @endforelse

            <label for="about" class="text-center block text-lg font-medium leading-6 text-gray-900">Le nombre de tag
                est : {{count($post->tags)}}</label><br>


            <div class="text-center">
                @foreach($post->tags as $tag)
                    <span class="bg-blue-200 text-blue-800 rounded text-xs py-1 px-2">{{$tag->name}}</span>
                @endforeach
            </div>


        </div>

        @endsection
    </section>

