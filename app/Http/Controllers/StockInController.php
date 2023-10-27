<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Finishing;
use App\Models\Furniture;
use App\Models\Material;
use App\Models\StockIn;
use App\Models\StockInSelect;
use App\Models\StockOutSelect;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StockInController extends Controller
{
    public function index()
    {
        StockInSelect::truncate();
        StockOutSelect::truncate();

        $orderBy = request('orderBy') ?? 'furniture_name';
        $order = request('order') ?? 'asc';
        $show = request('show') ?? 5;
        $with = ['suplier'];
        $stockins = StockIn::filter(request(['search', 'suplier']))->with($with)->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('stock_ins.index', [
            'stockins' => $stockins,
            'supliers' => Suplier::orderBy('name', 'asc')->get(),
        ]);
    }

    public function show($id)
    {
        $query = '';
        $stockin = StockIn::find($id);

        if (!$stockin) {
            return back()->with('warning', 'Data tidak ditemukan');
        }

        return view('stock_ins.show', [
            'stockin' => $stockin,
        ]);
    }

    public function create()
    {
        return view('stock_ins.create', [
            'stockinselects' => StockInSelect::with('furniture')->orderBy('created_at', 'desc')->get(),
            'supliers' => Suplier::orderBy('name', 'asc')->get(),
        ]);
    }

    public function store(Request $req)
    {
        $fields = [
            'furniture_id' => $req['furniture_id'],
            'suplier_id' => $req['suplier_id'],
            'amount' => $req['amount'] ?? 0,
        ];

        $rules = [
            'suplier_id' => 'required',
            'furniture_id' => 'required',
            'code' => 'required|unique:stock_in,code',
            'furniture_code' => 'required',
            'furniture_name' => 'required',
            'furniture_price' => 'required',
            'amount' => 'required',
            'initial_stock' => 'required',
            'final_stock' => 'required',
            'total' => 'required',
        ];

        foreach ($fields['furniture_id'] as $i => $data) {
            $furniture = Furniture::find($data);

            $fields['code'] = Str::uuid();
            $fields['furniture_code'] = $furniture['code'];
            $fields['furniture_name'] = $furniture['name'];
            $fields['furniture_price'] = $furniture['price'];
            $fields['initial_stock'] = $furniture['stock'];
            $fields['final_stock'] = $furniture['stock'] + $fields['amount'][$i];
            $fields['total'] = $fields['furniture_price'] * $fields['amount'][$i];

            $validator = Validator::make($fields, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            StockIn::create([
                'suplier_id' => $fields['suplier_id'][$i],
                'furniture_id' => $fields['furniture_id'][$i],
                'code' => $fields['code'],
                'furniture_code' => $fields['furniture_code'],
                'furniture_name' => $fields['furniture_name'],
                'furniture_price' => $fields['furniture_price'],
                'amount' => $fields['amount'][$i],
                'initial_stock' => $fields['initial_stock'],
                'final_stock' => $fields['final_stock'],
                'total' => $fields['total'],
            ]);

            $furniture->update([
                'stock' => $fields['final_stock']
            ]);
        }

        StockInSelect::truncate();

        return redirect('/stockins?orderBy=created_at&order=desc')->with('success', 'Stok berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $stockin = StockIn::find($id);

        if (!$stockin) {
            return back()->with('warning', 'Data tidak ditemukan');
        }

        $stockin->delete();

        $query = str_replace('/stockins/' . $id, '', request()->getRequestUri());

        return redirect('/stockins' . $query)->with('success', 'Data riwayat stok masuk berhasil dihapus');
    }
}
