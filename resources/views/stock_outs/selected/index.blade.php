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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Furniture
                    selected
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <form action="/stock_outs_selected/cancel" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm fw-bold btn-danger">Cancel</button>
                </form>
                <a href="/stock_outs/create" class="btn btn-sm fw-bold btn-primary">Next</a>
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
                            <th class="min-w-125px">Price <span class="text-success">$</span></th>
                            <th class="min-w-200px text-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($stock_outs_selected as $data)
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
                                    <span class="text-gray-700 fw-bold d-block fs-6"><span
                                            class="text-success">$</span>{{ number_format($data->furniture->price, 2) }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <form action="/stock_outs_selected/{{ $data->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-light-danger fw-bold btn-sm">Remove</button>
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

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pb-3 pb-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Furnitures
                    list
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                    <a href="#"
                        class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-solid fa-filter"></i>
                        Filter
                    </a>
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-100 w-md-500px" data-kt-menu="true"
                        id="kt_menu_63de6c5e04f34">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <form action="/stock_outs_selected" method="get">
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Name furnitures:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                            placeholder="Search name" name="name" autocomplete="off"
                                            value='{{ request('name') }}' />
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Code furnitures</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                            placeholder="Search code" name="code" autocomplete="off"
                                            value='{{ request('code') }}' />
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Categiries</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-sm form-select-solid"
                                            data-control="select2" data-hide-search="true" name="category">
                                            <option value="" {{ !request('category') ? 'selected' : '' }}>All
                                                categories</option>
                                            @foreach ($categories as $data)
                                                <option value="{{ strtolower($data->name) }}"
                                                    {{ request('category') == strtolower($data->name) ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <a href="/stock_outs_selected"
                                        class="btn btn-sm btn-light btn-active-light-primary me-2">Reset</a>
                                    <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Filter menu-->
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
                            <th class="min-w-125px">Price <span class="text-success">$</span></th>
                            <th class="min-w-200px text-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($furnitures as $furniture)
                            <tr class="{{ $furniture->stock_out_selected ? 'd-none' : '' }}">
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
                                    <span class="text-gray-700 fw-bold d-block fs-6"><span
                                            class="text-success">$</span>{{ number_format($furniture->price, 2) }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <form action="/stock_outs_selected" method="POST">
                                            @csrf
                                            <input type="hidden" name="furniture_id" value="{{ $furniture->id }}">
                                            <button type="submit"
                                                class="btn btn-light-primary fw-bold btn-sm">Select</button>
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
