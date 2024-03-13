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
                "message" => "Success",
                "data" => ProjectResource::collection($projects->loadMissing('company')),
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
                'company_id' => 'required|exists:companies,id',
                'project_title' => 'required|max:255',
                'project_description' => 'required',
                'roles' => 'required|array',
                'roles.*' => 'exists:roles,id', // Ensure each project role ID exists in the project_roles table
                'max_person' => 'required|array',
            ]);

            // Create the project
            $project = Project::create($request->only(['company_id', 'project_title', 'project_description']));

            // Attach project roles with total_person
            for ($i = 0; $i < count($request->roles); $i++) {
                $role_id = $request->roles[$i];
                $max_person = $request->max_person[$i];

                ProjectRole::create([
                    'project_id' => $project->id,
                    'role_id' => $role_id,
                    'max_person' => $max_person
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
            return response()->json([
                'message' => 'Project retrieved successfully',
                'data' => new ProjectResource($project->loadMissing('company', 'projectRole.role')),
            ]);
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
            'company_id' => 'required|exists:companies,id',
            'project_title' => 'required|max:255',
            'project_description' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'max_person' => 'required|array',
        ]);

        try {
            $project = Project::findOrFail($id);

            // Update main project data
            $project->update([
                'company_id' => $request->company_id,
                'project_title' => $request->project_title,
                'project_description' => $request->project_description,
            ]);

            // Update or create project roles
            $existingRoleIds = [];
            for ($i = 0; $i < count($request->roles); $i++) {
                $role_id = $request->roles[$i];
                $max_person = $request->max_person[$i];

                $existingRoleIds[] = $role_id;

                $projectRole = ProjectRole::where('project_id', $project->id)
                    ->where('role_id', $role_id)
                    ->first();

                if ($projectRole) {
                    // Update existing project role
                    $projectRole->update(['max_person' => $max_person]);
                } else {
                    // Create new project role
                    ProjectRole::create([
                        'project_id' => $project->id,
                        'role_id' => $role_id,
                        'max_person' => $max_person
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
                'company_id' => $project->company_id,
                'project_title' => $project->project_title,
                'project_description' => $project->project_description,
                'status' => "closed"
            ]);

            //MASIH HARUS MIKIRIN BUAT NGIRIM EMAIL KE APPLICANT TERKAIT

            return response()->json([
                "message" => "Project Closed",
                "data" => $project
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found: ' . $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function openProject($id)
    {
        try {
            $project = Project::findOrFail($id);
            //Update the status to closed
            $project->update([
                'company_id' => $project->company_id,
                'project_title' => $project->project_title,
                'project_description' => $project->project_description,
                'status' => "open"
            ]);

            //MASIH HARUS MIKIRIN BUAT NGIRIM EMAIL KE APPLICANT TERKAIT

            return response()->json([
                "message" => "Project Opened Successfully",
                "data" => $project
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found: ' . $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();

            return response()->json([
                'message' => 'Project deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the project with the specified ID does not exist
            return response()->json([
                'message' => 'Project not found: ' . $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            // Handle general exceptions
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
