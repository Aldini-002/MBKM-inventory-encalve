@extends('layouts.main')
@section('content')
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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Stock out
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                    <a href="#" onclick="return alert('masih dalam tahap pengembangan')"
                        class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold">
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
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Status:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" data-kt-select2="true"
                                        data-placeholder="Select option" data-dropdown-parent="#kt_menu_63de6c5e04f34"
                                        data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Approved</option>
                                        <option value="2">Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Member Type:</label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="d-flex">
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <!--end::Options-->
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                    <!--end::Options-->
                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Notifications:</label>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications"
                                        checked="checked" />
                                    <label class="form-check-label">Enabled</label>
                                </div>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="/stock_outs_selected" class="btn btn-sm fw-bold btn-primary">Stock out</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-700 align-middle gs-0 gy-4 mt-5">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-300px">Info</th>
                            <th class="min-w-125px text-end">Buyer</th>
                            <th class="min-w-125px text-end">Initial stock</th>
                            <th class="min-w-125px text-end">Stock out</th>
                            <th class="min-w-125px text-end">Final stock</th>
                            <th class="min-w-125px text-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($buyers as $data)
                            <tr>
                                <td colspan="5"><span class="badge badge-light-success">{{ $data->created_at }}</span>
                                </td>
                                <td class="text-end"><a href="#"
                                        onclick="return alert('masih dalam tahap pengembangan')"
                                        class="btn btn-light-primary btn-sm">View details</a>
                                </td>
                            </tr>
                            @foreach ($data->stock_outs as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="symbol symbol-50px">
                                                <span class="symbol-label"
                                                    style="background-image:url({{ $data->furniture->furniture_images[0]->url }});">
                                                </span>
                                            </span>
                                            <div class="d-flex justify-content-start flex-column ms-5">
                                                <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $data->name }}</span>
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $data->furniture->code }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="text-gray-700 fw-bold d-block fs-6 text-end">{{ $data->buyer->name }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="text-primary fw-bold d-block fs-6 text-end">{{ $data->initial_stock }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold d-block fs-6 text-end">{{ $data->amount }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="text-danger fw-bold d-block fs-6 text-end">{{ $data->final_stock }}</span>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
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
@endsection
