<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahanan extends Model
{
    protected $table = 'tahanan';

    protected $fillable = [
        'user_id', 'nama_lengkap', 'ttl', 'alamat', 'jenis_kelamin', 'agama', 'kewarganegaraan', 'tindak_pidana', 'hukuman', 'residivis', 'berapa_residivis', 'score'
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
