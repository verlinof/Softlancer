<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProjectRole;
use App\Http\Requests\StoreProjectRoleRequest;
use App\Http\Requests\UpdateProjectRoleRequest;
use App\Http\Resources\ProjectRoleResource;
use App\Models\Project;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProjectRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(Request $request)
    {
        try {
            $projectId = $request->query('projectId', 0);
            $projecRoleId = $request->query('projectRoleId', 0);

            if ($projectId != 0 && $projecRoleId == 0) {
                $project = Project::findOrFail($projectId);
                $projectRoles = ProjectRole::where("project_id", $projectId)->get();

                return ProjectRoleResource::collection($projectRoles->loadMissing("role"));
            } else if ($projectId == 0 && $projecRoleId != 0) {
                $projectRole = ProjectRole::findOrFail($projecRoleId);
                return new ProjectRoleResource($projectRole->loadMissing("role", "project"));
            } else {
                return response()->json([
                    'message' => 'Only projectId or projectRoleId can be used'
                ], 400);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Project Role not found: ' . $e->getMessage()
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
