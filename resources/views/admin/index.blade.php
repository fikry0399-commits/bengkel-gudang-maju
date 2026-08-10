@extends('admin.layouts.templates')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
        <!-- Card 1: Total Kriteria -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-primary">
                    <i class="fas fa-list-ul text-white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Kriteria</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalKriteria ?? count($kriterias ?? []) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Alternatif -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-danger">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Alternatif</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalAlternatif ?? count($alternatifs ?? []) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Metode SPK -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-warning">
                    <i class="fas fa-calculator text-white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Metode SPK</h4>
                    </div>
                    <div class="card-body">
                        SAW
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Rekomendasi Utama -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-success">
                    <i class="fas fa-trophy text-white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Rekomendasi Utama</h4>
                    </div>
                    <div class="card-body" style="font-size: 1rem; font-weight: 600;">
                        {{ $topRank->nama_alternatif ?? 'Toyota Dyna' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        
        <!-- 1. Tabel 3 Rekomendasi Teratas -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0">
                    <h6 class="m-0 font-weight-bold text-dark">Rekomendasi Teratas</h6>
                    </h6>
                    <a href="{{ route('penilaian.hitung') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center py-3" style="width: 10%;">No</th>
                                    <th class="py-3">Nama Truk / Alternatif</th>
                                    <th class="text-center py-3">Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                // Urutkan skor dari yang tertinggi ke terendah
                                $sortedScores = $scores ?? [];
                                arsort($sortedScores);
                                $rank = 1;
                            @endphp

                                @forelse($sortedScores as $idAlt => $score)
                                    @if($rank <= 3)
                                        @php
                                            $alt = $alternatifs->where('id_alternatif', $idAlt)->first();
                                        @endphp
                                        <tr>
                                            <td class="text-center font-weight-bold text-secondary">{{ $rank++ }}</td>
                                            <td>
                                                <span class="font-weight-bold text-dark">
                                                    {{ $alt->nama_alternatif ?? $alt->nama ?? 'Truk '.$idAlt }}
                                                </span>
                                            </td>
                                            <td class="text-center font-weight-bold text-dark">
                                                {{ number_format($score, 4) }}
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block opacity-50"></i>
                                            Belum ada data perhitungan SPK.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Card Akses Cepat (Quick Actions) -->
       <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="m-0 font-weight-bold text-dark">Akses Cepat</h6>
                    </h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center p-4">
            
            <!-- Tombol 1: Input Penilaian -->
            @if(auth()->user()->role->role_name === 'admin' || auth()->user()->role === 'admin')
            <a href="{{ route('penilaian.index') }}" class="btn btn-primary btn-block text-left mb-3 p-3 shadow-sm rounded-3 border-0 d-flex justify-content-between align-items-center">
                <span class="font-weight-bold">Input Penilaian</span>
                <i class="fas fa-edit"></i>
            </a>
@endif
            <!-- Tombol 2: Hasil Perhitungan SAW -->
            <a href="{{ route('penilaian.hitung') }}" class="btn btn-success btn-block text-left mb-3 p-3 shadow-sm rounded-3 border-0 d-flex justify-content-between align-items-center">
                <span class="font-weight-bold">Hasil Perhitungan SAW</span>
                <i class="fas fa-calculator"></i>
            </a>

            <!-- Tombol 3: Histori Truk -->
            <a href="{{ url('/histori-truk') }}" class="btn btn-info text-white btn-block text-left p-3 shadow-sm rounded-3 border-0 d-flex justify-content-between align-items-center">
                <span class="font-weight-bold">Histori Truk</span>
                <i class="fas fa-history"></i>
            </a>

        </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection