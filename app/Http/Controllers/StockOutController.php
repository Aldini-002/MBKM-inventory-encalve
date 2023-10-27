<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Furniture;
use App\Models\StockInSelect;
use App\Models\StockOut;
use App\Models\StockOutSelect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StockOutController extends Controller
{
    public function index()
    {
        StockInSelect::truncate();
        StockOutSelect::truncate();

        $orderBy = request('orderBy') ?? 'furniture_name';
        $order = request('order') ?? 'asc';
        $show = request('show') ?? 5;
        $with = ['buyer'];
        $stockouts = StockOut::filter(request(['search', 'buyer']))->with($with)->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('stock_outs.index', [
            'stockouts' => $stockouts,
            'buyers' => Buyer::orderBy('name', 'asc')->get(),
        ]);
    }

    public function show($id)
    {
        $query = '';
        $stockout = StockOut::find($id);

        if (!$stockout) {
            return back()->with('warning', 'Data tidak ditemukan');
        }

        return view('stock_outs.show', [
            'stockout' => $stockout,
        ]);
    }

    public function create()
    {
        return view('stock_outs.create', [
            'stockoutselects' => StockOutSelect::with('furniture')->orderBy('created_at', 'desc')->get(),
            'buyers' => Buyer::orderBy('name', 'asc')->get(),
        ]);
    }

    public function store(Request $req)
    {
        $fields = [
            'furniture_id' => $req['furniture_id'],
            'buyer_id' => $req['buyer_id'],
            'amount' => $req['amount'] ?? 0,
        ];

        $rules = [
            'buyer_id' => 'required',
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
            $fields['final_stock'] = $furniture['stock'] - $fields['amount'][$i];
            $fields['total'] = $fields['furniture_price'] * $fields['amount'][$i];

            $validator = Validator::make($fields, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            StockOut::create([
                'buyer_id' => $fields['buyer_id'][$i],
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

        StockOutSelect::truncate();

        return redirect('/stockouts?orderBy=created_at&order=desc')->with('success', 'Stok berhasil dikurangi');
    }

    public function destroy($id)
    {
        $stockout = StockOut::find($id);

        if (!$stockout) {
            return back()->with('warning', 'Data tidak ditemukan');
        }

        $stockout->delete();

        $query = str_replace('/stockouts/' . $id, '', request()->getRequestUri());

        return redirect('/stockouts' . $query)->with('success', 'Data riwayat stok masuk berhasil dihapus');
    }
}
