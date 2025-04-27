<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
     use HasFactory;

     protected $table = 'pets';

     protected $fillable = ['booking_id', 'name'];

     public function booking()
     {
         return $this->belongsTo(Booking::class);
     }
}
