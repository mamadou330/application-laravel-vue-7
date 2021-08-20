@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div class="row mb-4">
                <div class="col-6 offset-3">
                    <a href="{{ route('posts.show', $post)}}">
                        <img src="{{ asset('storage') . '/'. $post->image }}" alt="Image de publication" 
                        class="w-100 img-thumbnail">
                    </a>
                    <hr>
                    <div>
                        Posté par <strong>{{ $post->user->username }} </strong>
                        le {{ $post->created_at->format('d/m/Y')}}
                    </div>
                </div>
            </div>
        @endforeach
    <div class="col-12">
        <div class="row justify-content-center">

            {{ $posts->links()}}
        </div>
    </div>
    </div>
@endsection