<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Refference;
use App\Http\Requests\StoreRefferenceRequest;
use App\Http\Requests\UpdateRefferenceRequest;
use App\Http\Resources\RefferenceResource;
use Exception;
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
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
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
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRefferenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Refference $refference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Refference $refference)
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
    public function destroy(Refference $refference)
    {
        //
    }
}
