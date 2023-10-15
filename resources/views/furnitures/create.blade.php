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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Add furniture
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <form class="form" action="/furnitures" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6 required">Image</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('/metronic/media/svg/avatars/blank.svg')">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url(/metronic/media/svg/avatars/blank.svg)"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="image[]" accept=".png, .jpg, .jpeg" multiple />
                                    <input type="hidden" name="image_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            <!--end::Hint-->
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
                                placeholder="name furnitures" autocomplete="off" value="{{ old('name') }}">
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
                                placeholder="description">{{ old('description') }}</textarea>
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
                                value="{{ old('certification') ?? 'V-Legal Wood' }}">
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
                                value="{{ old('qty_per_month') }}">
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
                                placeholder="moq" autocomplete="off" value="{{ old('moq') }}">
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
                        <label class="col-lg-4 col-form-label col-form-label-sm required fw-semibold fs-6">Category</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select class="form-select form-select-sm form-select-solid mb-2" data-control="select2"
                                data-hide-search="true" data-placeholder="Select an option" id="category_id"
                                name="category_id">
                                <option></option>
                                <option value="{{ $categories[0]->id }}"
                                    {{ old('category_id') == $categories[0]->id || !old('category_id') ? 'selected' : '' }}>
                                    {{ $categories[0]->name }}
                                </option>
                                @foreach ($categories->skip(1) as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm required fw-semibold fs-6">Meterial</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row ">
                            <select class="form-select form-select-sm form-select-solid mb-2" data-control="select2"
                                data-placeholder="Select an material option" data-allow-clear="true" multiple="multiple"
                                name="material_id[]">
                                <option></option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}"
                                        {{ old('material_id') && in_array($material->id, old('material_id')) ? 'selected' : '' }}>
                                        {{ $material->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label
                            class="col-lg-4 col-form-label col-form-label-sm required fw-semibold fs-6">Finishing</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row ">
                            <select class="form-select form-select-sm form-select-solid mb-2" data-control="select2"
                                data-placeholder="Select an finishing option" data-allow-clear="true" multiple="multiple"
                                name="finishing_id[]">
                                <option></option>
                                @foreach ($finishings as $finishing)
                                    <option value="{{ $finishing->id }}"
                                        {{ old('finishing_id') && in_array($finishing->id, old('finishing_id')) ? 'selected' : '' }}>
                                        {{ $finishing->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label
                            class="col-lg-4 col-form-label col-form-label-sm required fw-semibold fs-6">Application</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row ">
                            <select class="form-select form-select-sm form-select-solid mb-2" data-control="select2"
                                data-placeholder="Select an application option" data-allow-clear="true"
                                multiple="multiple" name="application_id[]">
                                <option></option>
                                @foreach ($applications as $application)
                                    <option value="{{ $application->id }}"
                                        {{ old('application_id') && in_array($application->id, old('application_id')) ? 'selected' : '' }}>
                                        {{ $application->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Keyword</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="text" class="form-control form-control-sm form-control-solid" name="keyword"
                                placeholder="keyword" autocomplete="off" value="{{ old('keyword') }}">
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
                                    name="length" placeholder="length" autocomplete="off" value="{{ old('length') }}">
                                <!--end::Option-->
                                <!--begin::Option-->
                                <input type="number" class="form-control form-control-sm form-control-solid"
                                    name="width" placeholder="width" autocomplete="off" value="{{ old('width') }}">
                                <!--end::Option-->
                                <!--begin::Option-->
                                <input type="number" class="form-control form-control-sm form-control-solid"
                                    name="height" placeholder="height" autocomplete="off" value="{{ old('height') }}">
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
                                        {{ old('convertible') ? 'checked' : '' }} />
                                    <span class="fw-semibold ps-2 fs-6">Convertible</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid me-10">
                                    <input class="form-check-input" name="adjustable" type="checkbox" value="1"
                                        {{ old('adjustable') ? 'checked' : '' }} />
                                    <span class="fw-semibold ps-2 fs-6">Adjustable</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid me-10">
                                    <input class="form-check-input" name="folded" type="checkbox" value="1"
                                        {{ old('folded') ? 'checked' : '' }} />
                                    <span class="fw-semibold ps-2 fs-6">Folded</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                    <input class="form-check-input" name="extendable" type="checkbox" value="1"
                                        {{ old('extendable') ? 'checked' : '' }} />
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
                        <label class="col-lg-4 col-form-label col-form-label-sm fw-semibold fs-6">Price <span
                                class="badge badge-light-success">$</span></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg fv-row ">
                            <input type="number" class="form-control form-control-sm form-control-solid" name="price"
                                placeholder="price" autocomplete="off" value="{{ old('price') }}">
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
                                    {{ old('payment_options') == 'dp' || !old('payment_options') ? 'selected' : '' }}>
                                    DP
                                </option>
                                <option value="full" {{ old('payment_options') == 'full' ? 'selected' : '' }}>
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
                                value="{{ old('payment_terms') ?? 'DP 50%' }}">
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
                                    {{ old('delivery_terms') == 'fob' || !old('delivery_terms') ? 'selected' : '' }}>
                                    FOB
                                </option>
                                <option value="exw" {{ old('delivery_terms') == 'exw' ? 'selected' : '' }}>
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
                                value="{{ old('delivery_time') }}">
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
                                value="{{ old('lead_time') }}">
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
                                    {{ old('packing') == 'corrugated paper' || !old('packing') ? 'selected' : '' }}>
                                    Corrugated paper
                                </option>
                                <option value="box" {{ old('packing') == 'box' ? 'selected' : '' }}>
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
                                placeholder="port" autocomplete="off" value="{{ old('port') ?? 'Tanjung mas' }}">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="/furnitures" class="btn btn-dark btn-sm me-2">Cancel</a>
                    <button type="reset" class="btn btn-warning btn-sm me-2">Reset</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Content-->
        </div>

    </form>
@endsection
