<?php

namespace App\Models;

use App\Interfaces\Likeable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use function PHPUnit\Framework\throwException;

/**
 * @property boolean $is_admin
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function like(Likeable $likeable)
    {
        if (!auth()->user()->isLiked($likeable))
            $likeable->likes()->create([
                'user_id' => auth()->id()
            ]);
    }

    public function unlike(Likeable $likeable)
    {
        if (auth()->user()->isLiked($likeable))
            $likeable->likes()
                ->whereHas('user', fn($q) => $q->whereId($this->id))
                ->delete();
    }

    public function isLiked(Likeable $likeable): bool
    {
        if (! $likeable->exists) {
            return false;
        }

        return $likeable->likes()->whereHas('user', fn($q) =>  $q->whereId($this->id))->exists();
    }
}
