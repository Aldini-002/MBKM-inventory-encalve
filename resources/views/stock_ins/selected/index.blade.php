@extends('layouts.main') @section('content')
    <div class="col-lg-12 mb-3">
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pb-3 pb-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Choose
                    furnitures
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <form action="/stock_ins_selected/cancel" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm fw-bold btn-danger">Cancel</button>
                </form>
                <a href="/stock_ins/create" class="btn btn-sm fw-bold btn-primary">Next</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!-- ========== Start table furnitures ========== -->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="card-title fs-3 fw-bold text-gray-600">
                Furnitures selected
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-700 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-300px">Info</th>
                            <th class="min-w-125px">Category</th>
                            <th class="min-w-125px">Stock</th>
                            <th class="min-w-200px">Size</th>
                            <th class="min-w-125px">Price</th>
                            <th class="min-w-200px text-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($stock_ins_selected as $data)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="symbol symbol-50px">
                                            <span class="symbol-label"
                                                style="background-image:url({{ $data->furniture->furniture_images[0]->url }});">
                                            </span>
                                        </span>
                                        <div class="d-flex justify-content-start flex-column ms-5">
                                            <span
                                                class="text-gray-700 fw-bold mb-1 fs-6">{{ $data->furniture->name }}</span>
                                            <span
                                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $data->furniture->code }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="text-gray-700 fw-bold d-block fs-6">{{ $data->furniture->category->name }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6">{{ $data->furniture->stock }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6">{{ $data->furniture->size }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6">{{ $data->furniture->price }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <form action="/stock_ins_selected/{{ $data->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger fw-bold btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!-- ========== End table furnitures ========== -->

    <!-- ========== Start table furnitures ========== -->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">
            <form action="/furnitures" method="get" class="w-100">
                <div class="row py-lg-5">
                    <div class="col-lg">
                        <input type="text" class="form-control form-control-sm form-control-solid"
                            placeholder="Search name" name="name" autocomplete="off" value='{{ request('name') }}' />
                    </div>
                    <div class="col-lg">
                        <input type="text" class="form-control form-control-sm form-control-solid"
                            placeholder="Search code" name="code" autocomplete="off" value='{{ request('code') }}' />
                    </div>
                    <div class="col-lg">
                        <div class="d-flex gap-2">
                            <a href="/stock_ins/choose_furniture" class="btn btn-sm btn-danger">Reset</a>
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-title fs-3 fw-bold text-gray-600">
                Furnitures List
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-700 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-300px">Info</th>
                            <th class="min-w-125px">Category</th>
                            <th class="min-w-125px">Stock</th>
                            <th class="min-w-200px">Size</th>
                            <th class="min-w-125px">Price</th>
                            <th class="min-w-200px text-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($furnitures as $furniture)
                            <tr class="{{ $furniture->stock_in_selected ? 'd-none' : '' }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="symbol symbol-50px">
                                            <span class="symbol-label"
                                                style="background-image:url({{ $furniture->furniture_images[0]->url }});">
                                            </span>
                                        </span>
                                        <div class="d-flex justify-content-start flex-column ms-5">
                                            <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $furniture->name }}</span>
                                            <span
                                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $furniture->code }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="text-gray-700 fw-bold d-block fs-6">{{ $furniture->category->name }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6">{{ $furniture->stock }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6">{{ $furniture->size }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6">{{ $furniture->price }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <form action="/stock_ins_selected" method="POST">
                                            @csrf
                                            <input type="hidden" name="furniture_id" value="{{ $furniture->id }}">
                                            <button type="submit" class="btn btn-primary fw-bold btn-sm">Select</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!-- ========== End table furnitures ========== -->
@endsection
