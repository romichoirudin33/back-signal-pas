<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news.index')->with('data', Posts::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = 'nophoto.png';

        if ($request->file('images')) {
            $file = time() . '.' . $request->file('images')->extension();
            $request->file('images')->move(public_path() . '/assets/image-news', $file);
            $image = $file;
        }

        $data = [
            'image' => $image,
            'title' => $request->title,
            'content' => $request->contents,
            'status' => $request->status,
            'user_id' => Auth::id()
        ];
        $data = Posts::create($data);
        return redirect()->route('news.show', ['id' => $data->id])->with('status', 'Tambah berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('news.show')->with('data', Posts::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('news.edit')->with('data', Posts::where('id', $id)->first());
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
        $data = Posts::where('id', $id)->first();
        $data->title = $request->title;
        $data->content = $request->contents;
        $data->status = $request->status;
        $data->user_id = Auth::id();

        if ($request->file('images')) {
            $file = time() . '.' . $request->file('images')->extension();
            $request->file('images')->move(public_path() . '/assets/image-news', $file);
            $data->image = $file;
        }

        $data->save();
        return redirect()->route('news.show', ['id' => $data->id])->with('status', 'Update berhasil');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posts::where('id', $id)->delete();
        return redirect()->route('news.index')->with('status', 'Hapus berhasil');
    }
}
