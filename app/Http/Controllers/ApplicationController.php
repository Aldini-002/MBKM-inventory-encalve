<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\FurnitureApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function index()
    {
        $orderBy = request('orderBy') ?? 'name';
        $order = request('order') ?? 'asc';
        $applications = Application::filter(request(['search']))->orderBy($orderBy, $order)->paginate(10)->withQueryString();
        $furniture_applications = FurnitureApplication::latest()->get();

        return view('applications.index', [
            'applications' => $applications,
            'furniture_applications' => $furniture_applications
        ]);
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:application,name'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Application::create([
            'name' => $req['name']
        ]);

        return redirect('/applications?orderBy=created_at&order=desc')->with('success', 'Application berhasil ditambahkan');
    }

    public function edit($id)
    {
        $application = Application::find($id);

        if (!$application) {
            return back()->with('warning', 'Application tidak ditemukan');
        }

        return view('applications.edit', [
            'application' => $application,
        ]);
    }

    public function update(Request $req, $id)
    {
        $application = Application::find($id);

        if (!$application) {
            return back()->with('warning', 'Application tidak ditemukan');
        }

        $validatorRules = [
            'name' => 'required',
        ];

        if ($req->name !== $application->name) {
            $validatorRules =  [
                'name' => 'required|unique:application,name',
            ];
        }

        $validator = Validator::make($req->all(), $validatorRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $application->update([
            'name' => $req['name']
        ]);

        return redirect('/applications')->with('success', 'Application berhasil diubah');
    }

    public function destroy($id)
    {
        $application = Application::find($id);

        if (!$application) {
            return back()->with('warning', 'Application tidak ditemukan');
        }

        $application->delete();

        return redirect('/applications?orderBy=created_at&order=desc')->with('success', 'Application berhasil dihapus');
    }
}
