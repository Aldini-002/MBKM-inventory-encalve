<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuyerController extends Controller
{
    public function index()
    {
        $orderBy = request('orderBy') ?? 'name';
        $order = request('order') ?? 'asc';
        $show = request('show') ?? '5';
        $buyers = Buyer::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('buyers.index', [
            'buyers' => $buyers,
        ]);
    }

    public function show($id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return back()->with('warning', 'Daya pembeli not found!');
        }

        return view('buyers.show', [
            'buyer' => $buyer,
        ]);
    }

    public function create()
    {
        return view('buyers.create');
    }

    public function store(Request $req)
    {
        /**
         * create fields
         */
        $fields = [
            'name' => $req['name'],
            'email' => $req['email'] ?? '-',
            'phone' => $req['phone'] ?? 0,
            'address' => $req['address'] ?? '-',
        ];

        /**
         * create rules validator
         */
        $rules = [
            'name' => 'required|min:3|unique:buyer,name',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        /**
         * run validator
         */
        $validator = Validator::make($fields, $rules);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Buyer::create($fields);

        return redirect('/buyers?orderBy=created_at&order=desc')->with('success', 'Data pembeli berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return back()->with('warning', 'Data pembeli tidak ditemukan!');
        }

        return view('buyers.edit', [
            'buyer' => $buyer
        ]);
    }

    public function update(Request $req, $id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return back()->with('warning', 'Data pembeli tidak ditemukan!');
        }

        /**
         * create fields
         */
        $fields = [
            'name' => $req['name'] ?? $buyer['name'],
            'email' => $req['email'] ?? $buyer['email'],
            'phone' => $req['phone'] ?? $buyer['phone'],
            'address' => $req['address'] ?? $buyer['address'],
        ];

        /**
         * create rules validator
         */
        $rules = [
            'name' => 'required|min:3|unique:buyer,name',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        /**
         * update rules
         */
        if ($fields['name'] == $buyer->name) {
            $rules['name'] = 'required|min:3';
        }

        /**
         * run validator
         */
        $validator = Validator::make($fields, $rules);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $buyer->update($fields);

        $query = str_replace('/buyers/' . $id, '', request()->getRequestUri());

        return redirect('/buyers/' . $id . $query)->with('success', 'Data pembeli berhasil diubah');
    }

    public function destroy($id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return back()->with('warning', 'Data pembeli tidak ditemukan!');
        }

        $buyer->delete();

        $query = str_replace('/buyers/' . $id, '', request()->getRequestUri());

        return redirect('/buyers' . $query)->with('success', 'Data pembeli berhasil dihapus');
    }
}
