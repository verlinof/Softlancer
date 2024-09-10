<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Role::all();

            return response()->json([
                "data" => $roles,
                "query" => $roles->count()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'role' => 'required|string',
            ]);
            $role = Role::create($validatedRequest);

            return response()->json([
                "message" => "Role created successfully",
                "data" => $role
            ])->header("x-cache", "true");
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
