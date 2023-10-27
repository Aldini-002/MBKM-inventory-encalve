@extends('layouts.form')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Furniture</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Horizontal Form -->
            <div class="form-horizontal">
                <div class="card card-dark card-outline">
                    <div class="row justify-content-center pt-3 carousel-container">
                        @foreach ($furniture->furniture_images as $data)
                            <img src="{{ $data->url }}" alt="..."
                                class="carousel-image rounded shadow-sm m-1 border border-danger" style="height:200px">
                        @endforeach
                    </div>
                    <div class="row justify-content-center pb-3">
                        <div id="prevButton" class="btn btn-sm   btn-dark m-1">prev</div>
                        <div id="nextButton" class="btn btn-sm   btn-dark m-1">next</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Furniture</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">SKU</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->code }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-capitalize">{{ $furniture->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Sertifikat</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->certification }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Qty/Month</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->qty_per_month }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">MOQ</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->moq }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="btn btn-xs btn-outline-dark  mr-1">{{ $furniture->category->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Material</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            @foreach ($furniture->materials as $data)
                                <div class="btn btn-xs btn-outline-dark  mr-1">{{ $data->name }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Finishing</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            @foreach ($furniture->finishings as $data)
                                <div class="btn btn-xs btn-outline-dark  mr-1">{{ $data->name }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Application</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            @foreach ($furniture->applications as $data)
                                <div class="btn btn-xs btn-outline-dark  mr-1">{{ $data->name }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Keyword</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->keyword }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Ukuran</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->size }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Fitur</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="btn btn-xs btn-outline-dark mr-1 {{ $furniture->convertible ? '' : 'd-none' }}">
                                Convertible</div>
                            <div class="btn btn-xs btn-outline-dark mr-1 {{ $furniture->adjustable ? '' : 'd-none' }}">
                                Adjustable</div>
                            <div class="btn btn-xs btn-outline-dark mr-1 {{ $furniture->extendable ? '' : 'd-none' }}">
                                Extendable</div>
                            <div class="btn btn-xs btn-outline-dark mr-1 {{ $furniture->folded ? '' : 'd-none' }}">
                                Folded</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">${{ number_format($furniture->price, 2) }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Opsi pembayaran</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-uppercase">{{ $furniture->payment_options }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Aturan Pembayaran</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->payment_terms }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Opsi Pengiriman</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-uppercase">{{ $furniture->delivery_terms }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Waktu Pengiriman</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->delivery_time }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Waktu Pengerjaan</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->lead_time }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Packing</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-capitalize">{{ $furniture->packing }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Pelabuhan</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->port }}</div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/furnitures{{ str_replace('/furnitures/' . $furniture->id, '', request()->getRequestUri()) }}"
                                class="btn btn-dark mr-1">Kemabli</a>
                            <a href="/furnitures/{{ $furniture->id }}/edit{{ str_replace('/furnitures/' . $furniture->id, '', request()->getRequestUri()) }}"
                                class="btn btn-primary mr-1">Ubah Detail</a>
                            <form
                                action="/furnitures/{{ $furniture->id . str_replace('/furnitures/' . $furniture->id, '', request()->getRequestUri()) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <button
                                    onclick="return confirm('PERHATIAN!!!\nFurniture {{ $furniture->name }}({{ $furniture->code }}) akan dihapus secara permanen!')"
                                    type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script>
        const imageInput = document.getElementById('image');
        const imagePreviews = document.getElementById('imagePreviews');

        imageInput.addEventListener('change', function() {
            imagePreviews.innerHTML = '';

            for (const file of this.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.height = '150px';
                    img.classList.add('rounded', 'shadow-sm', 'border', 'm-1')
                    imagePreviews.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script>
        const carousel = document.querySelector('.carousel-container');
        const images = document.querySelectorAll('.carousel-image');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        let currentImage = 0;

        function showImage(imageIndex) {
            images.forEach((image, index) => {
                if (index === imageIndex) {
                    image.style.display = 'block';
                } else {
                    image.style.display = 'none';
                }
            });
        }

        function nextImage() {
            currentImage = (currentImage + 1) % images.length;
            showImage(currentImage);
        }

        function prevImage() {
            currentImage = (currentImage - 1 + images.length) % images.length;
            showImage(currentImage);
        }

        nextButton.addEventListener('click', nextImage);
        prevButton.addEventListener('click', prevImage);

        showImage(currentImage);
    </script>
@endsection
