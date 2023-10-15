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

    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="text-center mb-10">
                <img src="{{ $furniture->furniture_images[0]->url }}" alt="image"
                    class="rounded w-lg-300px h-lg-300px w-100" />
            </div>
        </div>
    </div>


    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Furniture Details</h3>
            </div>
            <!--end::Card title-->
            <div class="text-end d-flex align-items-center gap-1">
                <a href="/furnitures" class="btn btn-sm btn-dark">Back</a>
                <a href="/furnitures/edit/{{ $furniture->id }}" class="btn btn-sm btn-warning text-dark">Edit details</a>
                <form action="/furnitures/{{ $furniture->id }}" method="POST">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Delete {{ $furniture->name }} ({{ $furniture->code }})')"
                        type="submit" class="btn btn-danger fw-bold btn-sm">Delete</button>
                </form>
            </div>
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Code</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->code }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Name furniture</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->name }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Description</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{!! $furniture->description !!}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Certification</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->certification }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Stock</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->stock }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Qty/month</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->qty_per_month }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">MOQ</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->moq }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Category</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="badge badge-light-dark fw-bold fs-6 mb-lg-0 mb-1">{{ $furniture->category->name }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Materials</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    @foreach ($furniture->materials as $data)
                        <span class="badge badge-light-dark me-2 fw-bold fs-6 mb-lg-0 mb-1">{{ $data->name }}</span>
                    @endforeach
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Finishing</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    @foreach ($furniture->finishings as $data)
                        <span class="badge badge-light-dark me-2 fw-bold fs-6 mb-lg-0 mb-1">{{ $data->name }}</span>
                    @endforeach
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Application</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    @foreach ($furniture->applications as $data)
                        <span class="badge badge-light-dark me-2 fw-bold fs-6 mb-lg-0 mb-1">{{ $data->name }}</span>
                    @endforeach
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Keywords</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->keyword }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Featured</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span
                        class="fw-bold fs-6 text-gray-800 {{ !$furniture->convertible && !$furniture->adjustable && !$furniture->extendable && !$furniture->folded
                            ? ''
                            : 'd-none' }}">-</span>
                    <span
                        class="badge badge-light-success me-2 fw-bold fs-6 mb-lg-0 mb-1 {{ !$furniture->convertible ? 'd-none' : '' }}">Convertible</span>
                    <span
                        class="badge badge-light-success me-2 fw-bold fs-6 mb-lg-0 mb-1 {{ !$furniture->adjustable ? 'd-none' : '' }}">Adjustable</span>
                    <span
                        class="badge badge-light-success me-2 fw-bold fs-6 mb-lg-0 mb-1 {{ !$furniture->extendable ? 'd-none' : '' }}">Extendable</span>
                    <span
                        class="badge badge-light-success me-2 fw-bold fs-6 mb-lg-0 mb-1 {{ !$furniture->folded ? 'd-none' : '' }}">Folded</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Size</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->size }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Price <span
                        class="badge badge-light-success">$</span></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800"><span
                            class="text-success">$</span>{{ number_format($furniture->price, 2) }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Payment options</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800 text-uppercase">{{ $furniture->payment_options }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Payment terms</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->payment_terms }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Devivery terms</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800 text-uppercase">{{ $furniture->delivery_terms }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Delivery time</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->delivery_time }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Lead time</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->lead_time }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Packing</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800 text-capitalize">{{ $furniture->packing }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Port</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <span class="fw-bold fs-6 text-gray-800">{{ $furniture->port }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
