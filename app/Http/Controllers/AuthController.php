<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return redirect('http://127.0.0.1:8000/api/auth/google/redirect');
    }

    public function handleGoogleCallback()
    {
        //Get Data from API url
        $data = request('token');
        $dataDecode = json_decode($data, true);
        $token = $dataDecode["token"];
        $userData = $dataDecode["user"];

        //Find User and Session Login
        $user = User::where('id', $userData["id"])->first();
        // Session::put('bearer token', $token);
        if ($user) {
            // Autentikasi berhasil
            $user = Auth::login($user);

            return redirect("/");
        } else {
            // Autentikasi gagal
            return "Autentikasi gagal!";
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect("http://127.0.0.1:8000/api/logout");
    }

    public function test()
    {
        $user = Auth::user();

        if ($user) {
            return $user->name;
        } else {
            return redirect("/");
        }
    }
}
