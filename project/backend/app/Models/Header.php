<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $fillable = [
        'city',
        'slogan',
        'address',
        'phone',
        'email',
        'worktime',
        'vk',
        'tg',
        'whatsapp',
    ];
}
