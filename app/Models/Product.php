<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasImage;

    protected $fillable = [
        'title' , 'description', 'image' , 'price', 'discount' , 'quantity' , 'sold'
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function gallery(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }
}
