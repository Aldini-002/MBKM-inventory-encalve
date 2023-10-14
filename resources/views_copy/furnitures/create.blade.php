@extends('layouts.main')
@section('content')
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

    <form action="/furnitures" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- ========== Start aside ========== -->
            <div class="col-lg-3 mb-5">
                <div class="card p-5">
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <!--begin::Image input placeholder-->
                        <style>
                            .image-input-placeholder {
                                background-image: url("/metronic/media/svg/files/blank-image.svg");
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url("/metronic/media/svg/files/blank-image-dark.svg");
                            }
                        </style>
                        <!--end::Image input placeholder-->
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-5"
                            data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                title="Change product thumbnail">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="image[]" multiple />
                                {{-- <input type="file" name="image[]" accept=".png, .jpg, .jpeg" multiple /> --}}
                                <input type="hidden" name="image_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">
                            Set the product thumbnail image. Only *.png, *.jpg
                            and *.jpeg image files are accepted
                        </div>
                        <!--end::Description-->
                    </div>
                </div>
            </div>
            <!-- ========== End aside ========== -->
            <div class="col-lg">
                <div class="row">
                    <!-- ========== Start main ========== -->
                    <div class="col-md-12 mb-5">
                        <!-- ========== Start card body main ========== -->
                        <div class="card p-5">
                            <!-- ========== Start input name ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label name ========== -->
                                <label class="form-label required" for="name">Name product</label>
                                <!-- ========== End label name ========== -->
                                <input type="text" class="form-control form-control-solid" id="name"
                                    placeholder="name product" autocomplete="off" autofocus name="name"
                                    value="{{ old('name') }}">
                            </div>
                            <!-- ========== End input name ========== -->
                            <!-- ========== Start input description ========== -->
                            <div class="mb-5">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control form-control-solid" placeholder="Description" id="description" style="height: 100px"
                                    name="description">{{ old('description') }}</textarea>
                            </div>
                            <!-- ========== End input description ========== -->
                            <!-- ========== Start input certification ========== -->
                            <div class=" mb-5">
                                <label for="certification" class="form-label">Certification product</label>
                                <input type="text" class="form-control form-control-solid" id="certification"
                                    placeholder="certification product" autocomplete="off" name="certification"
                                    value="{{ old('certification') ?? 'V-Legal Wood' }}">
                            </div>
                            <!-- ========== End input certification ========== -->
                            <div class="row">
                                <!-- ========== Start input qty/month ========== -->
                                <div class="col-md">
                                    <div class="mb-5">
                                        <label for="qty_per_month" class="form-label">Qty per month</label>
                                        <input type="number" class="form-control form-control-solid" id="qty_per_month"
                                            placeholder="qty per month" autocomplete="off" name="qty_per_month"
                                            value="{{ old('qty_per_month') }}">
                                    </div>
                                </div>
                                <!-- ========== End input qty/month ========== -->
                                <!-- ========== Start input moq ========== -->
                                <div class="col-md">
                                    <div class=" mb-5">
                                        <label for="moq" class="form-label">MOQ</label>
                                        <input type="number" class="form-control form-control-solid" id="moq"
                                            placeholder="MOQ" autocomplete="off" name="moq"
                                            value="{{ old('moq') }}">
                                    </div>
                                </div>
                                <!-- ========== End input moq ========== -->
                            </div>
                            <!-- ========== Start input weight ========== -->
                            <div class=" mb-5">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control form-control-solid" id="weight"
                                    placeholder="Weight" autocomplete="off" name="weight" value="{{ old('weight') }}">
                            </div>
                            <!-- ========== End input weight ========== -->
                        </div>
                        <!-- ========== End card body main ========== -->
                    </div>
                    <!-- ========== End main ========== -->

                    <!-- ========== Start second ========== -->
                    <div class="col-md-12 mb-5">
                        <!-- ========== Start card body second ========== -->
                        <div class="card p-5">
                            <!-- ========== Start input category ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label category ========== -->
                                <label for="category_id" class="form-label required">Category</label>
                                <!-- ========== End label category ========== -->
                                <!-- ========== Start select category ========== -->
                                <select class="form-select form-select-solid mb-2" data-control="select2"
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
                                <!-- ========== End select category ========== -->
                            </div>
                            <!-- ========== End input category ========== -->
                            <!-- ========== Start input finishing ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label finishing ========== -->
                                <label class="form-label required">Finishing</label>
                                <!-- ========== End label finishing ========== -->
                                <!-- ========== Start select finishing ========== -->
                                <select class="form-select form-select-solid mb-2" data-control="select2"
                                    data-placeholder="Select an finishing option" data-allow-clear="true"
                                    multiple="multiple" name="finishing_id[]">
                                    <option></option>
                                    @foreach ($finishings as $finishing)
                                        <option value="{{ $finishing->id }}"
                                            {{ old('finishing_id') && in_array($finishing->id, old('finishing_id')) ? 'selected' : '' }}>
                                            {{ $finishing->name }}</option>
                                    @endforeach
                                </select>
                                <!-- ========== End select finishing ========== -->
                            </div>
                            <!-- ========== End input finishing ========== -->
                            <!-- ========== Start input material ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label material ========== -->
                                <label class="form-label required">Material</label>
                                <!-- ========== End label material ========== -->
                                <!-- ========== Start select material ========== -->
                                <select class="form-select form-select-solid mb-2" data-control="select2"
                                    data-placeholder="Select an material option" data-allow-clear="true"
                                    multiple="multiple" name="material_id[]">
                                    <option></option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}"
                                            {{ old('material_id') && in_array($material->id, old('material_id')) ? 'selected' : '' }}>
                                            {{ $material->name }}</option>
                                    @endforeach
                                </select>
                                <!-- ========== End select material ========== -->
                            </div>
                            <!-- ========== End input material ========== -->
                            <!-- ========== Start input application ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label application ========== -->
                                <label class="form-label required">Application</label>
                                <!-- ========== End label application ========== -->
                                <!-- ========== Start select application ========== -->
                                <select class="form-select form-select-solid mb-2" data-control="select2"
                                    data-placeholder="Select an application option" data-allow-clear="true"
                                    multiple="multiple" name="application_id[]">
                                    <option></option>
                                    @foreach ($applications as $application)
                                        <option value="{{ $application->id }}"
                                            {{ old('application_id') && in_array($application->id, old('application_id')) ? 'selected' : '' }}>
                                            {{ $application->name }}</option>
                                    @endforeach
                                </select>
                                <!-- ========== End select application ========== -->
                            </div>
                            <!-- ========== End input application ========== -->
                            <!-- ========== Start input tag ========== -->
                            <div class=" mb-5">
                                <label for="tag" class="form-label">Tags product</label>
                                <input type="text" class="form-control form-control-solid" id="tag"
                                    placeholder="tag product" autocomplete="off" name="tag"
                                    value="{{ old('tag') }}">
                            </div>
                            <!-- ========== End input tag ========== -->
                            <div class="row">
                                <!-- ========== Start label Featured ========== -->
                                <label class="form-label">Featured</label>
                                <!-- ========== End label Featured ========== -->
                                <!-- ========== Start input convertible ========== -->
                                <div class="col-md-3">
                                    <div class="form-check mb-5">
                                        <input class="form-check-input " type="checkbox" value="1" id="convertible"
                                            name="convertible" {{ old('convertible') ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark" for="convertible">
                                            Convertible
                                        </label>
                                    </div>
                                </div>
                                <!-- ========== End input convertible ========== -->
                                <!-- ========== Start input adjustable ========== -->
                                <div class="col-md-3">
                                    <div class="form-check mb-5">
                                        <input class="form-check-input " type="checkbox" value="1" id="adjustable"
                                            name="adjustable" {{ old('adjustable') ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark" for="adjustable">
                                            Adjustable
                                        </label>
                                    </div>
                                </div>
                                <!-- ========== End input adjustable ========== -->
                                <!-- ========== Start input folded ========== -->
                                <div class="col-md-3">
                                    <div class="form-check mb-5">
                                        <input class="form-check-input " type="checkbox" value="1" id="folded"
                                            name="folded" {{ old('folded') ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark" for="folded">
                                            Folded
                                        </label>
                                    </div>
                                </div>
                                <!-- ========== End input folded ========== -->
                                <!-- ========== Start input extendable ========== -->
                                <div class="col-md-3">
                                    <div class="form-check mb-5">
                                        <input class="form-check-input " type="checkbox" value="1" id="extendable"
                                            name="extendable" {{ old('extendable') ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark" for="extendable">
                                            Extendable
                                        </label>
                                    </div>
                                </div>
                                <!-- ========== End input extendable ========== -->
                            </div>
                        </div>
                        <!-- ========== End card body second ========== -->
                    </div>
                    <!-- ========== End second ========== -->

                    <!-- ========== Start size ========== -->
                    <div class="col-md mb-5">
                        <!-- ========== Start card body size ========== -->
                        <div class="card p-5">
                            <!-- ========== Start input is_circle ========== -->
                            <div class="form-check mb-5">
                                <input class="form-check-input " type="checkbox" value="1" id="is_circular"
                                    name="is_circular" {{ old('is_circular') ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="is_circular">
                                    Is circular
                                </label>
                            </div>
                            <!-- ========== End input is_circle ========== -->
                            <div class="row">
                                <!-- ========== Start input length ========== -->
                                <div class="col-md-3">
                                    <div class=" mb-5">
                                        <label for="length" class="form-label">Length (cm)</label>
                                        <input type="number" class="form-control form-control-solid" id="length"
                                            placeholder="length product" autocomplete="off" name="length"
                                            value="{{ old('length') }}">
                                    </div>
                                </div>
                                <!-- ========== End input length ========== -->
                                <!-- ========== Start input width ========== -->
                                <div class="col-md-3">
                                    <div class=" mb-5">
                                        <label for="width" class="form-label">Width (cm)</label>
                                        <input type="number" class="form-control form-control-solid" id="width"
                                            placeholder="width" autocomplete="off" name="width"
                                            value="{{ old('width') }}">
                                    </div>
                                </div>
                                <!-- ========== End input width ========== -->
                                <!-- ========== Start input height ========== -->
                                <div class="col-md-3">
                                    <div class=" mb-5">
                                        <label for="height" class="form-label">Height (cm)</label>
                                        <input type="number" class="form-control form-control-solid" id="height"
                                            placeholder="height" autocomplete="off" name="height"
                                            value="{{ old('height') }}">
                                    </div>
                                </div>
                                <!-- ========== End input height ========== -->
                                <!-- ========== Start input diameter ========== -->
                                <div class="col-md-3">
                                    <div class=" mb-5">
                                        <label for="diameter" class="form-label">Diameter (cm)</label>
                                        <input type="number" class="form-control form-control-solid" id="diameter"
                                            placeholder="MOQ" autocomplete="off" name="diameter"
                                            value="{{ old('diameter') }}">
                                    </div>
                                </div>
                                <!-- ========== End input diameter ========== -->
                            </div>
                        </div>
                        <!-- ========== End card body size ========== -->
                    </div>
                    <!-- ========== End size ========== -->

                    <!-- ========== Start price ========== -->
                    <div class="col-md-12 mb-5">
                        <!-- ========== Start card body price ========== -->
                        <div class="card p-5">
                            <!-- ========== Start input price ========== -->
                            <div class=" mb-5">
                                <label for="price" class="form-label">Price product</label>
                                <input type="text" class="form-control form-control-solid" id="price"
                                    placeholder="price product" autocomplete="off" name="price"
                                    value="{{ old('price') }}">
                            </div>
                            <!-- ========== End input price ========== -->
                            <!-- ========== Start input payment options ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label payment_options ========== -->
                                <label for="payment_options" class="form-label">Payment options</label>
                                <!-- ========== End label payment_options ========== -->
                                <!-- ========== Start select payment_options ========== -->
                                <select class="form-select form-select-solid mb-2" data-control="select2"
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
                                <!-- ========== End select payment_options ========== -->
                            </div>
                            <!-- ========== End input payment options ========== -->
                            <!-- ========== Start input payment_terms ========== -->
                            <div class=" mb-5">
                                <label for="payment_terms" class="form-label">Payment terms</label>
                                <input type="text" class="form-control form-control-solid" id="payment_terms"
                                    placeholder="payment_terms" autocomplete="off" name="payment_terms"
                                    value="{{ old('payment_terms') ?? 'DP 50%' }}">
                            </div>
                            <!-- ========== End input payment_terms ========== -->
                            <!-- ========== Start input delivery_terms ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label delivery_terms ========== -->
                                <label for="delivery_terms" class="form-label">Payment options</label>
                                <!-- ========== End label delivery_terms ========== -->
                                <!-- ========== Start select delivery_terms ========== -->
                                <select class="form-select form-select-solid mb-2" data-control="select2"
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
                                <!-- ========== End select delivery_terms ========== -->
                            </div>
                            <!-- ========== End input delivery_terms ========== -->
                            <!-- ========== Start input delivery_time ========== -->
                            <div class=" mb-5">
                                <label for="delivery_time" class="form-label">Delivery time</label>
                                <input type="text" class="form-control form-control-solid" id="delivery_time"
                                    placeholder="delivery_time" autocomplete="off" name="delivery_time"
                                    value="{{ old('delivery_time') }}">
                            </div>
                            <!-- ========== End input delivery_time ========== -->
                            <!-- ========== Start input lead_time ========== -->
                            <div class=" mb-5">
                                <label for="lead_time" class="form-label">Lead time</label>
                                <input type="text" class="form-control form-control-solid" id="lead_time"
                                    placeholder="lead_time" autocomplete="off" name="lead_time"
                                    value="{{ old('lead_time') }}">
                            </div>
                            <!-- ========== End input lead_time ========== -->
                            <!-- ========== Start input packing ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label packing ========== -->
                                <label for="packing" class="form-label">Payment options</label>
                                <!-- ========== End label packing ========== -->
                                <!-- ========== Start select packing ========== -->
                                <select class="form-select form-select-solid mb-2" data-control="select2"
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
                                <!-- ========== End select packing ========== -->
                            </div>
                            <!-- ========== End input packing ========== -->
                            <!-- ========== Start input port ========== -->
                            <div class=" mb-5">
                                <label for="port" class="form-label">Port</label>
                                <input type="text" class="form-control form-control-solid" id="port"
                                    placeholder="port" autocomplete="off" name="port"
                                    value="{{ old('port') ?? 'Tanjung mas' }}">
                            </div>
                            <!-- ========== End input port ========== -->

                            <div class="d-flex justify-content-end gap-3">
                                <a href="/furnitures" class="btn btn-dark btn-sm">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </div>
                    <!-- ========== End card body price ========== -->
                </div>
            </div>
    </form>
    </script>
@endsection
