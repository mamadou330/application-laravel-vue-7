@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <img src="{{ asset('storage' . '/'. 'avatars/default.png')}}" alt="Image de profile">
                            {{-- <img src="{{$user->profile->getImage()}}" alt="Image de profile" width="200" class="rounded-circle text-center m-2"> --}}
                        </div>

                        <div class="col-md-8 align-baseline align-items-baseline">
                            <div class="d-flex mt-3 mx-2">
                                <div class="h-4 mr-3 pt-2 font-weight-bold text-lg">{{ $user->username }}</div>
                                {{-- <button class="btn btn-primary">S'abonner</button> --}}
                                <follow-button profile-id="{{ $user->profile->id }}" follows="{{ $follows }}"></follow-button>
                            </div>
                            <div class="d-flex mt-3">
                                <span class="m-2"><strong>{{ $postsCount }}</strong> publications</span>
                                <span class="m-2"><strong>{{ $followersCount }}</strong> abonnés</span> 
                                <span class="m-2"><strong>{{ $followingCount }}</strong> abonnements</span>
                            </div>
                            @can('update', $user->profile)
                                <a href="{{ route('profiles.edit', $user->username) }}" class="btn btn-outline-success">Modifier mes informations</a>
                            @endcan
                            <div class="mt-3 mx-2">
                                <div class="font-weight-bold"><strong>{{ $user->profile->title }}</strong></div>
                                <div>{{ $user->profile->description }}</div>
                                <a href="#">{{ $user->profile->url }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        @foreach ($user->posts as $post)
                            <div class="col-md-4 my-2">
                                <a href="{{ route('posts.show', $post)}}">
                                    <img src="{{ asset('storage') . '/'. $post->image }}" alt="Image de publication" 
                                    class="w-100 img-thumbnail">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection