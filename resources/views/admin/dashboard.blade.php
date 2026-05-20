@extends('layouts.sidebar')

@section('content')
<div class="main-content" style="margin-left: 0; padding: 0; width: 100%;">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold m-0">Admin Dashboard</h1>
        <div class="d-flex align-items-center gap-3">
            <i class="far fa-bell text-muted" style="font-size: 20px; cursor: pointer;"></i>
            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center fw-bold" style="width: 35px; height: 35px; font-size: 14px;">
                {{ substr(Auth::user()->username, 0, 1) }}
            </div>
        </div>
    </div>

    {{-- Statistik Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 border-0 shadow-sm" style="border-left: 5px solid #003366 !important;">
                <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">Total Aduan</small>
                <h2 class="fw-bold m-0 mt-1">{{ $totalAduan }}</h2>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 border-0 shadow-sm" style="background-color: #fff8e1; border-left: 5px solid #ffc107 !important; color: #856404;">
                <small class="text-uppercase fw-bold" style="font-size: 11px;">Menunggu</small>
                <h2 class="fw-bold m-0 mt-1">{{ $menunggu }}</h2>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 border-0 shadow-sm" style="background-color: #e3f2fd; border-left: 5px solid #2196f3 !important; color: #0c5460;">
                <small class="text-uppercase fw-bold" style="font-size: 11px;">Diproses</small>
                <h2 class="fw-bold m-0 mt-1">{{ $diproses }}</h2>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 border-0 shadow-sm" style="background-color: #e8f5e9; border-left: 5px solid #4caf50 !important; color: #155724;">
                <small class="text-uppercase fw-bold" style="font-size: 11px;">Selesai</small>
                <h2 class="fw-bold m-0 mt-1">{{ $selesai }}</h2>
            </div>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="table-container p-4 bg-white shadow-sm" style="border-radius: 15px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            {{-- Search Bar --}}
            <form action="{{ route('admin.dashboard') }}" method="GET" class="search-bar d-flex align-items-center gap-2 border px-3 py-1" style="border-radius: 10px; width: 350px;">
                <i class="fas fa-search text-muted"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari penghuni, kamar, atau kategori..." style="border: none; outline: none; font-size: 14px; width: 100%;">
            </form>
            
            {{-- Filter Buttons --}}
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-filter text-muted me-2" style="font-size: 14px;"></i>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-light' }} rounded-pill px-3">Semua</a>
                <a href="{{ route('admin.dashboard', ['status' => 1]) }}" class="btn btn-sm {{ request('status') == 1 ? 'btn-primary' : 'btn-light' }} rounded-pill px-3">Menunggu</a>
                <a href="{{ route('admin.dashboard', ['status' => 2]) }}" class="btn btn-sm {{ request('status') == 2 ? 'btn-primary' : 'btn-light' }} rounded-pill px-3">Diproses</a>
                <a href="{{ route('admin.dashboard', ['status' => 3]) }}" class="btn btn-sm {{ request('status') == 3 ? 'btn-primary' : 'btn-light' }} rounded-pill px-3">Selesai</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-borderless m-0">
                <thead class="text-uppercase text-muted" style="font-size: 12px; font-weight: 700; border-bottom: 1px solid #eee;">
                    <tr>
                        <th style="width: 250px;">PENGHUNI</th>
                        <th>ADUAN</th>
                        <th style="width: 150px;">WAKTU</th>
                        <th style="width: 180px;">STATUS</th>
                        <th style="width: 100px; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semuaAduan as $row)
                    <tr class="align-middle border-bottom">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="profile-avatar bg-primary-subtle text-primary fw-bold d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border-radius: 50%;">
                                    {{ $row->anggota ? substr($row->anggota->nama_lengkap, 0, 1) : '?' }}
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size: 14px;">{{ $row->anggota->nama_lengkap ?? 'Data Tidak Ada' }}</div>
                                    <div class="text-muted" style="font-size: 12px;"><i class="fas fa-bed me-1"></i> Kamar {{ $row->anggota->nomor_kamar ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge mb-1" style="background-color: #eef2ff; color: #4f46e5; border-radius: 20px; font-size: 11px;">
                                {{ $row->kategori->nama_kategori }}
                            </span><br>
                            <span class="text-muted small">{{ Str::limit($row->deskripsi_masalah, 60) }}</span>
                        </td>
                        <td class="text-muted" style="font-size: 12px;">
                            <div><i class="far fa-calendar-alt me-1"></i> {{ date('d M Y', strtotime($row->waktu_aduan)) }}</div>
                            <div><i class="far fa-clock me-1"></i> {{ date('H:i', strtotime($row->waktu_aduan)) }}</div>
                        </td>
                        <td>
                            <select class="form-select form-select-sm status-dropdown-ajax 
                                {{ $row->id_status == 1 ? 'status-menunggu' : ($row->id_status == 2 ? 'status-diproses' : 'status-selesai') }}"
                                data-id="{{ $row->id_aduan }}" style="border-radius: 20px; font-weight: 600; font-size: 13px;">
                                <option value="1" {{ $row->id_status == 1 ? 'selected' : '' }}>Menunggu</option>
                                <option value="2" {{ $row->id_status == 2 ? 'selected' : '' }}>Diproses</option>
                                <option value="3" {{ $row->id_status == 3 ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </td>
                        <td style="text-align: center;">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.detail_aduan', $row->id_aduan) }}" class="btn btn-link text-muted p-0 text-decoration-none">
    <i class="fas fa-external-link-alt"></i>
</a>
                                
                                {{-- Form Delete --}}
                                <form action="{{ route('admin.aduan.destroy', $row->id_aduan) }}" method="POST" onsubmit="return confirm('Hapus aduan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Tidak ada data aduan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .status-menunggu { background-color: #fff8e1 !important; color: #856404 !important; border-color: #ffeeba !important; }
    .status-diproses { background-color: #e3f2fd !important; color: #004085 !important; border-color: #b8daff !important; }
    .status-selesai { background-color: #e8f5e9 !important; color: #155724 !important; border-color: #c3e6cb !important; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // AJAX untuk Update Status tanpa reload
    $('.status-dropdown-ajax').on('change', function() {
        let id_aduan = $(this).data('id');
        let status_baru = $(this).val();
        let element = $(this);

        $.ajax({
            url: "/admin/aduan/update-status/" + id_aduan,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id_status: status_baru
            },
            success: function(response) {
                element.removeClass('status-menunggu status-diproses status-selesai');
                if(status_baru == 1) element.addClass('status-menunggu');
                else if(status_baru == 2) element.addClass('status-diproses');
                else if(status_baru == 3) element.addClass('status-selesai');
            }
        });
    });
});
</script>
@endsection