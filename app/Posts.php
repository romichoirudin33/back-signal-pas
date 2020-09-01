<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	protected $table = "posts";

	protected $fillable = [
		'image',
		'title',
		'content',
		'status',
        'user_id'
	];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'user_id');
	}

}
