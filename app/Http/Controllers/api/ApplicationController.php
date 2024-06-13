<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\ProjectRole;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function byUser(Request $request)
    {
        try {
            $status = $request->query('status', 'waiting');
            if ($status == "waiting") {
                $applications = Application::where("user_id", $request->user()->id)->where("status", "waiting")->get();
            } else if ($status == "approve") {
                $applications = Application::where("user_id", $request->user()->id)->where("status", "approve")->get();
            } else if ($status == "decline") {
                $applications = Application::where("user_id", $request->user()->id)->where("status", "decline")->get();
            }

            return ApplicationResource::collection($applications->loadMissing("project", "role"));
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display all the Application data or Display a listing of the resource.
     */
    public function show(Request $request)
    {
        try {
            $userId = $request->query('userId', 0);
            $projectId = $request->query('projectId', 0);
            $projectRoleId = $request->query('projectRoleId', 0);

            if ($userId != 0 && $projectId == 0 && $projectRoleId == 0) {
                $applications = Application::where("user_id", $userId)->get();
                return ApplicationResource::collection($applications->loadMissing("project", "role"));
            } else if ($userId == 0 && $projectId != 0 && $projectRoleId == 0) {
                $projectRoleId = ProjectRole::where("project_id", $projectId)->get()->pluck("id");
                $applications = Application::whereIn("project_role_id", $projectRoleId)->get();
                return ApplicationResource::collection($applications->loadMissing("user", "role", "project"));
            } else if ($userId == 0 && $projectId == 0 && $projectRoleId != 0) {
                $applications = Application::where("project_role_id", $projectRoleId)->get();
                return ApplicationResource::collection($applications->loadMissing("user", "project", "role"));
            } else if ($userId == 0 && $projectId == 0 && $projectRoleId == 0) {
                $applications = Application::all();
                return ApplicationResource::collection($applications->loadMissing("user", "project"));
            } else {
                return response()->json([
                    'error' => 'Only userId, projectId or projectRoleId can be used'
                ], 400);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Application not found'
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database Error'
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'project_role_id' => 'required|exists:project_roles,id|integer',
                'cv_file' => 'required|url',
                'portofolio' => 'url',
            ]);
            $request["user_id"] = $request->user()->id;
            $request["status"] = "waiting";

            $application = Application::create($request->all());
            return response()->json([
                'message' => 'Application created successfully',
                'data' => new ApplicationResource($application->loadMissing("user", "project"))
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function handleApplication(Request $request, $id)
    {
        try {
            $application = Application::findOrFail($id);
            $request->validate([
                'status' => 'required|string|in:waiting,approve,decline'
            ]);
            $status = $request->query('status', 'waiting');

            $application->update([
                'status' => $status
            ]);
            return response()->json([
                'message' => 'Application updated successfully',
                'data' => new ApplicationResource($application->loadMissing("user", "project"))
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Application not found'
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database Error'
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $application = Application::findOrFail($id);
            $request->validate([
                'cv_file' => 'required|string',
                'portofolio' => 'nullable|string',
            ]);
            $request["status"] = $application->status;

            $application->update($request->all());
            return response()->json([
                'message' => 'Application updated successfully',
                'data' => new ApplicationResource($application->loadMissing("user", "project"))
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Application Not Found'
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database Error'
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $application = Application::findOrFail($id);
            $application->delete();
            return response()->json([
                'message' => 'Application deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Application not found'
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database Error'
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error'
            ], 500);
        }
    }
}
