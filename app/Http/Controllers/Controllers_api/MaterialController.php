<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * get data
     */
    public function index()
    {
        $materials = Material::latest()->get();

        return response()->json([
            'message' => 'success',
            'data' => $materials
        ], 200);
    }

    /**
     * get data by id
     */
    public function show($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $material
        ], 200);
    }

    /**
     * create data
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:material,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        Material::create([
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
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validatorRules = [
            'name' => 'required',
        ];

        if ($req->name !== $material->name) {
            $validatorRules =  [
                'name' => 'required|unique:material,name',
            ];
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $material->update([
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
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $material->delete();

        return response()->json([
            'message' => 'success',
            'data' => null,
        ], 200);
    }
}
