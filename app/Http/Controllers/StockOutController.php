<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * get datas
     */
    public function index()
    {
        return view('stock_ins.index');
    }

    /**
     * get data by id
     */
    public function show($id)
    {
        return view('stock_ins.show');
    }

    /**
     * view create data
     */
    public function create(Request $req)
    {
        return view('stock_ins.craete');
    }
}
