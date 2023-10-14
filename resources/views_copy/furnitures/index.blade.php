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
    </div>

    <div class="col-lg-12 mb-5">
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

    <div class="card p-5">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr>
                        <th colspan="7">
                            <form action="/furnitures" method="get">
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                            name="search" id="search" placeholder="Name or code product"
                                            value="{{ request('search') }}" />
                                    </div>
                                    {{--
                                <div class="col-md">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm form-control-solid"
                                        name="code"
                                        id="code"
                                        placeholder="Code product"
                                        value="{{ request('code') }}"
                                    />
                                </div>
                                --}}
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
                            <a href="/furnitures/create" class="btn btn-primary btn-sm">Create product</a>
                        </th>
                    </tr>

                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-200px">Product</th>
                        <th class="text-end min-w-100px">Category</th>
                        <th class="text-end min-w-100px">Size</th>
                        <th class="text-end min-w-100px">Stock</th>
                        <th class="text-end min-w-100px">Price</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-semibold text-gray-600">
                    <!--begin::Table row-->
                    @if (!$furnitures->count())
                        <tr>
                            <td colspan="7" class="fw-bold text-center">
                                Data nof found!
                            </td>
                        </tr>
                        @endif @foreach ($furnitures as $furniture)
                            <tr>
                                <!--begin::Name=-->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin::Thumbnail-->
                                        <span class="symbol symbol-50px">
                                            <span class="symbol-label"
                                                style="background-image:url({{ $furniture->furniture_images[0]->url }});"></span>
                                        </span>
                                        <!--end::Thumbnail-->
                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="/furnitures/{{ $furniture->id }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                data-kt-ecommerce-product-filter="product_name">{{ $furniture->name }}</a>
                                            <div>
                                                <span class="fw-bold">{{ $furniture->code }}</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <!--end::Name=-->
                                <!--begin::Category=-->
                                <td class="text-end pe-0">
                                    <span class="fw-bold">{{ $furniture->category->name }}</span>
                                </td>
                                <!--end::Category=-->
                                <!--begin::Size=-->
                                <td class="text-end pe-0">
                                    <span class="fw-bold">{{ $furniture->size ?? '-' }}</span>
                                </td>
                                <!--end::Size=-->
                                <!--begin::Qty=-->
                                <td class="text-end pe-0" data-order="1">
                                    <div class="d-flex justify-content-end align-items-center gap-1">
                                        <span class="fw-bold ms-3">{{ $furniture->stock > 0 ? $furniture->stock : '0' }} |
                                        </span>
                                        <a href="#" class="badge badge-warning text-dark" data-bs-toggle="modal"
                                            data-bs-target="#stock{{ $furniture->id }}"
                                            id="btn_edit_stock{{ $furniture->id }}">edit stock</a>
                                    </div>
                                </td>
                                <!--end::Qty=-->
                                <!--begin::Price=-->
                                <td class="text-end pe-0">
                                    {{ $furniture->price ? $furniture->price : '-' }}
                                </td>
                                <!--end::Price=-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <form action="/furnitures/{{ $furniture->id }}" method="POST">
                                        @csrf @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger px-3"
                                            onclick="return confirm('Delete {{ $furniture->name }}')">
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

    <!-- ========== Start modal stock ========== -->
    @foreach ($furnitures as $furniture)
        <div class="modal fade" id="stock{{ $furniture->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="stock{{ $furniture->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-md modal-dialog-centered">
                <div class="modal-content">
                    <form action="/stocks" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="stock{{ $furniture->id }}Label">
                                Edit stock
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="furniture_id" value="{{ $furniture->id }}">
                            <div class="mb-10">
                                <div class="d-flex align-items-center">
                                    <!--begin::Thumbnail-->
                                    <span class="symbol symbol-50px">
                                        <span class="symbol-label"
                                            style="background-image:url(/img/furnitures/{{ $furniture->image }});"></span>
                                    </span>
                                    <!--end::Thumbnail-->
                                    <div class="ms-5">
                                        <!--begin::Title-->
                                        <a href="/furnitures/{{ $furniture->id }}"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                            data-kt-ecommerce-product-filter="product_name">{{ $furniture->name }}</a>
                                        <div>
                                            <span class="text-gray-500">{{ $furniture->code }}</span>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-10">
                                        <label for="stock_initial " class="form-label">Stock awal</label>
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                            name="stock_initial" id="stock_initial{{ $furniture->id }}"
                                            autocomplete="off" value="{{ $furniture->stock }}" readonly />
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-10">
                                        <label for="stock_final" class="form-label">Stock akihr</label>
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid fw-bold"
                                            name="stock_final" id="stock_final{{ $furniture->id }}" autocomplete="off"
                                            value="{{ $furniture->stock }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <div class="input-group input-group-sm">
                                    <button class="btn btn-danger btn-sm" type="button"
                                        id="stock_reduce{{ $furniture->id }}">
                                        -
                                    </button>
                                    <input type="number"
                                        class="form-control form-control-sm form-control-solid fw-bold text-center"
                                        placeholder="" id="stock_adjustment{{ $furniture->id }}"
                                        name="stock_adjustment" />
                                    <button class="btn btn-success btn-sm" type="button"
                                        id="stock_add{{ $furniture->id }}">
                                        +
                                    </button>
                                </div>
                            </div>
                            <div class="mb-10" id="input_suplier{{ $furniture->id }}">
                            </div>
                            <div class="mb-10" id="input_buyer{{ $furniture->id }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const stock_initial{{ $furniture->id }} = document.querySelector("#stock_initial{{ $furniture->id }}");
            const stock_final{{ $furniture->id }} = document.querySelector("#stock_final{{ $furniture->id }}");
            const stock_reduce{{ $furniture->id }} = document.querySelector("#stock_reduce{{ $furniture->id }}");
            const stock_add{{ $furniture->id }} = document.querySelector("#stock_add{{ $furniture->id }}");
            const stock_adjustment{{ $furniture->id }} = document.querySelector("#stock_adjustment{{ $furniture->id }}");
            const suplier{{ $furniture->id }} = document.querySelector("#input_suplier{{ $furniture->id }}");
            const buyer{{ $furniture->id }} = document.querySelector("#input_buyer{{ $furniture->id }}");
            const btn_edit_stock{{ $furniture->id }} = document.querySelector("#btn_edit_stock{{ $furniture->id }}");

            if (!stock_adjustment{{ $furniture->id }}.value.length) stock_adjustment{{ $furniture->id }}.value = 0

            stock_add{{ $furniture->id }}.addEventListener('click', (e) => {
                e.preventDefault()

                stock_adjustment{{ $furniture->id }}.value = parseInt(stock_adjustment{{ $furniture->id }}.value) + 1
                stock_final{{ $furniture->id }}.value = parseInt(stock_initial{{ $furniture->id }}.value) + parseInt(
                    stock_adjustment{{ $furniture->id }}.value)

                if (stock_adjustment{{ $furniture->id }}.value == 0) {
                    suplier{{ $furniture->id }}.innerHTML = ''
                    buyer{{ $furniture->id }}.innerHTML = ''
                }
                if (stock_adjustment{{ $furniture->id }}.value < 0) {
                    suplier{{ $furniture->id }}.innerHTML = ''
                    buyer{{ $furniture->id }}.innerHTML =
                        `<label for="buyer" class="form-label">Buyer</label>
                        <input
                        type="text"
                        class="form-control form-control-sm form-control-solid"
                        name="buyer"
                        id="buyer"
                        value="{{ old('buyer') }}"
                            placeholder='buyer information...'
                        autocomplete="off"
                        />`
                }
                if (stock_adjustment{{ $furniture->id }}.value > 0) {
                    buyer{{ $furniture->id }}.innerHTML = ''
                    suplier{{ $furniture->id }}.innerHTML =
                        `<label for="suplier" class="form-label">Suplier</label>
                        <input
                        type="text"
                        class="form-control form-control-sm form-control-solid"
                        name="suplier"
                        id="suplier"
                        value="{{ old('suplier') }}"
                            placeholder='suplier information...'
                        autocomplete="off"
                        />`
                }
            })

            stock_reduce{{ $furniture->id }}.addEventListener('click', (e) => {
                e.preventDefault()

                if (stock_final{{ $furniture->id }}.value <= 0) return alert('cannot reduce again')
                stock_adjustment{{ $furniture->id }}.value = parseInt(stock_adjustment{{ $furniture->id }}.value) - 1
                stock_final{{ $furniture->id }}.value = parseInt(stock_initial{{ $furniture->id }}.value) + parseInt(
                    stock_adjustment{{ $furniture->id }}.value)

                if (stock_adjustment{{ $furniture->id }}.value == 0) {
                    suplier{{ $furniture->id }}.innerHTML = ''
                    buyer{{ $furniture->id }}.innerHTML = ''
                }
                if (stock_adjustment{{ $furniture->id }}.value < 0) {
                    suplier{{ $furniture->id }}.innerHTML = ''
                    buyer{{ $furniture->id }}.innerHTML =
                        `<label for="buyer" class="form-label">Buyer</label>
                        <input
                            type="text"
                            class="form-control form-control-sm form-control-solid"
                            name="buyer"
                            id="buyer"
                            value="{{ old('buyer') }}"
                            placeholder='buyer information...'
                            autocomplete="off"
                        />`
                }
                if (stock_adjustment{{ $furniture->id }}.value > 0) {
                    buyer{{ $furniture->id }}.innerHTML = ''
                    suplier{{ $furniture->id }}.innerHTML =
                        `<label for="suplier" class="form-label">Suplier</label>
                        <input
                            type="text"
                            class="form-control form-control-sm form-control-solid"
                            name="suplier"
                            id="suplier"
                            value="{{ old('suplier') }}"
                            placeholder='suplier information...'
                            autocomplete="off"
                        />`
                }
            })

            stock_adjustment{{ $furniture->id }}.addEventListener('change', (e) => {
                e.preventDefault()

                stock_final{{ $furniture->id }}.value = parseInt(stock_initial{{ $furniture->id }}.value) + parseInt(
                    stock_adjustment{{ $furniture->id }}.value)

                if (!stock_adjustment{{ $furniture->id }}.value.length) {
                    stock_adjustment{{ $furniture->id }}.value = 0
                    stock_final{{ $furniture->id }}.value = stock_initial{{ $furniture->id }}.value
                }

                if (stock_final{{ $furniture->id }}.value < 0) {
                    stock_adjustment{{ $furniture->id }}.value = parseInt(-stock_initial{{ $furniture->id }}.value)
                    stock_final{{ $furniture->id }}.value = parseInt(stock_initial{{ $furniture->id }}.value) +
                        parseInt(stock_adjustment{{ $furniture->id }}.value)

                    suplier{{ $furniture->id }}.innerHTML = ''
                    buyer{{ $furniture->id }}.innerHTML =
                        `<label for="buyer" class="form-label">Buyer</label>
                        <input
                            type="text"
                            class="form-control form-control-sm form-control-solid"
                            name="buyer"
                            id="buyer"
                            value="{{ old('buyer') }}"
                            placeholder='buyer information...'
                            autocomplete="off"
                        />`

                    return alert('cannot reduce again')
                }

                if (stock_adjustment{{ $furniture->id }}.value == 0) {
                    suplier{{ $furniture->id }}.innerHTML = ''
                    buyer{{ $furniture->id }}.innerHTML = ''
                }
                if (stock_adjustment{{ $furniture->id }}.value < 0) {
                    suplier{{ $furniture->id }}.innerHTML = ''
                    buyer{{ $furniture->id }}.innerHTML =
                        `<label for="buyer" class="form-label">Buyer</label>
                        <input
                            type="text"
                            class="form-control form-control-sm form-control-solid"
                            name="buyer"
                            id="buyer"
                            value="{{ old('buyer') }}"
                            placeholder='buyer information...'
                            autocomplete="off"
                        />`
                }
                if (stock_adjustment{{ $furniture->id }}.value > 0) {
                    buyer{{ $furniture->id }}.innerHTML = '';
                    suplier{{ $furniture->id }}.innerHTML =
                        `<label for="suplier" class="form-label">Suplier</label>
                        <input
                            type="text"
                            class="form-control form-control-sm form-control-solid"
                            name="suplier"
                            id="suplier"
                            value="{{ old('suplier') }}"
                            placeholder='suplier information...'
                            autocomplete="off"
                            />`;
                }
            })
        </script>
    @endforeach
    <!-- ========== End modal stock ========== -->
@endsection
