<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

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
}
