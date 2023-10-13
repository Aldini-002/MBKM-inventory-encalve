@extends('layouts.main') @section('content')
    <div class="col-lg-12 mb-3">
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif @if (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
    </div>

    <div class="card p-5">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr>
                        <th colspan="7">
                            <form action="/stocks" method="get">
                                <div class="row">
                                    <div class="col-md">
                                        <!-- ========== Start select category ========== -->
                                        <select class="form-select form-select-solid form-select-sm" data-control="select2"
                                            data-hide-search="true" data-placeholder="Select an option" id="stock"
                                            name="stock">
                                            <option value="stock_out"
                                                {{ request('stock') == 'stock_out' ? 'selected' : '' }}>
                                                Stock out
                                            </option>
                                            <option value="stock_in" {{ request('stock') == 'stock_in' ? 'selected' : '' }}>
                                                Stock in
                                            </option>
                                        </select>
                                        <!-- ========== End select category ========== -->
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-info w-100 btn-sm">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="7">
                            <a href="/furnitures" class="btn btn-primary btn-sm">Adjustment stock</a>
                        </th>
                    </tr>

                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-200px">Product</th>
                        <th class="text-end min-w-100px">Suplier</th>
                        <th class="text-end min-w-100px">Stock
                            {{ request('stock') == 'stock_in' ? 'ditambahkan' : 'dikurangi' }}</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-semibold text-gray-600">
                    <!--begin::Table row-->
                    @if (!$stocks->count())
                        <tr>
                            <td colspan="7" class="fw-bold text-center">
                                Data nof found!
                            </td>
                        </tr>
                        @endif @foreach ($stocks as $data)
                            <tr>
                                <!--begin::Name=-->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin::Thumbnail-->
                                        <span class="symbol symbol-50px">
                                            <span class="symbol-label"
                                                style="background-image:url(/img/furnitures/{{ $data->furniture->image }});"></span>
                                        </span>
                                        <!--end::Thumbnail-->
                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="/furnitures/{{ $data->id }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                data-kt-ecommerce-product-filter="product_name">{{ $data->furniture->name }}</a>
                                            <div>
                                                <small class="text-gray-600">{{ $data->furniture->code }}</small>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <!--end::Name=-->
                                <!--begin::SKU=-->
                                <td class="text-end pe-0">
                                    <span class="fw-bold"
                                        id="stock_initial">{{ request('stock') == 'stock_in' ? $data->suplier : $data->buyer }}</span>
                                </td>
                                <!--end::SKU=-->
                                <!--begin::Category=-->
                                <td class="text-end pe-0">
                                    <span class="fw-bold" id="stock_initial">{{ $data->qty }}</span>
                                </td>
                                <!--end::Category=-->
                                <!--begin::Size=-->
                                {{-- <td class="text-center pe-0">
                        <span class="fw-bold" id="stock_initial">{{$data->qty}}</span>
                    </td> --}}
                                <!--end::Size=-->
                                <!--begin::Size=-->
                                {{-- <td class="text-center pe-0">
                        <span class="fw-bold" id="stock_final">{{$data->}}</span>
                    </td> --}}
                                <!--end::Size=-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <form action="/stocks/{{ $data->id }}?stock={{ request('stock') }}"
                                        method="POST">
                                        @csrf @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger px-3"
                                            onclick="return confirm('Delete history {{ $data->furniture->name }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <!--end::Action=-->
                            </tr>
                        @endforeach
                        <!--end::Table row-->
                </tbody>
                <!--end::Table body-->
            </table>
        </div>
        <!--end::Table-->
    </div>
@endsection
