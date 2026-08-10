@extends('admin.layouts.templates')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Kriteria</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kriteria.update', $kriteria->id_kriteria) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Kode Kriteria</label>
                            <input type="text" name="kode_kriteria" class="form-control" value="{{ $kriteria->kode_kriteria }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" class="form-control" value="{{ $kriteria->nama_kriteria }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Bobot</label>
                            <input type="number" step="any" name="bobot" class="form-control" value="{{ $kriteria->bobot }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Jenis</label>
                            <select name="jenis" class="form-control" required>
                                <option value="benefit" {{ $kriteria->jenis == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" {{ $kriteria->jenis == 'cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection