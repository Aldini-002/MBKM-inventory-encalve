<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Finishing;
use App\Models\Furniture;
use App\Models\FurnitureStockInSelected;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FurnitureStockInSelectedController extends Controller
{
    /**
     * view choose data
     */
    public function index()
    {
        $with = ['applications', 'category', 'materials', 'finishings', 'furniture_images'];
        $furnitures = Furniture::filter(request(['category', 'name', 'code']))->with($with)->latest()->get();
        $stock_ins_selected = FurnitureStockInSelected::latest()->get();

        return view('stock_ins.selected.index', [
            'furnitures' => $furnitures,
            'stock_ins_selected' => $stock_ins_selected,
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

        FurnitureStockInSelected::create([
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
            FurnitureStockInSelected::truncate();
            return redirect('/stock_ins');
        }

        $stock_ins_selected = FurnitureStockInSelected::find($id);

        if (!$stock_ins_selected) {
            return back()->with('warning', 'Data not found!');
        }

        $stock_ins_selected->delete();

        return back();
    }
}
