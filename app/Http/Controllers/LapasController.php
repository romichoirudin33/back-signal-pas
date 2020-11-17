<?php

namespace App\Http\Controllers;

use App\Models\Lapas;
use Illuminate\Http\Request;

class LapasController extends Controller
{
    public function index()
    {
        $data = Lapas::where('id', '!=', 0)->orderBy('updated_at', 'DESC')->get();
        return view('lapas.index')
            ->with('data', $data);
    }

    public function create()
    {
        return view('lapas.create');
    }

    public function store(Request $request){
        $data = [
            'nama' => $request->nama,
            'kepala' => $request->kepala,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ];
        Lapas::create($data);
        return redirect()->route('lapas.index')->with('status', 'Tambah berhasil');
    }

    public function show($id){

    }

    public function edit($id){
        return view('lapas.edit')->with('data', Lapas::where('id', $id)->first());
    }

    public function update(Request $request, $id){
        $data = Lapas::where('id', $id)->first();
        $data->nama = $request->nama;
        $data->kepala = $request->kepala;
        $data->kontak = $request->kontak;
        $data->alamat = $request->alamat;
        $data->save();
        return redirect()->route('lapas.index')->with('status', 'Update berhasil');
    }

    public function destroy($id){
        Lapas::where('id', $id)->delete();
        return redirect()->route('lapas.index')->with('status', 'Hapus berhasil');
    }

}
