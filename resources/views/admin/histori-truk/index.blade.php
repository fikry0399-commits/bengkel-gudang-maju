@extends('admin.layouts.templates')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Histori Truk</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h4 class="text-primary font-weight-bold mb-0">Data Histori Transaksi</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0 custom-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No</th>
                                        <th class="text-center">Plat Nomor</th>
                                        <th class="text-center">Merk / Tipe</th>
                                        <th class="text-center">Tahun</th>
                                        <th class="text-center">Kondisi Fisik</th>
                                        <th class="text-center">Biaya Penanganan</th>
                                        <th class="text-center">Nilai Jual Truk</th>
                                        <th class="text-center">Nilai Suku Cadang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($histori as $item)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="text-center font-weight-bold text-nowrap">{{ $item->plat_nomor }}</td>
                                        <td class="text-nowrap">{{ $item->merk_tipe }}</td>
                                        <td class="text-center">{{ $item->tahun }}</td>
                                        <td class="text-center font-weight-bold">{{ $item->kondisi }}%</td>
                                        <td class="text-right text-nowrap">Rp {{ number_format($item->biaya_penanganan, 0, ',', '.') }}</td>
                                        <td class="text-right text-nowrap">Rp {{ number_format($item->nilai_jual, 0, ',', '.') }}</td>
                                        <td class="text-right text-nowrap">Rp {{ number_format($item->nilai_suku_cadang, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom Styling Tabel Histori */
    .custom-table {
        border: 1px solid #dee2e6 !important;
        font-size: 13px;
    }
    .custom-table th {
        background-color: #f4f6f9 !important;
        color: #34395e !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        white-space: nowrap;
        vertical-align: middle !important;
        border-bottom: 2px solid #dae1e7 !important;
        padding: 12px 15px !important;
    }
    .custom-table td {
        vertical-align: middle !important;
        padding: 10px 15px !important;
        border-color: #e9ecef !important;
    }
    .custom-table tbody tr:hover {
        background-color: rgba(103, 119, 239, 0.05) !important;
    }
</style>
@endsection