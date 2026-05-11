<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class burger extends Model
{
    protected $fillable = [
        'nama_burger',
        'harga',
        'stok',
        'gambar',
    ];
}
