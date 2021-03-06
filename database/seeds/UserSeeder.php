<?php

use App\User;
use App\Warden;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'test sipir',
            'username' => '123456',
            'email' => 'test@mail.com',
            'password' => Hash::make('123456'),
            'api_token' => str_random(60),
            'is_admin' => false,
            'is_confirm' => true,
        ];
        $sipir = User::create($data);

        $data = [
            'user_id' => $sipir->id,
            'jabatan' => 'jabatan',
            'upt' => 'upt',
            'phone' => 'phone',
            'score' => '100',
        ];
        Warden::create($data);
    }
}
