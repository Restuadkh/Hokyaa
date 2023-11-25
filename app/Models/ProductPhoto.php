<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_photos_id'; // Nama primary key
    protected $fillable = ['photo_path', 'product_id'];

    public function setFilenamesAttribute($value)
    {
        $this->attributes['photo_path'] = json_encode($value);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
