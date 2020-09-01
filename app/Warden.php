<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warden extends Model
{

    protected $table = 'wardens';

    protected $fillable = [
        'jabatan', 'upt', 'phone', 'score', 'user_id'
    ];
}
