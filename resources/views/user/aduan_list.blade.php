@extends('layouts.sidebar')

@section('content')
<div class="container-fluid py-4">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold m-0 text-dark">Riwayat Aduan</h4>
            <p class="text-muted small m-0">Pantau perkembangan laporan fasilitas Anda</p>
        </div>
        <a href="{{ route('user.aduan.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Buat Aduan
        </a>
    </div>

    {{-- Daftar Aduan --}}
    <div class="row">
        <div class="col-12">
            @forelse($aduan as $item)
                @php
                    // Logika warna berdasarkan status
                    $statusName = strtolower($item->status->nama_status);
                    $badgeClass = match($statusName) {
                        'menunggu' => 'bg-warning-subtle text-warning border-warning',
                        'diproses' => 'bg-primary-subtle text-primary border-primary',
                        'selesai'  => 'bg-success-subtle text-success border-success',
                        default    => 'bg-secondary-subtle text-secondary border-secondary'
                    };
                @endphp

                <div class="card border-0 shadow-sm mb-3 overflow-hidden" style="border-radius: 16px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            {{-- Info Kiri: Icon & Detail --}}
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-3 rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    @if($item->kategori->nama_kategori == 'Listrik')
                                        <i class="bi bi-lightning-charge text-primary fs-4"></i>
                                    @elseif($item->kategori->nama_kategori == 'Air')
                                        <i class="bi bi-droplet text-primary fs-4"></i>
                                    @elseif($item->kategori->nama_kategori == 'Perbaikan')
                                        <i class="bi bi-tools text-primary fs-4"></i>
                                    @else
                                        <i class="bi bi-box-seam text-primary fs-4"></i>
                                    @endif
                                </div>
                                
                                <div>
                                    <div class="text-muted small mb-1" style="font-size: 11px;">
                                        ID: #{{ $item->id_aduan }} • {{ \Carbon\Carbon::parse($item->waktu_aduan)->format('d M Y') }}
                                    </div>
                                    <h6 class="fw-bold mb-1 text-dark">
                                        {{ $item->kategori->nama_kategori }} - {{ Auth::user()->anggota->nomor_kamar ?? 'N/A' }}
                                    </h6>
                                    <p class="text-muted small mb-0 text-truncate" style="max-width: 250px;">
                                        {{ $item->deskripsi_masalah }}
                                    </p>
                                </div>
                            </div>

                            {{-- Info Kanan: Status & Arrow --}}
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge {{ $badgeClass }} border px-3 py-2 rounded-pill fw-normal" style="min-width: 110px;">
                                    <i class="bi bi-dot fs-5 align-middle"></i> {{ ucfirst($item->status->nama_status) }}
                                </span>
                                
                           <a href="{{ route('user.detail_aduan', $item->id_aduan) }}" class="btn btn-link text-primary p-0 text-decoration-none fs-5">
    <i class="bi bi-chevron-right"></i>
</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <img src="{{ asset('assets/img/empty-box.png') }}" alt="Empty" style="width: 150px;" class="mb-3 opacity-50">
                    <h5 class="text-muted">Belum ada aduan yang dibuat</h5>
                </div>
            @endforelse

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $aduan->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Style tambahan agar mirip desain Fasiliticare */
    .bg-warning-subtle { background-color: #fff9db !important; }
    .bg-primary-subtle { background-color: #eef2ff !important; }
    .bg-success-subtle { background-color: #ebfbee !important; }
    
    .card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .card:hover { 
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
    }
</style>
@endsection