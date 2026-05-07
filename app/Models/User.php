<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


#[Fillable(['name', 'email', 'profile_photo_path', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function watchedEpisodes(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_user');
    }

    /** @noinspection PhpUnused */
    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {

                if ($this->profile_photo_path) {
                    return Storage::url($this->profile_photo_path);
                }
                return Storage::url('profile_photos/teste.jpg');
            }
        );
    }

    public function reviews(): hasMany
    {
        return $this->hasMany(Review::class);
    }
}
