<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $orderBy = request('orderBy') ?? 'name';
        $order = request('order') ?? 'asc';
        $categories = Category::filter(request(['search']))->orderBy($orderBy, $order)->paginate(10)->withQueryString();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:category,name'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Category::create([
            'name' => $req['name']
        ]);

        return redirect('/categories?orderBy=created_at&order=desc')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return back()->with('warning', 'Kategori tidak ditemukan');
        }

        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $req, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return back()->with('warning', 'Kategori tidak ditemukan');
        }

        $validatorRules = [
            'name' => 'required',
        ];

        if ($req->name !== $category->name) {
            $validatorRules =  [
                'name' => 'required|unique:category,name',
            ];
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category->update([
            'name' => $req['name']
        ]);

        return redirect('/categories')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return back()->with('warning', 'Kategori tidak ditemukan');
        }

        $category->delete();

        return redirect('/categories?orderBy=created_at&order=desc')->with('success', 'Kategori berhasil dihapus');
    }
}
