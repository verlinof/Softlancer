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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        try {
            $users = User::where('is_admin', false)->get();

            return response()->json([
                'message' => "Success",
                'users' => UserDetailResource::collection($users->loadMissing('role')),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' =>  "Internal Server Error"
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'username' => 'required|max:191',
                'password' => 'required|max:191'
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'message' => $validated->errors()
                ]);
            }

            $user = User::where('username', $request->username)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'The provided credentials are incorrect.',
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            $data = [
                'message' => 'Successfully logged in',
                'token' => $token
            ];

            return response()->json($data, 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'username' => 'required|max:191',
                'email' => 'required|email',
                'password' => 'required|min:5|max:191'
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'message' => $validated->errors()
                ]);
            }

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $data = [
                'message' => 'Successfully registered',
                'data' => $user
            ];

            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $username = $request->user()->username;

            // Revoke current user API Token
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                "username" => $username,
                'message' => 'Successfully logged out'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' =>  $e->getMessage()
            ]);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = $request->user();

            return new UserDetailResource($user);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User not found: ' . $e->getMessage()
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database Error: ' . $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
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
                'error' => 'Validation Error: ' . $e->getMessage(),
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database Error: ' . $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
