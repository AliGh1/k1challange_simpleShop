<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory, HasImage;

    protected $fillable = ['image' , 'alt'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
