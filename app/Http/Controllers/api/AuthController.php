<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver("google")->stateless()->redirect();
    }

    public function googleCallback()
    {
        $socialUser = Socialite::driver("google")->stateless()->user();

        $user = User::where('google_id', $socialUser->id)->first();

        if (!$user) {
            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('password'),
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            //Token for API and User Credentials
            $token = $user->createToken($user->name)->plainTextToken;
            $data = [
                'user' => $user,
                'token' => $token
            ];

            //Encode data Token API
            $json_data = json_encode($data);

            return redirect('http://127.0.0.1:8000/login/google/callback?token=' . urlencode($json_data));
        }

        //Token for API and User Credentials
        $token = $user->createToken($user->name)->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];

        //Encode data Token API
        $json_data = json_encode($data);

        return redirect('http://127.0.0.1:8000/login/google/callback?token=' . urlencode($json_data));
    }

    public function logout(Request $request)
    {
        $username = $request->user()->name;

        // Revoke current user API Token
        $request->user()->currentAccessToken()->delete();
        // $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

        // // Perform socialite logout if applicable
        // if ($user->provider_id !== null) {
        //     $provider = $user->provider_name;
        //     $request->session()->forget("socialite.{$provider}");
        // }

        return response()->json([
            "username" => $username,
            'message' => 'Successfully logged out'
        ], 200);
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
