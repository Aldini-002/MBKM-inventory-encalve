<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Finishing;
use App\Models\Furniture;
use App\Models\FurnitureApplication;
use App\Models\FurnitureFinishing;
use App\Models\FurnitureImage;
use App\Models\FurnitureMaterial;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class FurnitureController extends Controller
{
    /**
     * get data
     */
    public function index(Request $req)
    {
        $with = ['applications', 'category', 'materials', 'finishings', 'furniture_images'];
        $filters = $req->only(['search']);
        $furnitures = Furniture::filter($filters)->with($with)->latest()->get();

        return view('furnitures.index', [
            'furnitures' => $furnitures,
            'finishings' => Finishing::all(),
            'categories' => Category::all(),
            'applications' => Application::all(),
            'materials' => Material::all(),
        ]);
    }

    /**
     * get data by id
     */
    public function show($id)
    {
        $with = ['applications', 'category', 'materials', 'finishings', 'furniture_images'];
        $furniture = Furniture::with($with)->find($id);

        /**
         * get relation
         */
        $furniture_application = FurnitureApplication::where('furniture_id', $id)->get();
        $furniture_material = FurnitureMaterial::where('furniture_id', $id)->get();
        $furniture_finishing = FurnitureFinishing::where('furniture_id', $id)->get();

        $application_id = [];
        $material_id = [];
        $finishing_id = [];

        foreach ($furniture_application as $data) {
            $application_id[] = $data->application_id;
        }
        foreach ($furniture_material as $data) {
            $material_id[] = $data->material_id;
        }
        foreach ($furniture_finishing as $data) {
            $finishing_id[] = $data->finishing_id;
        }

        if (!$furniture) {
            return back()->with('warning', 'furniture not found!');
        }

        return view('furnitures.show', [
            'page' => 'furniture detail',
            'furniture' => $furniture,
            'finishings' => Finishing::all(),
            'categories' => Category::all(),
            'applications' => Application::all(),
            'materials' => Material::all(),
            'finishing_id' => $finishing_id,
            'application_id' => $application_id,
            'material_id' => $material_id,

        ]);
    }

    /**
     * view create data
     */
    public function create()
    {
        return view('furnitures.create', [
            'page' => 'create furniture',
            'finishings' => Finishing::all(),
            'categories' => Category::all(),
            'applications' => Application::all(),
            'materials' => Material::all(),
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
            'category_id' => $req['category_id'],
            'material_id' => $req['material_id'],
            'application_id' => $req['application_id'],
            'finishing_id' => $req['finishing_id'],
            'code' => $req['code'] ?? 000000,
            'name' => $req['name'],
            'image' => $req['image'] ?? '-',
            'description' => $req['description'] ?? '-',
            'length' => $req['length'] ?? 0,
            'width' => $req['width'] ?? 0,
            'height' => $req['height'] ?? 0,
            'tag' => $req['tag'] ?? '-',
            'size' => $req['size'] ?? '-',
            'keyword' => $req['keyword'] ?? '-',
            'price' => $req['price'] ?? 0,
            'payment_options' => $req['payment_options'] ?? 'dp',
            'payment_terms' => $req['payment_terms'] ?? 'dp 50%',
            'delivery_terms' => $req['delivery_terms'] ?? 'fob',
            'delivery_time' => $req['delivery_time'] ?? '-',
            'lead_time' => $req['lead_time'] ?? '-',
            'packing' => $req['packing'] ?? 'corrugated paper',
            'port' => $req['port'] ?? 'tanjung mas',
            'certification' => $req['certification'] ?? 'V-Legal Wood',
            'qty_per_month' => $req['moq'] ?? 0,
            'moq' => $req['moq'] ?? 0,
            'stock' => $req['stock'] ?? 0,
            'convertible' => $req['convertible'] ?? 0,
            'adjustable' => $req['adjustable'] ?? 0,
            'folded' => $req['folded'] ?? 0,
            'extendable' => $req['extendable'] ?? 0,
        ];

        /**
         * create rules validator
         */
        $rules = [
            'category_id' => 'required|numeric',
            'application_id' => 'required',
            'material_id' => 'required',
            'finishing_id' => 'required',
            'code' => 'required|unique:furniture,code|numeric',
            'name' => 'required|min:3|unique:furniture,name',
            'description' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'tag' => 'required',
            'size' => 'required',
            'keyword' => 'required',
            'price' => 'required|numeric',
            'payment_options' => 'required',
            'payment_terms' => 'required',
            'delivery_terms' => 'required',
            'delivery_time' => 'required',
            'lead_time' => 'required',
            'packing' => 'required',
            'port' => 'required',
            'certification' => 'required',
            'qty_per_month' => 'required|numeric',
            'moq' => 'required|numeric',
            'stock' => 'required|numeric',
            'convertible' => 'required|boolean',
            'adjustable' => 'required|boolean',
            'folded' => 'required|boolean',
            'extendable' => 'required|boolean',
        ];

        /**
         * create validator image
         */
        foreach ($fields['image'] as $data) {
            $validatorImage = Validator::make(['image' => $data], ['image' => 'required|image|max:2024']);

            /**
             * run validator image
             */
            if ($validatorImage->fails()) {
                return redirect()->back()->withErrors($validatorImage)->withInput();
            }
        }

        /**
         * run validator
         */
        $validator = Validator::make($fields, $rules);

        /**
         * run validator
         */
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        /**
         * generate size
         */
        $fields['size'] = $fields['length'] . 'cm x ' . $fields['width'] . 'cm x ' . $fields['height'] . 'cm';

        /**
         * generate tag
         */
        $application_name = [];
        $material_name = [];
        $finishing_name = [];

        foreach ($fields['application_id'] as $data) {
            $application = Application::find($data);
            $application_name[] = $application['name'];
        }
        foreach ($fields['material_id'] as $data) {
            $material = Material::find($data);
            $material_name[] = $material['name'];
        }
        foreach ($fields['finishing_id'] as $data) {
            $finishing = Finishing::find($data);
            $finishing_name[] = $finishing['name'];
        }

        $application = implode(', ', $application_name);
        $material = implode(', ', $material_name);
        $finishing = implode(', ', $finishing_name);
        $category = Category::find($fields['category_id'])->name;
        $fields['tag'] = strtolower($category . ', ' . $application . ', ' . $material . ', ' . $finishing);

        /**
         * generate code
         */
        $furniture_id = Furniture::latest()->first()->id ?? 0;
        $code1 = $fields['category_id'];
        $code2 = $fields['material_id'][0];
        $code3 = $fields['material_id'][1] ?? 1;
        $code4 = str_pad(($furniture_id + 1), 4, '0', STR_PAD_LEFT);
        $code = $code1 . $code2 . $code3 . $code4;
        $fields['code'] = $code;

        Furniture::create($fields);
        $furniture_id = Furniture::latest()->first()->id;

        /**
         * manage image request
         */
        foreach ($fields['image'] as $data) {
            if (File::isFile($data)) {
                $image_name = $data->getInode() . time() . "." . $data->getClientOriginalExtension();
                $image_url = url('img/furnitures/' . $image_name);
                $data->move('img/furnitures', $image_name);

                FurnitureImage::create([
                    'furniture_id' => $furniture_id,
                    'name' => $image_name,
                    'url' => $image_url,
                ]);
            }
        }

        /**
         * create data to table pivot
         */
        foreach ($fields['application_id'] as $data) {
            FurnitureApplication::create([
                'furniture_id' => $furniture_id,
                'application_id' => $data
            ]);
        }

        foreach ($fields['finishing_id'] as $data) {
            FurnitureFinishing::create([
                'furniture_id' => $furniture_id,
                'finishing_id' => $data
            ]);
        }
        foreach ($fields['material_id'] as $data) {
            FurnitureMaterial::create([
                'furniture_id' => $furniture_id,
                'material_id' => $data
            ]);
        }

        return redirect('/furnitures')->with('success', 'add success');
    }

    /**
     * update data
     */
    public function update(Request $req, $id)
    {
        $furniture = Furniture::find($id);

        if (!$furniture) {
            return back()->with('warning', 'data not found!');
        }

        /**
         * create fields
         */
        $fields = [
            'name' => $req['name'] ?? $furniture['name'],
            'description' => $req['description'] ?? $furniture['description'],
            'length' => $req['length'] ?? $furniture['length'],
            'width' => $req['width'] ?? $furniture['width'],
            'height' => $req['height'] ?? $furniture['height'],
            'tag' => $furniture['tag'],
            'size' => $req['size'] ?? $furniture['size'],
            'keyword' => $req['keyword'] ?? $furniture['keyword'],
            'price' => $req['price'] ?? $furniture['price'],
            'payment_options' => $req['payment_options'] ?? $furniture['payment_options'],
            'payment_terms' => $req['payment_terms'] ?? $furniture['payment_terms'],
            'delivery_terms' => $req['delivery_terms'] ?? $furniture['delivery_terms'],
            'delivery_time' => $req['delivery_time'] ?? $furniture['delivery_time'],
            'lead_time' => $req['lead_time'] ?? $furniture['lead_time'],
            'packing' => $req['packing'] ?? $furniture['packing'],
            'port' => $req['port'] ?? $furniture['port'],
            'certification' => $req['certification'] ?? $furniture['certification'],
            'qty_per_month' => $req['moq'] ?? $furniture['qty_per_month'],
            'moq' => $req['moq'] ?? $furniture['moq'],
            'stock' => $req['stock'] ?? $furniture['stock'],
            'convertible' => $req['convertible'] ?? $furniture['convertible'],
            'adjustable' => $req['adjustable'] ?? $furniture['adjustable'],
            'folded' => $req['folded'] ?? $furniture['folded'],
            'extendable' => $req['extendable'] ?? $furniture['extendable'],
        ];

        /**
         * create rules validator
         */
        $rules = [
            'name' => 'required|min:3|unique:furniture,name',
            'description' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'tag' => 'required',
            'size' => 'required',
            'keyword' => 'required',
            'price' => 'required|numeric',
            'payment_options' => 'required',
            'payment_terms' => 'required',
            'delivery_terms' => 'required',
            'delivery_time' => 'required',
            'lead_time' => 'required',
            'packing' => 'required',
            'port' => 'required',
            'certification' => 'required',
            'qty_per_month' => 'required|numeric',
            'moq' => 'required|numeric',
            'stock' => 'required|numeric',
            'convertible' => 'required|boolean',
            'adjustable' => 'required|boolean',
            'folded' => 'required|boolean',
            'extendable' => 'required|boolean',
        ];

        /**
         * update rules
         */
        if ($fields['name'] == $furniture->name) {
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        /**
         * generate size
         */
        $fields['size'] = $fields['length'] . 'cm x ' . $fields['width'] . 'cm x ' . $fields['height'] . 'cm';

        $furniture->update($fields);

        return back()->with('success', 'update success');
    }

    /**
     * delete data
     */
    public function destroy($id)
    {
        $furniture = Furniture::find($id);

        if (!$furniture) {
            return back()->with('warning', 'data not found!');
        }

        /**
         * delete old image
         */
        $furniture_images = FurnitureImage::where('furniture_id', $id)->get();
        foreach ($furniture_images as $data) {
            if (File::exists('img/furnitures/' . $data->name)) {
                File::delete('img/furnitures/' . $data->name);
            }
        }

        $furniture->delete();

        return redirect('/furnitures')->with('success', 'delete success');
    }
}
