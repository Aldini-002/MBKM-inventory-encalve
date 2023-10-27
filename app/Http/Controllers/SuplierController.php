<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuplierController extends Controller
{
    public function index()
    {
        $orderBy = request('orderBy') ?? 'name';
        $order = request('order') ?? 'asc';
        $show = request('show') ?? '5';
        $supliers = Suplier::filter(request(['search']))->orderBy($orderBy, $order)->paginate($show)->withQueryString();

        return view('supliers.index', [
            'supliers' => $supliers,
        ]);
    }

    public function show($id)
    {
        $suplier = Suplier::find($id);

        if (!$suplier) {
            return back()->with('warning', 'Data pemasok tidak ditemukan!');
        }

        return view('supliers.show', [
            'suplier' => $suplier,
        ]);
    }

    public function create()
    {
        return view('supliers.create');
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
            'name' => 'required|min:3|unique:suplier,name',
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

        Suplier::create($fields);

        return redirect('/supliers?orderBy=created_at&order=desc')->with('success', 'Data pemasok berhasil ditambahkan');
    }

    public function edit($id)
    {
        $suplier = Suplier::find($id);

        if (!$suplier) {
            return back()->with('warning', 'Data pemasok tidak ditemukan!');
        }

        return view('supliers.edit', [
            'suplier' => $suplier
        ]);
    }

    public function update(Request $req, $id)
    {
        $suplier = Suplier::find($id);

        if (!$suplier) {
            return back()->with('warning', 'Data pemasok tidak ditemukan!');
        }

        /**
         * create fields
         */
        $fields = [
            'name' => $req['name'] ?? $suplier['name'],
            'email' => $req['email'] ?? $suplier['email'],
            'phone' => $req['phone'] ?? $suplier['phone'],
            'address' => $req['address'] ?? $suplier['address'],
        ];

        /**
         * create rules validator
         */
        $rules = [
            'name' => 'required|min:3|unique:suplier,name',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        /**
         * update rules
         */
        if ($fields['name'] == $suplier->name) {
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

        $suplier->update($fields);

        $query = str_replace('/supliers/' . $id, '', request()->getRequestUri());

        return redirect('/supliers/' . $id . $query)->with('success', 'Data pemasok berhasil diubah');
    }

    public function destroy($id)
    {
        $suplier = Suplier::find($id);

        if (!$suplier) {
            return back()->with('warning', 'Data pemasok tidak ditemukan!');
        }

        $suplier->delete();

        $query = str_replace('/supliers/' . $id, '', request()->getRequestUri());

        return redirect('/supliers' . $query)->with('success', 'Data pemasok berhasil dihapus');
    }
}
