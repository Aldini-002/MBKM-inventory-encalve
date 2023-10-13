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

    <div class="d-flex mb-5 justify-content-end gap-3">
        <a href="/furnitures" class="btn btn-dark btn-sm">Back</a>
        <form action="/furnitures/{{ $furniture->id }}" method="post">
            <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Delete {{ $furniture->name }}')">Delete</button>
        </form>
    </div>

    <form action="/furnitures/{{ $furniture->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <!-- ========== Start aside ========== -->
            <div class="col-lg-3 mb-5">
                <div class="card p-5">
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <!--begin::Image input placeholder-->
                        <style>
                            .image-input-placeholder {
                                background-image: url("/img/furnitures/{{ $furniture->image }}");
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url("/img/furnitures/{{ $furniture->image }}");
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
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
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
                            <!-- ========== Start input code ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label code ========== -->
                                <label class="form-label required" for="code">Code</label>
                                <!-- ========== End label code ========== -->
                                <input type="text" class="form-control form-control-solid" id="code"
                                    placeholder="code product" autocomplete="off" autofocus name="code"
                                    value="{{ $furniture->code }}" readonly>
                            </div>
                            <!-- ========== End input name ========== -->
                            <!-- ========== Start input name ========== -->
                            <div class="mb-5">
                                <!-- ========== Start label name ========== -->
                                <label class="form-label required" for="name">Name product</label>
                                <!-- ========== End label name ========== -->
                                <input type="text" class="form-control form-control-solid" id="name"
                                    placeholder="name product" autocomplete="off" autofocus name="name"
                                    value="{{ $furniture->name }}">
                            </div>
                            <!-- ========== End input name ========== -->
                            <!-- ========== Start input description ========== -->
                            <div class="mb-5">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control form-control-solid" placeholder="Description" id="description" style="height: 100px"
                                    name="description">{{ $furniture->description }}</textarea>
                            </div>
                            <!-- ========== End input description ========== -->
                            <!-- ========== Start input certification ========== -->
                            <div class=" mb-5">
                                <label for="certification" class="form-label">Certification product</label>
                                <input type="text" class="form-control form-control-solid" id="certification"
                                    placeholder="certification product" autocomplete="off" name="certification"
                                    value="{{ $furniture->certification }}">
                            </div>
                            <!-- ========== End input certification ========== -->
                            <!-- ========== Start input stock ========== -->
                            <div class="mb-5">
                                <label for="stock" class="form-label required">Stock</label>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="number" class="form-control form-control-solid" id="stock"
                                            placeholder="stock" autocomplete="off" name="stock"
                                            value="{{ $furniture->stock }}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="#" class="btn btn-primary w-100">Edit stock</a>
                                    </div>
                                </div>
                            </div>
                            <!-- ========== End input stock ========== -->
                            <div class="row">
                                <!-- ========== Start input qty/month ========== -->
                                <div class="col-md">
                                    <div class="mb-5">
                                        <label for="qty_per_month" class="form-label">Qty per month</label>
                                        <input type="number" class="form-control form-control-solid" id="qty_per_month"
                                            placeholder="qty per month" autocomplete="off" name="qty_per_month"
                                            value="{{ $furniture->qty_per_month }}">
                                    </div>
                                </div>
                                <!-- ========== End input qty/month ========== -->
                                <!-- ========== Start input moq ========== -->
                                <div class="col-md">
                                    <div class=" mb-5">
                                        <label for="moq" class="form-label">MOQ</label>
                                        <input type="number" class="form-control form-control-solid" id="moq"
                                            placeholder="MOQ" autocomplete="off" name="moq"
                                            value="{{ $furniture->moq }}">
                                    </div>
                                </div>
                                <!-- ========== End input moq ========== -->
                            </div>
                            <!-- ========== Start input weight ========== -->
                            <div class=" mb-5">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control form-control-solid" id="weight"
                                    placeholder="Weight" autocomplete="off" name="weight"
                                    value="{{ $furniture->weight }}">
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
                                        {{ $furniture->category_id == $categories[0]->id || !$furniture->category_id ? 'selected' : '' }}>
                                        {{ $categories[0]->name }}
                                    </option>
                                    @foreach ($categories->skip(1) as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $furniture->category_id == $category->id ? 'selected' : '' }}>
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
                                            {{ in_array($finishing->id, $finishing_id) ? 'selected' : '' }}>
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
                                            {{ in_array($material->id, $material_id) ? 'selected' : '' }}>
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
                                            {{ in_array($application->id, $application_id) ? 'selected' : '' }}>
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
                                    value="{{ $furniture->tag }}">
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
                                            name="convertible" {{ $furniture->convertible ? 'checked' : '' }}>
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
                                            name="adjustable" {{ $furniture->adjustable ? 'checked' : '' }}>
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
                                            name="folded" {{ $furniture->folded ? 'checked' : '' }}>
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
                                            name="extendable" {{ $furniture->extendable ? 'checked' : '' }}>
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
                                    name="is_circular" {{ $furniture->isCircular ? 'checked' : '' }}>
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
                                            placeholder="length" autocomplete="off" name="length"
                                            value="{{ $furniture->length }}">
                                    </div>
                                </div>
                                <!-- ========== End input length ========== -->
                                <!-- ========== Start input width ========== -->
                                <div class="col-md-3">
                                    <div class=" mb-5">
                                        <label for="width" class="form-label">Width (cm)</label>
                                        <input type="number" class="form-control form-control-solid" id="width"
                                            placeholder="width" autocomplete="off" name="width"
                                            value="{{ $furniture->width }}">
                                    </div>
                                </div>
                                <!-- ========== End input width ========== -->
                                <!-- ========== Start input height ========== -->
                                <div class="col-md-3">
                                    <div class=" mb-5">
                                        <label for="height" class="form-label">Height (cm)</label>
                                        <input type="number" class="form-control form-control-solid" id="height"
                                            placeholder="hieght" autocomplete="off" name="height"
                                            value="{{ $furniture->height }}">
                                    </div>
                                </div>
                                <!-- ========== End input height ========== -->
                                <!-- ========== Start input diameter ========== -->
                                <div class="col-md-3">
                                    <div class=" mb-5">
                                        <label for="diameter" class="form-label">Diameter (cm)</label>
                                        <input type="number" class="form-control form-control-solid" id="diameter"
                                            placeholder="diameter" autocomplete="off" name="diameter"
                                            value="{{ $furniture->diameter }}">
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
                                    value="{{ $furniture->price }}">
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
                                        {{ $furniture->payment_options == 'dp' || !$furniture->payment_options ? 'selected' : '' }}>
                                        DP
                                    </option>
                                    <option value="full" {{ $furniture->payment_options == 'full' ? 'selected' : '' }}>
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
                                    value="{{ $furniture->payment_terms }}">
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
                                        {{ $furniture->delivery_terms == 'fob' || !$furniture->delivery_terms ? 'selected' : '' }}>
                                        FOB
                                    </option>
                                    <option value="exw" {{ $furniture->delivery_terms == 'exw' ? 'selected' : '' }}>
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
                                    value="{{ $furniture->delivery_time }}">
                            </div>
                            <!-- ========== End input delivery_time ========== -->
                            <!-- ========== Start input lead_time ========== -->
                            <div class=" mb-5">
                                <label for="lead_time" class="form-label">Lead time</label>
                                <input type="text" class="form-control form-control-solid" id="lead_time"
                                    placeholder="lead_time" autocomplete="off" name="lead_time"
                                    value="{{ $furniture->lead_time }}">
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
                                        {{ $furniture->packing == 'corrugated paper' || !$furniture->packing ? 'selected' : '' }}>
                                        Corrugated paper
                                    </option>
                                    <option value="box" {{ $furniture->packing == 'box' ? 'selected' : '' }}>
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
                                    value="{{ $furniture->port }}">
                            </div>
                            <!-- ========== End input port ========== -->

                            <div class="d-flex justify-content-end gap-3">
                                <a href="/furnitures" class="btn btn-dark btn-sm">Back</a>
                                <button type="reset" class="btn btn-warning btn-sm">Reset</button>
                                <button type="submit" class="btn btn-primary btn-sm"
                                    onclick="return confirm(Save change!!!)">Save change</button>
                            </div>
                        </div>
                    </div>
                    <!-- ========== End card body price ========== -->
                </div>
            </div>
        </div>
    </form>
@endsection
