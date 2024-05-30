<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserDetailResource;
use Exception;
use Google_Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $token = $request->token;

            $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
            $payload = $client->verifyIdToken($token);

            if ($payload) {
                $googleId = $payload['sub'];
                $email = $payload['email'];
                $name = $payload['name'];
                $avatar = $payload['picture'];

                // Find or create the user
                $user = User::where('google_id', $googleId)->first();

                if (!$user) {
                    $user = User::updateOrCreate([
                        'google_id' => $googleId,
                    ], [
                        'name' => $name,
                        'email' => $email,
                        'avatar' => $avatar,
                        'is_admin' => false,
                    ]);
                }

                // Token for API and User Credentials
                $token = $user->createToken($user->name)->plainTextToken;
                $data = [
                    'user' => $user,
                    'token' => $token,
                ];

                return response()->json($data, 200);
            }
            return response()->json(['message' => 'Invalid token'], 401);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        $username = $request->user()->name;

        // Revoke current user API Token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "username" => $username,
            'message' => 'Successfully logged out'
        ], 200);
    }

    public function profile(Request $request)
    {
        try {
            $user = $request->user();

            return new UserDetailResource($user);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found: ' . $e->getMessage()
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database Error: ' . $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $user = $request->user();

            $request->validate([
                'phone_number' => 'required|max:255',
            ]);

            $user->update([
                'phone_number' => $request->phone_number
            ]);

            return response()->json([
                'message' => 'Successfully updated'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database Error: ' . $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function redirectGoogle()
    {
        return Socialite::driver("google")->stateless()->redirect();
    }

    public function googleCallback()
    {
        $socialUser = Socialite::driver("google")->stateless()->user();
        dd($socialUser);

        $user = User::where('google_id', $socialUser->id)->first();

        if (!$user) {
            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
                'is_admin' => false
            ]);

            //Token for API and User Credentials
            $token = $user->createToken($user->name)->plainTextToken;
            $data = [
                'user' => new UserDetailResource($user),
                'token' => $token
            ];

            //Encode data Token API
            $json_data = json_encode($data);

            return redirect('http://127.0.0.1:8000/login/google/callback?token=' . urlencode($json_data));
        }

        //Token for API and User Credentials
        $token = $user->createToken($user->name)->plainTextToken;
        $data = [
            'user' => new UserDetailResource($user),
            'token' => $token
        ];

        //Encode data Token API
        $json_data = json_encode($data);

        return redirect('http://127.0.0.1:8000/login/google/callback?token=' . urlencode($json_data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
