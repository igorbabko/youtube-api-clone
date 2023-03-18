<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Traits\WithRelationships;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, WithRelationships;

    protected static $relationships = ['channel', 'comments'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::deleting(fn (User $user) => $user->tokens()->delete());
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $password) => Hash::make($password)
        );
    }

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text) {
            $query->where('name', 'like', "%$text%")
                ->orWhere('email', 'like', "%$text%");
        });
    }

    public function sendPasswordResetNotification($token): void
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        $this->notify(new ResetPasswordNotification($url));
    }
}
