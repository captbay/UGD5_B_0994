@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Departemen</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('departemen') }}">Departemen</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('departemen.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                DEPARTEMEN</a>
                            
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Departemen</th>
                                            <th class="text-center">Nama Manager</th>
                                            <th class="text-center">Jumlah Pegawai</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($departemens as $departemen)
                                            <tr>
                                                <td class="text-center">{{ $departemen->nama_departemen }}</td>
                                                <td class="text-center">{{ $departemen->nama_manager }}</td>
                                                <td class="text-center">{{ $departemen->jumlah_pegawai }}</td>
                                                <td class="text-center">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('departemen.destroy', $departemen->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('departemen.edit', $departemen->id) }}"
                                                            class="btn btn-sm btn-primary">EDIT</a>

                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">Data Departemen belum tersedia
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $departemens->links() }}
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
