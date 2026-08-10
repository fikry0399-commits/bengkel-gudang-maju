@extends('admin.layouts.templates')

@section('title', 'Matriks Penilaian')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Matriks Penilaian Alternatif</h1>
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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Input Nilai Matriks Keputusan</h4>
                <small class="text-muted"></small>
            </div>
            <div class="card-body">
                @if($alternatifs->isEmpty() || $kriterias->isEmpty())
                    <div class="alert alert-warning">
                        Harap isi Data Kriteria dan Data Alternatif terlebih dahulu sebelum melakukan penilaian.
                    </div>
                @else
                    <form action="{{ route('penilaian.store') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <thead>
                                    <tr>
                                        <!-- Header Checkbox Select All -->
                                        <th style="width: 40px;" class="text-center">
                                            <input type="checkbox" id="check-all">
                                        </th>
                                        <th>No</th>
                                        <th>Nama Alternatif</th>
                                        <th style="width: 180px;">Plat Nomor</th>
                                        <th style="width: 120px;">Tahun</th>
                                        @foreach($kriterias as $k)
                                            <th>{{ $k->nama_kriteria ?? $k->kode_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatifs as $index => $alt)
                                        @php
                                            $altId = $alt->id_alternatif ?? $alt->id;
                                        @endphp
                                        <tr class="row-alternatif">
                                            <!-- Checkbox Pilih Alternatif -->
                                            <td class="text-center align-middle">
                                                <input type="checkbox" 
                                                       name="selected_alternatif[]" 
                                                       value="{{ $altId }}" 
                                                       class="check-item">
                                            </td>
                                            <td class="align-middle">{{ $index + 1 }}</td>
                                            <td class="align-middle">
                                                <strong>{{ $alt->nama_alternatif }}</strong> ({{ $alt->kode_alternatif }})
                                            </td>
                                            <td>
                                                <input type="text" 
                                                       name="plat_nomor[{{ $altId }}]" 
                                                       class="form-control text-uppercase field-input" 
                                                       placeholder="" 
                                                       disabled
                                                       required 
                                                       >
                                            </td>
                                            <td>
                                                <input type="number"
                                                       name="tahun[{{ $altId }}]"
                                                       class="form-control field-input"
                                                       placeholder=""
                                                       min="1900"
                                                       max="2026"
                                                       disabled
                                                       required 
                                                       >
                                            </td>
                                            @foreach($kriterias as $k)
                                                @php
                                                    $kriteriaId = $k->id_kriteria ?? $k->id;
                                                    $val = $penilaian[$altId][$kriteriaId] ?? '';
                                                @endphp
                                                <td>
                                                    <input type="number" step="any"
                                                           name="nilai[{{ $altId }}][{{ $kriteriaId }}]"
                                                           value="{{ $val != 0 ? $val : '' }}"
                                                           class="form-control field-input"
                                                           placeholder="0" 
                                                           disabled 
                                                           required
                                                           >
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                                    <div class="text-right mt-3 d-flex justify-content-end gap-2">
               

    <!-- Tombol Hitung SAW (Memproses truk yang dicentang) -->
<button type="submit" formaction="{{ route('penilaian.hitung') }}" class="btn btn-success">
    Simpan & Hitung SAW
</button>
</div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk handle Enable/Disable input berdasarkan Checkbox -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkAll = document.getElementById('check-all');
    const checkItems = document.querySelectorAll('.check-item');

    function toggleRowInputs(checkbox) {
        const row = checkbox.closest('tr');
        const inputs = row.querySelectorAll('.field-input');
        
        inputs.forEach(input => {
            input.disabled = !checkbox.checked;
            if (!checkbox.checked) {
                // Jika uncheck, hapus status invalid html5
                input.setCustomValidity('');
            }
        });
    }

    // Event listener per checkbox baris
    checkItems.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            toggleRowInputs(this);
            
            // Uncheck "Select All" jika ada satu item yang uncheck
            if (!this.checked && checkAll) {
                checkAll.checked = false;
            }
        });
    });

    // Event listener untuk Select All
    if (checkAll) {
        checkAll.addEventListener('change', function () {
            checkItems.forEach(checkbox => {
                checkbox.checked = this.checked;
                toggleRowInputs(checkbox);
            });
        });
    }
});
</script>
@endsection