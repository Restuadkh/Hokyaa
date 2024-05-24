<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPhoto extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_photos_id'; // Nama primary key
    protected $fillable = [
        'photo_path'
    ]; 

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
