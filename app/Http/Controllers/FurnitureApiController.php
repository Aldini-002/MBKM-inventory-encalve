<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use Illuminate\Http\Request;

class FurnitureApiController extends Controller
{
    public function index()
    {
        $orderBy = request('orderBy') ?? 'name';
        $order = request('order') ?? 'asc';
        $show = request('show') ?? '5';
        $with = ['applications', 'category', 'materials', 'finishings', 'furniture_images'];
        $furnitures = Furniture::filter(request(['category', 'material', 'finishing', 'application', 'search']))->with($with)->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return response()->json([
            'message' => 'success',
            'data' => $furnitures
        ], 200);
    }

    public function show($id)
    {
        $with = ['applications', 'category', 'materials', 'finishings', 'furniture_images'];
        $furniture = Furniture::with($with)->find($id);

        if (!$furniture) {
            return response()->json([
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $furniture
        ], 200);
    }
}
