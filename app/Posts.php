<?php

namespace App;

use App\Models\Lapas;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	protected $table = "posts";

	protected $fillable = [
		'image',
		'title',
		'content',
		'status',
        'user_id',
        'lapas_id'
	];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'user_id');
	}

    public function lapas()
    {
        return $this->belongsTo(Lapas::class, 'lapas_id');
	}

}
