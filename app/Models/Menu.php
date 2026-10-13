<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'nama_menu',
        'harga',
        'deskripsi',
        'foto',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(MenuReview::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function averageRating(): float
    {
        return round((float) $this->reviews()->average('rating'), 1) ?: 0.0;
    }

    public function reviewCount(): int
    {
        return $this->reviews()->count();
    }
}
