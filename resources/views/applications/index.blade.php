@extends('layouts.table') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Application</h1>
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

    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Daftar Application</h3>

                            <form action="/applications">
                                <div class="card-tools d-flex justify-content-end">
                                    <div class="input-group input-group-sm" style="width: 200px">
                                        <input type="text" name="search" class="form-control float-right"
                                            placeholder="Cari nama" value="{{ request('search') }}" autocomplete="off" />

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i> filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama
                                            <span id="order-by-name" class="btn btn-xs btn-secondary"><i
                                                    class="fas fa-solid fa-caret-{{ request('orderBy') == 'name' && request('order') == 'desc' ? 'up' : 'down' }}"></i></span>
                                        </th>
                                        <th class="text-right">SKU</th>
                                        <th class="text-right">Jumlah furniture</th>
                                        <th class="text-right">Tanggal ditambahkan <span id="order-by-date"
                                                class="btn btn-xs btn-secondary"><i
                                                    class="fas fa-solid fa-caret-{{ request('orderBy') == 'created_at' && request('order') == 'desc' ? 'up' : 'down' }}"></i></span>
                                        </th>
                                        <th class="text-right"><a href="/applications/create"
                                                class="btn btn-primary btn-sm"><i class="fas fa-solid fa-plus"></i> Tambah
                                                Application</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td class="text-right">{{ $data->id }}</td>
                                            <td class="text-right">
                                                {{ count($furniture_applications->where('application_id', $data->id)) }}
                                            </td>
                                            <td class="text-right">{{ $data->created_at->format('d/m/Y') }}</td>
                                            <td class="project-actions text-right">
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-info btn-sm mr-1"
                                                        href="/applications/{{ $data->id }}/edit">
                                                        <i class="fas fa-pencil-alt"> </i>
                                                        Ubah
                                                    </a>
                                                    <form action="/applications/{{ $data->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button
                                                            onclick="return confirm('PERHATIAN!!!\nSemua furniture yang menggunakan application {{ $data->name }} juga akan terhapus.')"
                                                            type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            {{ $applications->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>

    <form action="/applications" method="get" id="form-order-by-name">
        <input type="hidden" name="search" value="{{ request('search') ?? '' }}" />
        <input type="hidden" name="orderBy" value="name" />
        <input type="hidden" name="order" value="{{ request('order') == 'desc' ? 'asc' : 'desc' }}" />
    </form>

    <form action="/applications" method="get" id="form-order-by-date">
        <input type="hidden" name="search" value="{{ request('search') ?? '' }}" />
        <input type="hidden" name="orderBy" value="created_at" />
        <input type="hidden" name="order" value="{{ request('order') == 'desc' ? 'asc' : 'desc' }}" />
    </form>

    <script>
        const orderByName = document.querySelector("#order-by-name");
        const formOrderByName = document.querySelector("#form-order-by-name");

        const orderByDate = document.querySelector("#order-by-date");
        const formOrderByDate = document.querySelector("#form-order-by-date");

        orderByName.addEventListener("click", (e) => {
            e.preventDefault();

            formOrderByName.submit();
        });

        orderByDate.addEventListener("click", (e) => {
            e.preventDefault();

            formOrderByDate.submit();
        });
    </script>
@endsection
