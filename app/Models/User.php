<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected static $relationships = ['channel'];

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

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function scopeWithRelationships($query, $relationships)
    {
        return $query->with($this->validRelationship($relationships));
    }

    public function loadRelationships($relationships): self
    {
        return $this->load($this->validRelationships($relationships));
    }

    private function validRelationships($relationships): array
    {
        return array_intersect(Arr::wrap($relationships), static::$relationships);
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text) {
            $query->where('name', 'like', "%$text%")
                ->orWhere('email', 'like', "%$text%");
        });
    }
}
