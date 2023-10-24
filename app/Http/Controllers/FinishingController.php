<?php

namespace App\Http\Controllers;

use App\Models\Finishing;
use App\Models\FurnitureFinishing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinishingController extends Controller
{

    /**
     * get data
     */
    public function index()
    {
        $finishings = Finishing::latest()->get();
        $furniture_finishings = FurnitureFinishing::latest()->get();

        return view('finishings.index', [
            'finishings' => $finishings,
            'furniture_finishings' => $furniture_finishings
        ]);
    }

    /**
     * get data by id
     */
    public function show($id)
    {
        $finishing = Finishing::find($id);

        if (!$finishing) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $finishing
        ], 200);
    }

    /**
     * create data
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:finishing,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        Finishing::create([
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
        $finishing = Finishing::find($id);

        if (!$finishing) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validatorRules = [
            'name' => 'required',
        ];

        if ($req->name !== $finishing->name) {
            $validatorRules =  [
                'name' => 'required|unique:finishing,name',
            ];
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $finishing->update([
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
        $finishing = Finishing::find($id);

        if (!$finishing) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $finishing->delete();

        return response()->json([
            'message' => 'success',
            'data' => null,
        ], 200);
    }
}
