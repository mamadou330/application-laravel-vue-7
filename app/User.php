<?php

namespace App;

use App\Mail\WelcomeUserMail;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $data = $user->profile()->create([
                'title' => 'Profil de '. $user->username
            ]);


            Mail::to($data->user->email)->send(new WelcomeUserMail($data->user));
        });
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function profile(): HasOne
    {
        return $this->hasOne('App\Profile');
    }

    public function following()
    {
        return $this->belongsToMany('App\Profile');
    }
    
    public function posts(): HasMany
    {
        return $this->hasMany('App\Post')->latest();
    }

    public function getUsernameAttribute($value)
    {
        return ucfirst($value);
    }
}
