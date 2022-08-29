<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'status',
    ];
    const STATUS_AVAILABLE = 'Available';
    const STATUS_NOT_AVAILABLE = 'Not Available';
    const STATUS_IN_STOCK = 'In Stock';
    const STATUS_OUT_OF_STOCK = 'Out of Stock';
    const STATUS_SALE = 'On Sale';

    public function getPublicImageAttribute () {
        $image = explode("/", $this->image)[1];
        return "/storage/$image";
    }
}
