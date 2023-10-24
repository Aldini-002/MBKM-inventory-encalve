<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\FurnitureApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * get data
     */
    public function index()
    {
        $applications = Application::latest()->get();
        $furniture_applications = FurnitureApplication::latest()->get();

        return view('applications.index', [
            'applications' => $applications,
            'furniture_applications' => $furniture_applications
        ]);
    }

    /**
     * get data by id
     */
    public function show($id)
    {
        $application = Application::find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $application
        ], 200);
    }

    /**
     * create data
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:application,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        Application::create([
            'name' => $req['name']
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $req['name'],
        ], 201);
    }

    /**
     * update data
     */
    public function update(Request $req, $id)
    {
        $application = Application::find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validatorRules = [
            'name' => 'required',
        ];

        if ($req->name !== $application->name) {
            $validatorRules =  [
                'name' => 'required|unique:application,name',
            ];
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $application->update([
            'name' => $req['name']
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $req['name'],
        ], 200);
    }

    /**
     * delete data
     */
    public function destroy($id)
    {
        $application = Application::find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $application->delete();

        return response()->json([
            'message' => 'success',
            'data' => null,
        ], 200);
    }
}
