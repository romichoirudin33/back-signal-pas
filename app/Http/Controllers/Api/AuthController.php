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
            if ($user->is_admin){
                return response()->json(['error'=>'User ini bukan user sipir !'], 200);
            }

            if (!$user->is_confirm){
                return response()->json(['error'=>'Maaf user ini belum di aktifkan admin !'], 200);
            }

            $success['name'] =  $user->name;
            $success['id'] =  $user->id;
            $success['access_token'] =  $user->api_token;
            return response()->json($success, $this->successStatus);
        }
        else{
            return response()->json(['error'=>'User not found, Try again !'], 401);
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
}
