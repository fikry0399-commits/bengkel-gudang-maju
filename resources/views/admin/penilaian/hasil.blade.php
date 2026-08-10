@extends('admin.layouts.templates')

@section('content')
<div class="container-fluid pt-5 mt-4 pb-4">
    <!-- Header Page -->
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h3 class="text-primary font-weight-bold mb-0">Hasil Perhitungan & Rekomendasi SAW</h3>
        <button onclick="window.print()" class="btn btn-primary shadow-sm">
            Cetak Laporan
        </button>
    </div>

    <!-- Style Print -->
    <style>
        @media print {
            .no-print, .main-sidebar, .main-header, .main-footer {
                display: none !important;
            }
            .content-wrapper, .container-fluid {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .card {
                border: 1px solid #ddd !important;
                box-shadow: none !important;
            }
        }
    </style>

    <!-- 1. Matriks Keputusan (X) -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-secondary text-white font-weight-bold py-3">
            <h5 class="mb-0 text-white">1. Matriks Keputusan (X)</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-items-center mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th class="ps-3">Alternatif</th>
                            @foreach($kriterias as $k)
                                <th class="text-center">
                                    {{ $k->nama_kriteria }}
                                    <hr class="my-1">
                                    <small class="text-muted">
                                        ({{ ucfirst($k->jenis ?? 'Benefit') }}) / {{ ($k->bobot <= 1) ? ($k->bobot * 100) : $k->bobot }}%
                                    </small>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alternatifs as $alt)
                            <tr>
                                <td class="ps-3 fw-bold"><strong>{{ $alt->nama_alternatif }}</strong></td>
                                @foreach($kriterias as $k)
                                    @php
                                        $val = $matriksX[$alt->id_alternatif][$k->id_kriteria] ?? '-';
                                    @endphp
                                    <td class="text-center">
                                        @if(is_numeric($val) && $val > 1000)
                                            Rp {{ number_format($val, 0, ',', '.') }}
                                        @elseif(is_numeric($val) && $val <= 100)
                                            {{ $val }}%
                                        @else
                                            {{ $val }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 2. Matriks Normalisasi (R) -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-info text-white font-weight-bold py-3">
            <h5 class="mb-0 text-white">2. Matriks Ternormalisasi (R)</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-items-center mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th class="ps-3">Alternatif</th>
                            @foreach($kriterias as $k)
                                <th class="text-center">{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alternatifs as $alt)
                            <tr>
                                <td class="ps-3"><strong>{{ $alt->nama_alternatif }}</strong></td>
                                @foreach($kriterias as $k)
                                    <td class="text-center">
                                        {{ number_format($matriksR_SAW[$alt->id_alternatif][$k->id_kriteria] ?? 0, 4, '.', '') }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 3. Hasil Ranking & Rekomendasi Strategi -->
    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header bg-primary text-white font-weight-bold py-3">
            <h5 class="mb-0 text-white">3. Peringkatan & Rekomendasi Strategi Penanganan</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-items-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" style="width: 100px;">Peringkat</th>
                            <th class="ps-3">Alternatif (Truk)</th>
                            <th class="text-center">Nilai Preferensi (V)</th>
                            <th class="text-center">Rekomendasi Strategi Penanganan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasilV as $index => $res)
                            <tr>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary fs-6 px-3 py-2">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="ps-3"><strong>{{ $res['alternatif']->nama_alternatif }}</strong></td>
                                <td class="text-center font-weight-bold text-primary">
                                    {{ number_format($res['nilai_v'], 4, '.', '') }}
                                </td>
                                <td class="text-center">
                                    @if($res['strategi'] == 'Dijual Langsung')
                                        <span class="badge badge-success px-3 py-2">Dijual Langsung</span>
                                    @elseif($res['strategi'] == 'Diperbaiki Sebelum Dijual')
                                        <span class="badge badge-warning text-dark px-3 py-2">Diperbaiki Sebelum Dijual</span>
                                    @else
                                        <span class="badge badge-danger px-3 py-2">Dibongkar untuk Suku Cadang</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection