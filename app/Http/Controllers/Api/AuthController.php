<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Warden;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $is_login = true;
            $message = "";
            if ($user->is_admin){
                $is_login = false;
                $message = 'User ini bukan user sipir !';
//                return response()->json(['error'=>'User ini bukan user sipir !'], 401);
            }

            if (!$user->is_confirm){
                $is_login = false;
                $message = 'Maaf user ini belum di aktifkan admin !';
//                return response()->json(['error'=>'Maaf user ini belum di aktifkan admin !'], 401);
            }

            $success['name'] =  $user->name;
            $success['id'] =  $user->id;
            $success['access_token'] =  $user->api_token;
            $success['is_login'] =  $is_login;
            $success['message'] =  $message;
            return response()->json($success, $this->successStatus);
        }
        else{
            $is_login = false;
            $message = 'User not found, Try again !!';
            $success['is_login'] =  $is_login;
            $success['message'] =  $message;
            return response()->json($success, $this->successStatus);
        }
    }

    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => str_random(60),
        ];
        $sipir = User::create($data);

        $data = [
            'user_id' => $sipir->id,
            'jabatan' => $request->jabatan,
            'upt' => $request->upt,
            'phone' => $request->phone,
            'score' => $request->score,
        ];
        Warden::create($data);

        return response()->json(['message' => 'Register success'], $this->successStatus);
    }

    public function user(Request $request)
    {
        $user = User::where('id', $request->user()->id)
            ->first();
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'is_admin' => $user->is_admin,
            'jabatan' => $user['warden']['jabatan'],
            'upt' => $user['warden']['upt'],
            'phone' => $user['warden']['phone'],
            'score' => $user['warden']['score'],
        ];

        return response()->json($data, $this->successStatus);
    }
}
