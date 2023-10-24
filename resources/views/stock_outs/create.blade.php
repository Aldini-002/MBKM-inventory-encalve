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
    <form action="/stock_outs" method="post">
        @csrf
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
                    <!--begin::Primary button-->
                    <a href="/stock_outs_selected" class="btn btn-sm fw-bold btn-danger">Back</a>
                    <button type="submit" class="btn btn-sm fw-bold btn-primary">Stock out</button>
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
                <div class="row py-lg-5">
                    <div class="col-lg-2">
                        <label class="col-form-label col-form-label-sm">Buyer</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="buyer"
                            name="buyer" autocomplete="off" value='{{ old('buyer') }}' />
                    </div>
                </div>
                <div class="row py-lg-5">
                    <div class="col-lg-2">
                        <label class="col-form-label col-form-label-sm">Description</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="description" rows="3" autocomplete="off" class="form-control form-control-sm form-control-solid"
                            placeholder="description">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <!--begin::Body-->
        </div>
        <!-- ========== End table furnitures ========== -->
        <!-- ========== Start table furnitures ========== -->
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
                                <th class="min-w-125px text-center">Initial stock</th>
                                <th class="min-w-125px text-center">Stock out</th>
                                <th class="min-w-125px text-center">Final stock</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($stock_outs_selected as $data)
                                <input type="hidden" name="furniture_id[]" value="{{ $data->furniture->id }}">
                                <input type="hidden" name="name[]" value="{{ $data->furniture->name }}">
                                <input type="hidden" name="price[]" value="{{ $data->furniture->price }}">
                                <input type="hidden" name="initial_stock[]" value="{{ $data->furniture->stock }}">
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
                                        <span class="text-primary fw-bold d-block fs-6 text-center"
                                            id="initial_stock_{{ $data->id }}">{{ $data->furniture->stock }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="number"
                                                class="text-dark form-control form-control-sm form-control-solid text-center"
                                                name="amount[]" id="amount_{{ $data->id }}" placeholder="amount"
                                                autocomplete="off" value="0">
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-danger fw-bold d-block fs-6 text-center"
                                            id="final_stock_{{ $data->id }}">{{ $data->furniture->stock }}</span>
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
    </form>
    <!-- ========== End table furnitures ========== -->

    @foreach ($stock_outs_selected as $data)
        <script>
            const initial_stock_{{ $data->id }} = document.querySelector('#initial_stock_{{ $data->id }}')
            const final_stock_{{ $data->id }} = document.querySelector('#final_stock_{{ $data->id }}')
            const amount_{{ $data->id }} = document.querySelector('#amount_{{ $data->id }}')

            amount_{{ $data->id }}.addEventListener('change', function(e) {
                e.preventDefault()

                final_stock_{{ $data->id }}.innerHTML = parseInt(initial_stock_{{ $data->id }}.innerHTML) -
                    parseInt(amount_{{ $data->id }}.value ?? 0)


                if (final_stock_{{ $data->id }}.innerHTML < 0) {
                    final_stock_{{ $data->id }}.innerHTML = parseInt(0)
                    amount_{{ $data->id }}.value = parseInt(initial_stock_{{ $data->id }}.innerHTML)
                }

                if (parseInt(final_stock_{{ $data->id }}.innerHTML) > parseInt(initial_stock_{{ $data->id }}
                        .innerHTML)) {
                    final_stock_{{ $data->id }}.innerHTML = parseInt(initial_stock_{{ $data->id }}.innerHTML)
                    amount_{{ $data->id }}.value = parseInt(0)
                }
            })

            amount_{{ $data->id }}.addEventListener('keyup', function(e) {
                e.preventDefault()

                final_stock_{{ $data->id }}.innerHTML =
                    parseInt(initial_stock_{{ $data->id }}.innerHTML) - parseInt(amount_{{ $data->id }}
                        .value ?? 0)

                if (final_stock_{{ $data->id }}.innerHTML < 0) {
                    final_stock_{{ $data->id }}.innerHTML = parseInt(0)
                    amount_{{ $data->id }}.value = parseInt(initial_stock_{{ $data->id }}.innerHTML)
                }

                if (parseInt(final_stock_{{ $data->id }}.innerHTML) > parseInt(initial_stock_{{ $data->id }}
                        .innerHTML)) {
                    final_stock_{{ $data->id }}.innerHTML = parseInt(initial_stock_{{ $data->id }}.innerHTML)
                    amount_{{ $data->id }}.value = parseInt(0)
                }
            })
        </script>
    @endforeach
@endsection
