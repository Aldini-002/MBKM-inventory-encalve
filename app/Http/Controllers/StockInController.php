<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\FurnitureStockInSelected;
use App\Models\FurnitureStockOutSelected;
use App\Models\StockIn;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StockInController extends Controller
{
    /**
     * get datas
     */
    public function index()
    {
        FurnitureStockInSelected::truncate();
        FurnitureStockOutSelected::truncate();

        $supliers = Suplier::latest()->get();
        foreach ($supliers as $data) {
            if (!count($data->stock_ins)) {
                $data->delete();
            }
        }


        return view('stock_ins.index', [
            'supliers' => $supliers
        ]);
    }

    /**
     * get data by id
     */
    public function show($id)
    {
        return back()->with('warning', 'masih dalam pengembangan');
    }

    /**
     * get datas
     */
    public function create()
    {
        return view('stock_ins.create', [
            'stock_ins_selected' => FurnitureStockInSelected::with('furniture')->latest()->get(),
        ]);
    }

    /**
     * get datas
     */
    public function store(Request $req)
    {
        $fields = [
            'furniture_id' => $req['furniture_id'],
            'suplier_id' => $req['suplier_id'] ?? 0,
            'suplier' => $req['suplier'] ?? '-',
            'description' => $req['description'] ?? '-',
            'code' => $req['code'] ?? Str::uuid(),
            'name' => $req['name'] ?? '-',
            'price' => $req['price'] ?? 0,
            'amount' => $req['amount'] ?? 0,
            'initial_stock' => $req['initial_stock'] ?? 0,
            'final_stock' => $req['final_stock'] ?? 0,
        ];

        /**
         * make rule
         */
        $rules = [
            'furniture_id' => 'required',
            'suplier_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'initial_stock' => 'required',
            'final_stock' => 'required',
        ];

        /**
         * run validator
         */
        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        /**
         * suplier manage
         */
        if ($req->suplier) {
            $validatorSuplier = Validator::make($fields, ['suplier' => 'required', 'description' => 'required']);
            /**
             * run validator
             */
            if ($validatorSuplier->fails()) {
                return redirect()->back()->withErrors($validatorSuplier)->withInput();
            }
            Suplier::create([
                'name' => $fields['suplier'],
                'description' => $fields['description']
            ]);
        }

        /**
         * id suplier
         */
        $suplier_id = Suplier::latest()->first()->id;
        $fields['suplier_id'] = $suplier_id;

        /**
         * save data
         */
        foreach ($fields['furniture_id'] as $i => $data) {
            $fields['final_stock'] = $fields['amount'][$i] + $fields['initial_stock'][$i];

            StockIn::create([
                'furniture_id' => $data,
                'suplier_id' => $fields['suplier_id'],
                'code' => Str::uuid(),
                'name' => $fields['name'][$i],
                'price' => $fields['price'][$i],
                'amount' => $fields['amount'][$i],
                'initial_stock' => $fields['initial_stock'][$i],
                'final_stock' => $fields['final_stock'],
            ]);

            $furniture = Furniture::find($data);

            $furniture->update([
                'stock' => $fields['final_stock']
            ]);
        }

        FurnitureStockInSelected::truncate();

        return redirect('/stock_ins')->with('success', 'add stock success');
    }
}
