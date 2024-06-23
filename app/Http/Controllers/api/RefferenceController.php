<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Refference;
use App\Http\Requests\UpdateRefferenceRequest;
use App\Http\Resources\RefferenceResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RefferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $refferences = Refference::all();
            return RefferenceResource::collection($refferences->loadMissing("user:id,name,email", "role"));
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error'
            ], 500);
        }
    }

    public function showByUser()
    {
        try {
            $user = Auth::user();
            $refferences = Refference::where("user_id", $user->id)->get();

            return response()->json([
                'message' => 'Success',
                'data' => RefferenceResource::collection($refferences->loadMissing("role")),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'role_id' => 'required|array',
                'role_id.*' => 'exists:roles,id', // Validate each role_id exists
            ]);

            $roleIds = $request->input('role_id');
            $createdReferences = [];

            DB::beginTransaction();

            foreach ($roleIds as $roleId) {
                // Check if the combination of user_id and role_id already exists
                $existingReference = Refference::where('user_id', $user->id)
                    ->where('role_id', $roleId)
                    ->first();

                if (!$existingReference) {
                    $refference = Refference::create([
                        'user_id' => $user->id,
                        'role_id' => $roleId,
                        // Add other fields from the request if needed
                    ]);
                    $createdReferences[] = $refference;
                }
            }

            DB::commit();

            return response()->json([
                "message" => "References Created Successfully",
                "data" => RefferenceResource::collection($createdReferences),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => "Internal Server Error",
                'message' => $e->getMessage(), // Optional: to get the exact error message
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Refference $refference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRefferenceRequest $request, Refference $refference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $refference = Refference::findOrFail($id);
            $refference->delete();

            return response()->json([
                'message' => 'Refference deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Refference not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete refference: ' . $e->getMessage()
            ], 500);
        }
    }
}
