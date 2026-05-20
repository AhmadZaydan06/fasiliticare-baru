@extends('layouts.sidebar')

@section('content')
<style>
    .stepper-container {
        max-width: 600px;
        position: relative;
        margin: 3rem auto;
    }
    .stepper-line-bg {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        height: 3px;
        background-color: #e2e8f0;
        z-index: 0;
    }
    .stepper-line-progress {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        height: 3px;
        background-color: #0d6efd;
        width: 0%; /* Diatur dinamis via JS */
        transition: width 0.5s ease-in-out;
        z-index: 0;
    }
    .step-dot {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #f8f9fa;
        border: 2px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        transition: all 0.4s ease;
    }
    /* State Warna Aktif dari JS */
    .step-item.active .step-dot {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff !important;
        box-shadow: 0 0.125rem 0.25rem rgba(13, 110, 253, 0.4);
    }
    .step-item.success-active .step-dot {
        background-color: #198754;
        border-color: #198754;
        color: #ffffff !important;
        box-shadow: 0 0.125rem 0.25rem rgba(25, 135, 84, 0.4);
    }
    .step-item.active .step-label {
        color: #0d6efd !important;
        font-weight: bold;
    }
    .step-item.success-active .step-label {
        color: #198754 !important;
        font-weight: bold;
    }
</style>

<div class="container my-4">
    <div class="mb-3">
        <a href="{{ route('user.aduan.list') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
    <span class="text-warning fw-bold">{{ $aduan->status->nama_status }}</span>
    <span class="text-muted small ms-2">ID: {{ $aduan->id_aduan }}</span>
    
    <h1 class="fw-bold mt-2">{{ $aduan->kategori->nama_kategori }}</h1>
    <p class="text-muted">Detail informasi aduan fasilitas yang telah dilaporkan</p>

    <div class="stepper-container" id="statusStepper" data-status="{{ $aduan->id_status ?? 1 }}">
        <div class="stepper-line-bg"></div>
        <div class="stepper-line-progress" id="progressLine"></div>

        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 1;">
            <div class="text-center step-item" data-step="1">
                <div class="step-dot text-muted">
                    <i class="bi bi-clock-history fs-5"></i>
                </div>
                <span class="small step-label text-muted">Diterima</span>
            </div>

            <div class="text-center step-item" data-step="2">
                <div class="step-dot text-muted">
                    <i class="bi bi-gear-fill fs-5"></i>
                </div>
                <span class="small step-label text-muted">Diproses</span>
            </div>

            <div class="text-center step-item" data-step="3">
                <div class="step-dot text-muted">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                </div>
                <span class="small step-label text-muted">Selesai</span>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 mb-4">
            <label class="text-muted small text-uppercase d-block mb-1"><i class="bi bi-person"></i> Pelapor</label>
            <h5 class="fw-bold text-dark">{{ $aduan->anggota->user->username }}</h5>
        </div>
        
        <div class="col-md-6 mb-4">
            <label class="text-muted small text-uppercase d-block mb-1"><i class="bi bi-geo-alt"></i> Lokasi</label>
            <h5 class="fw-bold text-dark">Kamar {{ $aduan->anggota->nomor_kamar }}</h5>
        </div>

        <div class="col-md-6 mb-4">
            <label class="text-muted small text-uppercase d-block mb-1"><i class="bi bi-tags"></i> Kategori</label>
            <h5 class="fw-bold text-dark">{{ $aduan->kategori->nama_kategori }}</h5>
        </div>

        <div class="col-md-6 mb-4">
            <label class="text-muted small text-uppercase d-block mb-1"><i class="bi bi-calendar3"></i> Waktu Lapor</label>
            <h5 class="fw-bold text-dark">{{ \Carbon\Carbon::parse($aduan->waktu_aduan)->translatedFormat('d F Y') }}</h5>
            <small class="text-muted">{{ \Carbon\Carbon::parse($aduan->waktu_aduan)->format('H:i') }} WIB</small>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <div class="mb-4">
        <label class="text-muted small text-uppercase d-block mb-2"><i class="bi bi-file-text"></i> Deskripsi Masalah</label>
        <div class="p-3 bg-light rounded-3 border">
            <p class="mb-0 text-secondary" style="white-space: pre-line;">{{ $aduan->deskripsi_masalah }}</p>
        </div>
    </div>

    <div class="mb-5">
        <label class="text-muted small text-uppercase d-block mb-2"><i class="bi bi-image"></i> Foto Pendukung</label>
        @if($aduan->lampiran_foto)
            <div class="card overflow-hidden border border-2 rounded-4 shadow-sm" style="max-width: 400px;">
                <img src="{{ asset('storage/aduan/' . $aduan->lampiran_foto) }}" class="img-fluid" alt="Foto Lampiran Aduan" style="object-fit: cover; max-height: 300px;">
            </div>
        @else
            <div class="p-4 bg-light rounded-3 text-center border border-dashed">
                <i class="bi bi-image-alt fs-2 text-muted d-block mb-1"></i>
                <span class="text-muted small">Tidak ada foto pendukung yang dilampirkan.</span>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stepper = document.getElementById("statusStepper");
        // Membaca attribute data-status yang diisi oleh backend Laravel
        const currentStatus = parseInt(stepper.getAttribute("data-status")) || 1;
        
        const progressLine = document.getElementById("progressLine");
        const stepItems = document.querySelectorAll(".step-item");

        function updateStepper(status) {
            // Kontrol panjang dan warna garis progres otomatis
            if (status === 1) {
                progressLine.style.width = "0%";
            } else if (status === 2) {
                progressLine.style.width = "50%";
                progressLine.style.backgroundColor = "#0d6efd"; // Tetap biru
            } else if (status === 3) {
                progressLine.style.width = "100%";
                progressLine.style.backgroundColor = "#198754"; // Berubah hijau saat selesai
            }

            // Kontrol penambahan class aktif pada tiap-tiap titik
            stepItems.forEach(item => {
                const stepIndex = parseInt(item.getAttribute("data-step"));

                if (status === 3 && stepIndex === 3) {
                    item.classList.add("success-active");
                } else if (stepIndex <= status) {
                    item.classList.add("active");
                } else {
                    item.classList.remove("active", "success-active");
                }
            });
        }

        // Jalankan fungsi update
        updateStepper(currentStatus);
    });
</script>
@endsection