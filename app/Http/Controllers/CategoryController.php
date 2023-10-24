<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * get data
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * get data by id
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $category
        ], 200);
    }

    /**
     * create data
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:category,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        Category::create([
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
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validatorRules = [
            'name' => 'required',
        ];

        if ($req->name !== $category->name) {
            $validatorRules =  [
                'name' => 'required|unique:category,name',
            ];
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $category->update([
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
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'success',
            'data' => null,
        ], 200);
    }
}
