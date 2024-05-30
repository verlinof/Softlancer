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
                RefferenceResource::collection($refferences->loadMissing("role")),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'role_id' => 'required|exists:roles,id',
            ]);
            $refference = Refference::create($request->all());
            return response()->json([
                "message" => "Refference Created Successfully",
                "data" => new RefferenceResource($refference),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Internal Server Error"
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
