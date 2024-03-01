<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Application;
use App\Models\Project;
use App\Models\ProjectRole;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $projects = Project::paginate(5);

            return response()->json([
                "data" => $projects
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'project_title' => 'required|max:255',
                'project_description' => 'required',
                'owner' => 'required|max:255',
                'roles' => 'required|array',
                'roles.*' => 'exists:roles,id', // Ensure each project role ID exists in the project_roles table
                'total_person' => 'required|array',
            ]);

            // Create the project
            $project = Project::create($request->only(['project_title', 'project_description', 'owner']));

            // Attach project roles with total_person
            for ($i = 0; $i < count($request->roles); $i++) {
                $role_id = $request->roles[$i];
                $total_person = $request->total_person[$i];

                ProjectRole::create([
                    'project_id' => $project->id,
                    'role_id' => $role_id,
                    'total_person' => $total_person
                ]);
            }

            return response()->json([
                'message' => 'Project created successfully',
                'data' => $project
            ], 201);
        } catch (QueryException $e) {
            // Handle database related exceptions here
            return response()->json([
                'message' => 'Database Error: ' . $e->getMessage()
            ], 500);
        } catch (ValidationException $e) {
            // Handle validation exceptions here
            return response()->json([
                'message' => 'Validation Error: ' . $e->getMessage()
            ], 400);
        } catch (Exception $e) {
            // Handle general exceptions here
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $project = Project::findOrFail($id);
            return new ProjectResource($project);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_title' => 'required|max:255',
            'project_description' => 'required',
            'owner' => 'required|max:255',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'total_person' => 'required|array',
        ]);

        try {
            $project = Project::findOrFail($id);

            // Update main project data
            $project->update([
                'project_title' => $request->project_title,
                'project_description' => $request->project_description,
                'owner' => $request->owner,
            ]);

            // Update or create project roles
            $existingRoleIds = [];
            for ($i = 0; $i < count($request->roles); $i++) {
                $role_id = $request->roles[$i];
                $total_person = $request->total_person[$i];

                $existingRoleIds[] = $role_id;

                $projectRole = ProjectRole::where('project_id', $project->id)
                    ->where('role_id', $role_id)
                    ->first();

                if ($projectRole) {
                    // Update existing project role
                    $projectRole->update(['total_person' => $total_person]);
                } else {
                    // Create new project role
                    ProjectRole::create([
                        'project_id' => $project->id,
                        'role_id' => $role_id,
                        'total_person' => $total_person
                    ]);
                }
            }

            // Delete project roles that are not included in the updated roles
            $projectRole = ProjectRole::where('project_id', $project->id)
                ->whereNotIn('role_id', $existingRoleIds);

            $projectRoleId = ProjectRole::where('project_id', $project->id)
                ->whereNotIn('role_id', $existingRoleIds)
                ->pluck('id');

            // Delete Application terkait
            Application::whereIn("project_role_id", $projectRoleId)
                ->delete();
            // Delete Project Role
            $projectRole->delete();

            return response()->json([
                'message' => 'Project updated successfully',
                'data' => $project,
                'existingRoleId' => $existingRoleIds
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    public function closeProject($id)
    {
        try {
            $project = Project::findOrFail($id);
            //Update the status to closed
            $project->update([
                'project_title' => $project->project_title,
                'project_description' => $project->project_description,
                'owner' => $project->owner,
                'status' => "closed"
            ]);

            //MASIH HARUS MIKIRIN BUAT NGIRIM EMAIL KE APPLICANT TERKAIT

            return response()->json([
                "message" => "Project Closed",
                "data" => $project
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
