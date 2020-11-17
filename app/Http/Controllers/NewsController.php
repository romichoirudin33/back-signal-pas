<?php

namespace App\Http\Controllers;

use App\Models\Lapas;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{

    public function index()
    {
        $lapas_id = \request('lapas');
        $auth = Auth::user();
        if ($lapas_id != ''){
            $data = Posts::where('lapas_id', $lapas_id)->orderBy('updated_at', 'DESC')->paginate(50);
        }else{
            if ($auth->is_admin and $auth->lapas_id == 0){
                $data = Posts::orderBy('updated_at', 'DESC')->paginate(50);
            }else{
                $data = Posts::where('lapas_id', $auth->lapas_id)->orderBy('updated_at', 'DESC')->paginate(50);
            }

        }
        $lapas = Lapas::all();

        return view('news.index')
            ->with('lapas', $lapas)
            ->with('data', $data);
    }

    public function create()
    {
        $auth = Auth::user();
        if ($auth->is_admin and $auth->lapas_id == 0){
            $lapas = Lapas::where('id', '!=', 0)->get();
            return view('news.create_root')
                ->with('lapas', $lapas);
        }else{
            return view('news.create')->with('lapas_id', $auth->lapas_id);
        }

    }

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
            'lapas_id' => $request->lapas_id,
            'user_id' => Auth::id()
        ];
        $data = Posts::create($data);
        return redirect()->route('news.show', ['id' => $data->id])->with('status', 'Tambah berhasil');
    }

    public function show($id)
    {
        return view('news.show')->with('data', Posts::where('id', $id)->first());
    }

    public function edit($id)
    {
        return view('news.edit')->with('data', Posts::where('id', $id)->first());
    }

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

    public function destroy($id)
    {
        Posts::where('id', $id)->delete();
        return redirect()->route('news.index')->with('status', 'Hapus berhasil');
    }
}
