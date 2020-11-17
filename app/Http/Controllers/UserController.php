<?php

namespace App\Http\Controllers;

use App\Models\Lapas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $jenis = \request('jenis');
        $export = \request('export');

        $data = User::where('is_admin', true)->where('lapas_id', '!=', 0)->get();
        if ($jenis == 'root') {
            return $this->root();
        }
        if ($jenis == 'admin') {
            $data = User::where('is_admin', true)->where('lapas_id', '!=', 0)->get();
            return view('user.admin.index')->with('data', $data);
        }
        if ($jenis == 'sipir') {
            $data = User::where('is_admin', false)->get();
        }

        if ($export != "") {
            return view('user.excel')->with('data', $data);
        }
        return view('user.index')->with('data', $data);
    }

    public function root()
    {
        $auth = Auth::user();
        if ($auth->is_admin and $auth->lapas_id == 0) {
            $data = User::where('is_admin', true)->where('lapas_id', 0)->get();
            return view('user.root.index')->with('data', $data);
        }
        abort(403);
        return null;
    }

    public function create(Request $request)
    {
        $jenis = $request->jenis;
        if ($jenis == 'root') {
            return view('user.root.create');
        }
        if ($jenis == 'admin') {
            $lapas = Lapas::where('id', '!=', 0)->get();
            return view('user.admin.create')->with('lapas', $lapas);
        }
    }

    public function store(Request $request)
    {
        if ($request->jenis == 'root') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'api_token' => str_random(60),
                'is_admin' => true,
                'lapas_id' => 0
            ]);
            return redirect()->route('user.index', ['jenis' => $request->jenis])->with('status', 'Tambah user root berhasil');
        }

        if ($request->jenis == 'admin') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'lapas' => ['required'],
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'api_token' => str_random(60),
                'is_admin' => true,
                'lapas_id' => $request->lapas
            ]);
            return redirect()->route('user.index', ['jenis' => $request->jenis])->with('status', 'Tambah user root berhasil');
        }

    }

    public function show($id)
    {
        return view('user.show')->with('data', User::where('id', $id)->first());
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        $lapas = Lapas::where('id', '!=', 0)->get();
        return view('user.sipir.edit')
            ->with('lapas', $lapas)
            ->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'lapas_id' => $request->lapas_id,
            'is_confirm' => $request->is_confirm == 'on' ? 1 : 0
        ];
        User::where('id', $id)->update($data);
        return redirect()->route('user.index', ['jenis' => 'sipir'])->with('status', 'Update berhasil');
//        User::where('id', $id)->update($request->except(['_token', '_method']));
//        return redirect()->back()->with('status', 'Update berhasil');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('status', 'Hapus berhasil');
    }
}
