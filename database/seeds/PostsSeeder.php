<?php

use Illuminate\Database\Seeder;
use App\Posts;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i < 10; $i++) { 
    		$data = array(
    			'gambar' => 'gambar.jpeg',
    			'penulis' => 'romi',
    			'slug' => 'judul-ke-'.$i,
    			'judul' => 'judul ke-'.$i,
    			'isi' => 'percobaan ke'.$i.' menggunakan seeder'
    		);
    		Posts::create($data);
    	}
    }
}
