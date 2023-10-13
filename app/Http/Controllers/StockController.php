<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * view create stock
     */
    public function index()
    {
        $filters = request()->only(['search']);
        $stocks = StockOut::latest()->get();
        if (request()->stock == 'stock_in') {
            $stocks = StockIn::latest()->get();
        }
        $furnitures = Furniture::filter($filters)->latest()->get();

        return view('stock.index', [
            'page' => 'stock histories',
            'furnitures' => $furnitures,
            'stocks' => $stocks,
        ]);
    }

    /**
     * create data
     */
    public function store(Request $req)
    {
        /**
         * create fields
         */
        $fields = [
            'furniture_id' => $req['furniture_id'],
            'code' => $req['code'] ?? Str::uuid(),
            'qty' => $req['stock_adjustment'] ?? 0,
            'stock' => $req['stock_final'] ?? 0,
        ];

        /**
         * create rules validator
         */
        $rules = [
            'furniture_id' => 'required|numeric',
            'code' => 'required',
            'qty' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        if ($fields['qty'] == 0) {
            return back();
        }
        if ($fields['qty'] < 0) {
            $fields['buyer'] = $req['buyer'] ?? '-';
            $rules['buyer'] = 'required|unique:stock_out,code';
        }
        if ($fields['qty'] > 0) {
            $fields['suplier'] = $req['suplier'] ?? '-';
            $rules['suplier'] = 'required|unique:stock_in,code';
        }

        /**
         * create validator
         */
        $validator = Validator::make($fields, $rules);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($fields['qty'] < 0) {
            StockOut::create($fields);
        }

        if ($fields['qty'] > 0) {
            StockIn::create($fields);
        }

        /**
         * update data stock furniture
         */
        $furniture = Furniture::find($fields['furniture_id']);
        $furniture->stock = $fields['stock'];
        $furniture->save();

        return back()->with('success', 'edit stock success');
    }

    /**
     * delete data
     */
    public function destroy($id)
    {
        $stock = StockIn::find($id);
        if (request()->stock == 'stock_out') {
            $stock = StockOut::find($id);
        }

        if (!$stock) {
            return back()->with('warning', 'data not found!');
        }

        $stock->delete();

        return back()->with('success', 'delete success');
    }
}
