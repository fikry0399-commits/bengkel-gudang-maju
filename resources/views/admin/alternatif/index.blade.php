@extends('admin.layouts.templates')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Alternatif</h1>
    </div>

    <div class="section-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- Form Tambah Alternatif --}}
        <div class="card">
            <div class="card-header">
                <h4>Tambah Alternatif Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('alternatif.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Kode Alternatif</label>
                            <input type="text" name="kode_alternatif" class="form-control" placeholder="Contoh: A1">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Alternatif</label>
                            <input type="text" name="nama_alternatif" class="form-control" placeholder="Contoh: Bengkel Utama">
                        </div>
                        <div class="form-group col-md-2 align-self-end">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Daftar Alternatif --}}
        <div class="card">
            <div class="card-header">
                <h4>Daftar Alternatif</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama Alternatif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alternatifs as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kode_alternatif }}</td>
                                    <td>{{ $item->nama_alternatif }}</td>
                                    <td>
                                        <form action="{{ route('alternatif.destroy', $item->id_alternatif) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data alternatif.</td>
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