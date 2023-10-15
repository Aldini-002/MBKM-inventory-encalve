<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\FurnitureStockOutSelected;
use App\Models\StockOut;
use App\Models\Buyer;
use App\Models\FurnitureStockInSelected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StockOutController extends Controller
{
    /**
     * get datas
     */
    public function index()
    {
        FurnitureStockOutSelected::truncate();
        FurnitureStockInSelected::truncate();

        $buyers = Buyer::latest()->get();
        foreach ($buyers as $data) {
            if (!count($data->stock_outs)) {
                $data->delete();
            }
        }

        return view('stock_outs.index', [
            'buyers' => $buyers
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
        return view('stock_outs.create', [
            'stock_outs_selected' => FurnitureStockOutSelected::with('furniture')->latest()->get(),
        ]);
    }

    /**
     * get datas
     */
    public function store(Request $req)
    {
        $fields = [
            'furniture_id' => $req['furniture_id'],
            'buyer_id' => $req['buyer_id'] ?? 0,
            'buyer' => $req['buyer'] ?? '-',
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
            'buyer_id' => 'required',
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
         * buyer manage
         */
        if ($req->buyer) {
            $validatorBuyer = Validator::make($fields, ['buyer' => 'required', 'description' => 'required']);
            /**
             * run validator
             */
            if ($validatorBuyer->fails()) {
                return redirect()->back()->withErrors($validatorBuyer)->withInput();
            }
            Buyer::create([
                'name' => $fields['buyer'],
                'description' => $fields['description']
            ]);
        }

        /**
         * id buyer
         */
        $buyer_id = Buyer::latest()->first()->id;
        $fields['buyer_id'] = $buyer_id;

        /**
         * save data
         */
        foreach ($fields['furniture_id'] as $i => $data) {
            $fields['final_stock'] = $fields['initial_stock'][$i] - $fields['amount'][$i];

            StockOut::create([
                'furniture_id' => $data,
                'buyer_id' => $fields['buyer_id'],
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

        FurnitureStockOutSelected::truncate();

        return redirect('/stock_outs')->with('success', 'reduce stock success');
    }
}
