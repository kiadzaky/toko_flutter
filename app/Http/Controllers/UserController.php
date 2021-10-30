<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel as User;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $hasher = app()->make('hash');
        $username = $request->input('username');
        $password = $hasher->make($request->input('password'));

        $register = User::create([
            'username'=> $username,
            'password'=> $password
        ]);
        if ($register) {
            $data = [
                'success'=>true,
                'messages'=>'Berhasil Register'
            ];
        }else{
            $data = [
                'fail'=>true,
                'messages'=>'Gagal Register'
            ];
        }
        return response()->json($data, 200);
    }
}
