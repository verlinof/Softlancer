<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectGoogle()
    {
        $user = Socialite::driver("google")->stateless()->user();

        return response()->json([
            'user' => $user
        ], 200);
    }

    public function googleCallback()
    {
        $socialUser = Socialite::driver("google")->stateless()->user();

        $user = User::where('google_id', $socialUser->id)->first();

        if(!$user) {
            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('123'),
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);
        
            $token = $user->createToken('AuthToken')->accessToken;

            return response()->json([
                "token" => $token
            ]);
        }
        $token = $user->createToken('AuthToken')->accessToken;

        return response()->json([
            "token" => $token
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
