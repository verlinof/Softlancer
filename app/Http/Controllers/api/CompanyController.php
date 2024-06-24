<?php

namespace App\Http\Controllers\api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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
                'error' => "Internal Server Error"
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
                'company_logo' => 'required|image|max:5000',
            ]);
            //Store image to File
            $filenameWithExt = $request->file('company_logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('company_logo')->getClientOriginalExtension();
            $fileNameToStore = uniqid() . '.' . $extension;;
            $image = $request->file('company_logo')->storeAs('public/company_logo', $fileNameToStore);
            $filenameDatabase = env("APP_URL") . '/storage/company_logo/' . $fileNameToStore;
            $company = Company::create([
                'company_name' => $request->company_name,
                'company_description' => $request->company_description,
                'company_logo' => $filenameDatabase,
            ]);
            return response()->json([
                "message" => "Company Created Successfully",
                "data" => new CompanyResource($company),
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        } catch (AuthenticationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 401);
        } catch (Exception $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage()
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
                'error' => "Company not found"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Internal Server Error"
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
                'company_logo' => 'nullable|image|max:5000',
            ]);

            if ($request->hasFile('company_logo')) {
                $filenameWithExt = $request->file('company_logo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('company_logo')->getClientOriginalExtension();
                $fileNameToStore = uniqid() . '.' . $extension;;
                $request->file('company_logo')->storeAs('public/company_logo', $fileNameToStore);
                $filenameDatabase = 'storage/company_logo/' . $fileNameToStore;
                $request['company_logo'] = $filenameDatabase;

                File::delete($company->company_logo);

                $request["company_logo"] = $filenameDatabase;
                $company->update([
                    'company_name' => $request->company_name,
                    'company_description' => $request->company_description,
                    'company_logo' => $filenameDatabase,
                ]);
            } else {
                $company->update($request->except('company_logo'));
            }
            return response()->json([
                "message" => "Company Updated Successfully",
                "data" => new CompanyResource($company),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => "Company not found"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage()
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
            Storage::delete($company->company_logo);
            $company->delete();
            return response()->json([
                'success' => true,
                'message' => 'Company deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => "Company not found"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage()
            ], 500);
        }
    }
}
