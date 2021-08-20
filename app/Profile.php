<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Profile extends Model
{
    use Notifiable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\User');
    }

    public function getImage()
    {
        $imagePath = $this->image ?? 'avatars/default.png';

        return "/storage/" .$imagePath;
    }
}
