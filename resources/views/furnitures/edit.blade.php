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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit
                    furniture
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <form class="form" action="/furnitures/{{ $furniture->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Image</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url({{ $furniture->furniture_images[0]->url }})">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{ $furniture->furniture_images[0]->url }})"></div>
                                <!--end::Preview existing avatar-->
                            </div>
                            <!--end::Image input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm required fw-semibold fs-6">Name</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid" name="name"
                                placeholder="name furnitures" autocomplete="off" value="{{ $furniture->name }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Description</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row ">
                            <textarea class="form-control form-control-sm form-control-solid" name="description" id="description" rows="3"
                                placeholder="description">{{ $furniture->description }}</textarea>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Certification</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid"
                                name="certification" placeholder="certification" autocomplete="off"
                                value="{{ $furniture->certification ?? 'V-Legal Wood' }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Qty/month</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row ">
                            <input type="number" class="form-control form-control-sm form-control-solid"
                                name="qty_per_month" placeholder="qty/month" autocomplete="off"
                                value="{{ $furniture->qty_per_month }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">MOQ</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="number" class="form-control form-control-sm form-control-solid" name="moq"
                                placeholder="moq" autocomplete="off" value="{{ $furniture->moq }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>

        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Keyword</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid" name="keyword"
                                placeholder="keyword" autocomplete="off" value="{{ $furniture->keyword }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Size</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <!--begin::Options-->
                            <div class="d-flex align-items-center gap-3">
                                <!--begin::Option-->
                                <input type="number" class="form-control form-control-sm form-control-solid"
                                    name="length" placeholder="length" autocomplete="off"
                                    value="{{ $furniture->length }}">
                                <!--end::Option-->
                                <!--begin::Option-->
                                <input type="number" class="form-control form-control-sm form-control-solid"
                                    name="width" placeholder="width" autocomplete="off"
                                    value="{{ $furniture->width }}">
                                <!--end::Option-->
                                <!--begin::Option-->
                                <input type="number" class="form-control form-control-sm form-control-solid"
                                    name="height" placeholder="height" autocomplete="off"
                                    value="{{ $furniture->height }}">
                                <!--end::Option-->
                            </div>
                            <!--end::Options-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Featured</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <!--begin::Options-->
                            <div class="d-flex align-items-center">
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid me-10">
                                    <input class="form-check-input" name="convertible" type="checkbox" value="1"
                                        {{ $furniture->convertible ? 'checked' : '' }} />
                                    <span class="fw-semibold ps-2 fs-6">Convertible</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid me-10">
                                    <input class="form-check-input" name="adjustable" type="checkbox" value="1"
                                        {{ $furniture->adjustable ? 'checked' : '' }} />
                                    <span class="fw-semibold ps-2 fs-6">Adjustable</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid me-10">
                                    <input class="form-check-input" name="folded" type="checkbox" value="1"
                                        {{ $furniture->folded ? 'checked' : '' }} />
                                    <span class="fw-semibold ps-2 fs-6">Folded</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                    <input class="form-check-input" name="extendable" type="checkbox" value="1"
                                        {{ $furniture->extendable ? 'checked' : '' }} />
                                    <span class="fw-semibold ps-2 fs-6">Extendable</span>
                                </label>
                                <!--end::Option-->
                            </div>
                            <!--end::Options-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>

        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Price</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="number" class="form-control form-control-sm form-control-solid" name="price"
                                placeholder="price" autocomplete="off" value="{{ $furniture->price }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Payment
                            options</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select class="form-select form-select-sm form-select-solid mb-2" data-control="select2"
                                data-hide-search="true" data-placeholder="Select an option" id="payment_options_id"
                                name="payment_options">
                                <option></option>
                                <option value="dp"
                                    {{ $furniture->payment_options == 'dp' || !$furniture->payment_options ? 'selected' : '' }}>
                                    DP
                                </option>
                                <option value="full" {{ $furniture->payment_options == 'full' ? 'selected' : '' }}>
                                    Full payment</option>
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Payment terms</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid"
                                name="payment_terms" placeholder="payment_terms" autocomplete="off"
                                value="{{ $furniture->payment_terms ?? 'DP 50%' }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Delivery
                            options</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select class="form-select form-select-sm form-select-solid mb-2" data-control="select2"
                                data-hide-search="true" data-placeholder="Select an option" id="delivery_terms_id"
                                name="delivery_terms">
                                <option></option>
                                <option value="fob"
                                    {{ $furniture->delivery_terms == 'fob' || !$furniture->delivery_terms ? 'selected' : '' }}>
                                    FOB
                                </option>
                                <option value="exw" {{ $furniture->delivery_terms == 'exw' ? 'selected' : '' }}>
                                    EXW</option>
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Delivery time</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid"
                                name="delivery_time" placeholder="delivery time" autocomplete="off"
                                value="{{ $furniture->delivery_time }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Lead time</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid"
                                name="lead_time" placeholder="lead time" autocomplete="off"
                                value="{{ $furniture->lead_time }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Packages</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select class="form-select form-select-sm form-select-solid mb-2" data-control="select2"
                                data-hide-search="true" data-placeholder="Select an option" id="packing_id"
                                name="packing">
                                <option></option>
                                <option value="corrugated paper"
                                    {{ $furniture->packing == 'corrugated paper' || !$furniture->packing ? 'selected' : '' }}>
                                    Corrugated paper
                                </option>
                                <option value="box" {{ $furniture->packing == 'box' ? 'selected' : '' }}>
                                    BOX</option>
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Port</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid" name="port"
                                placeholder="port" autocomplete="off" value="{{ $furniture->port }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ request('index') ? '/furnitures' : '/furnitures/' . $furniture->id }}"
                        class="btn btn-dark btn-sm me-2">Cancel</a>
                    <button type="reset" class="btn btn-warning btn-sm me-2">Reset</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save change</button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Content-->
        </div>

    </form>
@endsection
