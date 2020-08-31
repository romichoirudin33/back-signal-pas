<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class ApiPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //model dari database
        return Posts::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'gambar' => $request->gambar,
            'penulis' => $request->penulis,
            'slug' => 'slug',
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => 'draft'
        );
        return Posts::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get satu data dari database
        $data = Posts::where('id', $id)->first();
        //check data is empty ?
        if (!empty($data)) {
            return $data;
        }else{
            $res = ['message' => 'data tidak ditemukan'];
            return response()->json($res, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get satu data dari database
        $data = Posts::where('id', $id)->first();
        //check data is empty ?
        if (!empty($data)) {
            $data = array(
                'gambar' => $request->gambar,
                'penulis' => $request->penulis,
                'slug' => 'slug',
                'judul' => $request->judul,
                'isi' => $request->isi,
                'status' => 'draft'
            );
            return Posts::where('id', $id)->update($data);
        }else{
            $res = ['message' => 'data tidak ditemukan'];
            return response()->json($res, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Posts::where('id', $id)->delete();
        if ($data) {
            $res = ['message' => 'Data berhasil di hapus'];
            return response()->json($res, 404);
        }else{
            $res = ['message' => 'Hapus data gagal'];
            return response()->json($res, 404);
        }
    }
}
