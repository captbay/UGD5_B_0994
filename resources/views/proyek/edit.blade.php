@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Proyek</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Proyek</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <form action="{{ route('proyek.update', $proyek->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Nama Proyek</label>
                                        <input type="text"
                                            class="form-control @error('nama_proyek') is-invalid @enderror"
                                            name="nama_proyek"
                                            value="{{ old('nama_proyek', $proyek->nama_proyek) }}"
                                            placeholder="Masukkan Nama Proyek">
                                        @error('nama_proyek')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                
                                
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Departemen</label>
                                        <select class="form-control @error('id_departemen') is-invalid @enderror"
                                        name="id_departemen" value="{{ old('id_departemen', $proyek->id_departemen) }}" >
                                         
                                        @foreach ($departemen as $item)
                                            @if ($proyek->id_departemen == $item->id)
                                            <option selected value="{{ $item->id }} "> 
                                                {{ $item->nama_departemen }}
                                            </option>   
                                            @else  
                                            <option value="{{ $item->id }}">{{ $item->nama_departemen }}</option>
                                            @endif
                                        @endforeach
                                        </select>   
                                        @error('id_departemen')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Waktu mulai</label>
                                        <input type="date"
                                            class="form-control @error('waktu_mulai') is-invalid @enderror"
                                            name="waktu_mulai"
                                            value="{{ old('waktu_mulai', $proyek->waktu_mulai) }}"
                                            placeholder="Masukkan waktu mulai">
                                        @error('waktu_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Waktu selesai</label>
                                        <input type="date"
                                            class="form-control @error('waktu_selesai') is-invalid @enderror"
                                            name="waktu_selesai"
                                            value="{{ old('waktu_selesai', $proyek->waktu_selesai) }}"
                                            placeholder="Masukkan waktu selesai">
                                        @error('waktu_selesai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Nilai Proyek</label>
                                        <input type="number"
                                            class="form-control @error('nilai_proyek') is-invalid @enderror"
                                            name="nilai_proyek"
                                            value="{{ old('nilai_proyek', $proyek->nilai_proyek) }}"
                                            placeholder="Masukkan nilai proyekk">
                                        @error('nilai_proyek')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror"
                                        name="status" value="{{ old('status', $proyek->status) }}" >
                                            @if (old('status', $proyek->status) == 1)
                                            <option selected value="{{ old('status', $proyek->status) }}"> {{ old('status', $proyek->status) ? "Berjalan" : "Selesai"}}</option>
                                            <option value="0">Selesai</option>
                                            @elseif(old('status', $proyek->status) == 0)
                                            <option selected value="{{ old('status', $proyek->status) }}"> {{ old('status', $proyek->status) ? "Berjalan" : "Selesai"}}</option>
                                            <option value="1">Berjalan</option>
                                            @endif
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                {{-- <button type="reset" class="btn btn-md btn-warning">RESET</button> --}}
                            </form>
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
