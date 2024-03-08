<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(Request $request)
    {
        try {
            $userId = $request->query('userId', 0);
            $projectId = $request->query('projectId', 0);
            $projectRoleId = $request->query('projectRoleId', 0);

            if ($userId != 0 && $projectId == 0 && $projectRoleId == 0) {
                $applications = Application::where("user_id", $userId)->get();
                return ApplicationResource::collection($applications->loadMissing("project", "project_role", "role"));
            } else if ($userId == 0 && $projectId != 0 && $projectRoleId == 0) {
                $applications = Application::where("project_id", $projectId)->get();
                return ApplicationResource::collection($applications->loadMissing("user", "project_role"));
            } else if ($userId == 0 && $projectId == 0 && $projectRoleId != 0) {
                $applications = Application::where("project_role_id", $projectRoleId)->get();
                return ApplicationResource::collection($applications->loadMissing("user", "project"));
            } else {
                return response()->json([
                    'message' => 'Only userId, projectId or projectRoleId can be used'
                ], 400);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
