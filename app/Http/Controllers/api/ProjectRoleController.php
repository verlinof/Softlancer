<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProjectRole;
use App\Http\Requests\StoreProjectRoleRequest;
use App\Http\Requests\UpdateProjectRoleRequest;
use App\Http\Resources\ProjectRoleResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProjectRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showByProject($projectId, Request $request)
    {
        try {
            $showProject = $request->query('showProject', false);

            $projectRoles = ProjectRole::where("project_id", $projectId)->get();

            if ($showProject) {
                return ProjectRoleResource::collection($projectRoles->loadMissing("role", "project"));
            } else {
                return ProjectRoleResource::collection($projectRoles->loadMissing("role"));
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Project Role not found: ' . $e->getMessage()
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRoleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showById(ProjectRole $projectRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectRole $projectRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRoleRequest $request, ProjectRole $projectRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectRole $projectRole)
    {
        //
    }
}
