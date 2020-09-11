<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'api_token' => str_random(60),
            'is_admin' => true,
            'is_confirm' => true,
        ];
        User::create($data);
    }
}
