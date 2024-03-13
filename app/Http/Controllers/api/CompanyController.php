<?php

namespace App\Http\Controllers\api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $companies = Company::all();
            return response()->json([
                "message" => "success",
                "data" => CompanyResource::collection($companies),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Internal Server Error"
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
                'company_name' => 'required|string',
                'company_description' => 'required|string',
                'company_logo' => 'required|string',
            ]);
            $company = Company::create($request->all());
            return response()->json([
                "message" => "Company Created Successfully",
                "data" => new CompanyResource($company),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Internal Server Error"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $company = Company::findOrFail($id);
            return response()->json([
                "message" => "success",
                "data" => new CompanyResource($company->loadMissing("project")),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "Company not found"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Internal Server Error"
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $company = Company::findOrFail($id);
            $request->validate([
                'company_name' => 'required|string',
                'company_description' => 'required|string',
                'company_logo' => 'required|string',
            ]);
            $company->update($request->all());
            return response()->json([
                "message" => "Company Updated Successfully",
                "data" => new CompanyResource($company),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "Company not found"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Internal Server Error"
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Internal Server Error"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->delete();
            return response()->json([
                'message' => 'Company deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "Company not found"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Internal Server Error"
            ], 500);
        }
    }
}
