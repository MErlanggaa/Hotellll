<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'checkin',
        'checkout',
        'jenis',
        'nama',
        'jumlah_kamar',
        'email',
        'no',
        'userID'
    ];
}