<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Finishing;
use App\Models\Furniture;
use App\Models\FurnitureStockOutSelected;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FurnitureStockOutSelectedController extends Controller
{
    /**
     * view choose data
     */
    public function index()
    {
        $with = ['applications', 'category', 'materials', 'finishings', 'furniture_images'];
        $furnitures = Furniture::filter(request(['category', 'name', 'code']))->with($with)->latest()->where('stock', '>', 0)->get();
        $stock_outs_selected = FurnitureStockOutSelected::latest()->get();

        return view('stock_outs.selected.index', [
            'furnitures' => $furnitures,
            'stock_outs_selected' => $stock_outs_selected,
            'finishings' => Finishing::all(),
            'categories' => Category::all(),
            'applications' => Application::all(),
            'materials' => Material::all(),
        ]);
    }

    /**
     * create data
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'furniture_id' => 'required|numeric|unique:furniture_stock_in_selected,furniture_id'
        ]);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        FurnitureStockOutSelected::create([
            'furniture_id' => $req['furniture_id']
        ]);

        return back();
    }

    /**
     * delete data
     */
    public function destroy($id)
    {
        if ($id == 'cancel') {
            FurnitureStockOutSelected::truncate();
            return redirect('/stock_outs');
        }

        $stock_outs_selected = FurnitureStockOutSelected::find($id);

        if (!$stock_outs_selected) {
            return back()->with('warning', 'Data not found!');
        }

        $stock_outs_selected->delete();

        return back();
    }
}
