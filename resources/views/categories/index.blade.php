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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Categories
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                {{-- <div class="m-0">
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
                        <form action="/categories" method="get">
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Categories:</label>
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
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <a href="/categories"
                                        class="btn btn-sm btn-light btn-active-light-primary me-2">Reset</a>
                                    <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div> --}}
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="/categories/create" class="btn btn-sm fw-bold btn-primary">Add category</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!-- ========== Start table categories ========== -->
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
                            <th class="ps-4 min-w-125px">#</th>
                            <th class="min-w-125px text-end">Category</th>
                            <th class="min-w-125px text-end">Code</th>
                            <th class="min-w-125px text-end">Total</th>
                            <th class="min-w-200px text-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($categories as $i => $data)
                            <tr>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6 ps-4">{{ $i += 1 }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6 text-end">{{ $data->name }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6 text-end">{{ $data->id }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-700 fw-bold d-block fs-6 text-end"><span
                                            class="btn btn-sm btn-primary">{{ count($data->furnitures) }}
                                        </span>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <a href="/furnitures?category={{ strtolower($data->name) }}"
                                            class="btn btn-light-primary fw-bold btn-sm">View {{ count($data->furnitures) }}
                                            furnitures</a>
                                        <a href="/categories/edit/{{ $data->id }}?index=1"
                                            class="btn btn-light-warning fw-bold btn-sm">Edit</a>
                                        <form action="/categories/{{ $data->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Delete {{ $data->name }}')" type="submit"
                                                class="btn btn-light-danger fw-bold btn-sm">Delete</button>
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
    <!-- ========== End table categories ========== -->
@endsection
