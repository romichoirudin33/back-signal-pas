<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	//nama tabel di database
	protected $table = "posts";

	//nama coloum di table database
	protected $fillable = [
		'gambar',
		'penulis',
		'slug',
		'judul',
		'isi',
		'status'
	];

}
