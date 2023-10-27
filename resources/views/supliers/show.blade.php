@extends('layouts.form')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Furniture</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Furniture</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-capitalize">{{ $suplier->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-capitalize">{{ $suplier->phone }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Eamil</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $suplier->email }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $suplier->address }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Jumlah transaksi</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ count($suplier->stock_ins) }} <a
                                    href="/stockins?suplier={{ $suplier->name }}" class="btn btn-xs btn-primary">Lihat
                                    riwayat transaksi</a></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/supliers{{ str_replace('/supliers/' . $suplier->id, '', request()->getRequestUri()) }}"
                            class="btn btn-dark mr-1">Kemabli</a>
                        <a href="/supliers/{{ $suplier->id }}/edit{{ str_replace('/supliers/' . $suplier->id, '', request()->getRequestUri()) }}"
                            class="btn btn-primary mr-1">Ubah Detail</a>
                        <form
                            action="/supliers/{{ $suplier->id . str_replace('/supliers/' . $suplier->id, '', request()->getRequestUri()) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button
                                onclick="return confirm('PERHATIAN!!!\nSemua data riwayat transaksi {{ $suplier->name }} juga akan dihapus!')"
                                type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
                <!-- /.card-footer -->
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
