<?php

namespace App\Http\Controllers;

use App\Models\Lapas;
use App\Tahanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TahananController extends Controller
{
    public function index()
    {
        $auth = Auth::user();

        $export = \request('export');
        if ($export != ""){
            if ($auth->is_admin and $auth->lapas_id == 0){
                $data = Tahanan::all();
            }else{
                $lapas = $auth->lapas_id;
                $nama_lapas = $auth->lapas->nama;
                $data = Tahanan::whereHas('petugas', function ($q) use ($lapas){
                    $q->where('lapas_id', $lapas);
                })->get();
            }

            return view('tahanan.excel')->with('data', $data);
        }

        if ($auth->is_admin and $auth->lapas_id == 0){
            $cari = \request('key');
            $lapas_id = \request('lapas_id');
            $nama_lapas = 'Pilih';
            if ($cari != '' and $lapas_id != ''){
                $nama_lapas = Lapas::where('id', $lapas_id)->first()->nama;
                $data = Tahanan::where('nama_lengkap', 'LIKE', '%' . $cari . '%')
                    ->whereHas('petugas', function ($q) use ($lapas_id){
                    $q->where('lapas_id', $lapas_id);
                })->paginate(50);
            }elseif ($lapas_id != ''){
                $nama_lapas = Lapas::where('id', $lapas_id)->first()->nama;
                $data = Tahanan::whereHas('petugas', function ($q) use ($lapas_id){
                        $q->where('lapas_id', $lapas_id);
                    })->paginate(50);
            }elseif ($cari != ''){
                $data = Tahanan::where('nama_lengkap', 'LIKE', '%' . $cari . '%')->paginate(50);
            }else{
                $data = Tahanan::with('petugas')->paginate(50);
            }

            $lapas = Lapas::where('id', '!=', 0)->get();
            return view('tahanan.index_root')
                ->with('nama_lapas', $nama_lapas)
                ->with('lapas', $lapas)
                ->with('data', $data);
        }else{
            $lapas = $auth->lapas_id;
            $nama_lapas = $auth->lapas->nama;

            $cari = \request('key');
            if ($cari != ''){
                $data = Tahanan::where('nama_lengkap', 'LIKE', '%' . $cari . '%')->whereHas('petugas', function ($q) use ($lapas){
                    $q->where('lapas_id', $lapas);
                })->paginate(50);
            }else{
                $data = Tahanan::whereHas('petugas', function ($q) use ($lapas){
                    $q->where('lapas_id', $lapas);
                })->paginate(50);
            }

            return view('tahanan.index')
                ->with('nama_lapas', $nama_lapas)
                ->with('data', $data);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('tahanan.show')->with('data', Tahanan::where('id', $id)->first());
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Tahanan::where('id', $id)->delete();
        return redirect()->route('tahanan.index')->with('status', 'Hapus berhasil');
    }
}
