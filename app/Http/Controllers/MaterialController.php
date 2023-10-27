<?php

namespace App\Http\Controllers;

use App\Models\FurnitureMaterial;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public function index()
    {
        $orderBy = request('orderBy') ?? 'name';
        $order = request('order') ?? 'asc';
        $materials = Material::filter(request(['search']))->orderBy($orderBy, $order)->paginate(10)->withQueryString();
        $furniture_materials = FurnitureMaterial::latest()->get();

        return view('materials.index', [
            'materials' => $materials,
            'furniture_materials' => $furniture_materials
        ]);
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:material,name'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Material::create([
            'name' => $req['name']
        ]);

        return redirect('/materials?orderBy=created_at&order=desc')->with('success', 'Material berhasil ditambahkan');
    }

    public function edit($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return back()->with('warning', 'Material tidak ditemukan');
        }

        return view('materials.edit', [
            'material' => $material,
        ]);
    }

    public function update(Request $req, $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return back()->with('warning', 'Material tidak ditemukan');
        }

        $validatorRules = [
            'name' => 'required',
        ];

        if ($req->name !== $material->name) {
            $validatorRules =  [
                'name' => 'required|unique:material,name',
            ];
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $material->update([
            'name' => $req['name']
        ]);

        return redirect('/materials')->with('success', 'Material berhasil diubah');
    }

    public function destroy($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return back()->with('warning', 'Material tidak ditemukan');
        }

        $material->delete();

        return redirect('/materials?orderBy=created_at&order=desc')->with('success', 'Material berhasil dihapus');
    }
}
