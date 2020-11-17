<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapas extends Model
{
    protected $table = 'lapas';

    protected $fillable = [
        'nama', 'kepala', 'alamat', 'kontak'
    ];

}
