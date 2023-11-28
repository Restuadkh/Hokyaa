<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'pay_id';

    protected $fillable = [ 
        'biaya',
        'external_id',
        'description',
        'status', 
        'pay_link', 
        'expiry_date', 
    ];
}
