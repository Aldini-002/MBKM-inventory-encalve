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
            <!-- Horizontal Form -->
            <form
                action="/supliers/{{ $suplier->id }}{{ str_replace('/supliers/' . $suplier->id . '/edit', '', request()->getRequestUri()) }}"
                method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Furniture</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama lengkap<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="nama lengkap" value="{{ $suplier->name }}" autofocus autocomplete="off"
                                    required>
                                @error('name')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="email" value="{{ $suplier->email }}"autocomplete="off">
                                @error('email')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">No. Telepon</label>
                            <div class="col-sm-10">
                                <input type="number" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="nomor telepon" value="{{ $suplier->phone }}"autocomplete="off"
                                    min="0">
                                @error('phone')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="address" name="address"
                                    class="form-control @error('address') is-invalid @enderror" id="address"
                                    placeholder="alamat" value="{{ $suplier->address }}"autocomplete="off">
                                @error('address')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/supliers/{{ $suplier->id . str_replace('/supliers/' . $suplier->id . '/edit', '', request()->getRequestUri()) }}"
                                class="btn btn-danger mr-1">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
