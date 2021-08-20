<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->profile->id) : false;

        $postsCount =  Cache::remember('posts.count'. $user->id, now()->addMinutes(5), function () use ($user) {
            return $user->posts->count();
        });

        $followersCount = Cache::remember('followers.count'. $user->id, now()->addMinutes(5), function () use ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember('following.count'. $user->id, now()->addMinutes(5), function () use ($user) {
            return
                $user->following->count();
        });


        return view('profiles.show', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user->profile);

        $data = $request->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:5',
            'url' => 'required|url',
            'image' => 'sometimes|image|max:3000',
        ]);

        // dd($data);
        //Si j'ai une image dans l'envoie du formulaire alors 
        if ($request->image) {
            $imagePath = request('image')->store('avatars', 'public');
            $imageRedimentionner = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);
            $imageRedimentionner->save();
            auth()->user()->profile->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));
        } else {
            Auth::user()->profile->update($data);
        }

        return view('profiles.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
