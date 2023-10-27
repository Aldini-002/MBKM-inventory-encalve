<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Finishing;
use App\Models\Furniture;
use App\Models\Material;
use App\Models\StockInSelect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockInSelectController extends Controller
{
    public function index()
    {
        $orderBy = request('orderBy') ?? 'name';
        $order = request('order') ?? 'asc';
        $show = request('show') ?? 5;
        $with = ['applications', 'category', 'materials', 'finishings', 'furniture_images'];
        $furnitures = Furniture::filter(request(['category', 'material', 'finishing', 'application', 'search']))->with($with)->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('stock_ins.selects.index', [
            'furnitures' => $furnitures,
            'stockinselects' => StockInSelect::orderBy('created_at', 'desc')->get(),
            'finishings' => Finishing::all(),
            'categories' => Category::all(),
            'applications' => Application::all(),
            'materials' => Material::all(),
        ]);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'furniture_id' => 'required|numeric|unique:stock_in_select,furniture_id'
        ]);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        StockInSelect::create([
            'furniture_id' => $req['furniture_id']
        ]);

        return back()->with('success', 'Furniture berhasil di pilih');
    }

    public function destroy($id)
    {
        if ($id == 'cancel') {
            StockInSelect::truncate();
            return redirect('/stockins');
        }

        $stock_ins_selected = StockInSelect::find($id);

        if (!$stock_ins_selected) {
            return back()->with('warning', 'Data tidak ditemukan!');
        }

        $stock_ins_selected->delete();

        return back()->with('success', 'Furniture berhasil dikeluarkan');
    }
}
