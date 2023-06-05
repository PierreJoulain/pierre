@extends('layouts.app')
@section('content')
<h1>Creer un nv poste</h1>

<form method="POST" action="{{route('posts.store')}}">
    @csrf
    {{-- <input type="text" name="title">
    <textarea name="content" cols="30" rows="10"></textarea>
    <button class="border" type="submit">Créer</button>--}}


    @include('partials.errors')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">


                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nom du poste</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
                                <input type="text" name="title" id="username" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Texte du poste</label>
                        <div class="mt-2">
                            <textarea id="about" name="content" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Ecrivez ce que souhaitez.</p>
                    </div>

                    <label for="cars" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choisissez un tag:</label>

                    <select name="tags[]" id="tag" multiple="true" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($tags as $tag)
                            <option class="py-1 px-2" value="{{ $tag->id }}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    <br><br>




                </div>
            </div>
        </div>




        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>


</form>
@endsection
