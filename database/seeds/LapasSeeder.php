<?php

use Illuminate\Database\Seeder;

class LapasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Lapas::create(
            [
                'id' => 0,
                'nama' => '',
                'kepala' => '',
                'alamat' => '',
                'kontak' => ''
            ]
        );
    }
}
