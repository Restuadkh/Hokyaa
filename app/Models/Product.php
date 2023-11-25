<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id'; // Nama primary key

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'disc_price',
        'stock_quantity',
        'category',
    ];

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}
