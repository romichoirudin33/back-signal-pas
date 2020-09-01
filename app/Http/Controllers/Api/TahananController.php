<?php

namespace App\Http\Controllers\Api;

use App\Tahanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TahananController extends Controller
{
    public function store(Request $request)
    {
        return Tahanan::create($request->all());
    }
}
