@extends('admin.layouts.templates')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Kriteria SPK SAW</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="section-body">
        <!-- Form Tambah Kriteria -->
        <div class="card">
            <div class="card-header">
                <h4>Tambah Kriteria Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kriteria.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Kode Kriteria</label>
                            <input type="text" name="kode_kriteria" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Bobot</label>
                            <input type="number" step="0.01" name="bobot" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Jenis Kriteria</label>
                            <select name="jenis" class="form-control" required>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Kriteria</button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Kriteria -->
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kriteria</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kriterias as $key => $kriteria)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kriteria->kode_kriteria }}</td>
                                    <td>{{ $kriteria->nama_kriteria }}</td>
                                    <td>{{ $kriteria->bobot }}</td>
                                    <td>
                                        <span class="badge badge-{{ $kriteria->jenis == 'benefit' ? 'success' : 'warning' }}">
                                            {{ strtoupper($kriteria->jenis) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
        <a href="{{ route('kriteria.edit', $kriteria->id_kriteria) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
        <form action="{{ route('kriteria.destroy', $kriteria->id_kriteria) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </form>
    </div>
</td>
</tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data kriteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection