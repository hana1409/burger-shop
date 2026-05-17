<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
   protected $fillable = [
        'user_id',
        'nama_burger',
        'jumlah',
        'total_harga',
        'special_request',
        'status',
    ];
}
