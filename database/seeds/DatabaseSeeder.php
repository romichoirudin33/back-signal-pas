<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserAdminSeeder::class);
//    	$this->call(UserSeeder::class);
//    	$this->call(PostsSeeder::class);
        $this->call(LapasSeeder::class);
    }
}
