@extends('layouts.admin')

@section('content')
<style>
    /* CSS Khusus Halaman FAQ agar sesuai desain Fasiliticare */
    .bg-soft-primary { background-color: #eef2ff !important; }
    
    /* Style Accordion Item */
    .accordion-item {
        border-radius: 15px !important;
        overflow: hidden;
        border: none !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    /* Tombol FAQ Saat Aktif & Tidak Aktif */
    .accordion-button {
        font-size: 0.95rem;
        padding: 1.25rem;
    }

    .accordion-button:not(.collapsed) {
        background-color: white !important;
        color: #2563eb !important;
        box-shadow: none !important;
    }

    /* Custom Icon Plus/Minus */
    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232563eb'%3e%3cpath fill-rule='evenodd' d='M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2z'/%3e%3c/svg%3e") !important;
        transition: transform 0.2s ease-in-out;
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232563eb'%3e%3cpath fill-rule='evenodd' d='M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8z'/%3e%3c/svg%3e") !important;
    }

    /* CTA WhatsApp Card */
    .bg-cta-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        border-radius: 20px;
    }
</style>

<div class="container py-4">
    {{-- Header --}}
    <div class="text-center mb-5">
        <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill small fw-bold mb-3">
            <i class="bi bi-question-circle me-1"></i> PUSAT BANTUAN
        </span>
        <h2 class="fw-bold text-dark">Pertanyaan Sering Diajukan</h2>
        <p class="text-muted small">Temukan jawaban cepat untuk kendala umum yang sering dihadapi penghuni Kost Griya Prospera.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="accordion accordion-flush" id="faqAccordion">
                
                {{-- Item 1 --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Berapa lama waktu penanganan aduan?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small pt-0">
                            Kami berkomitmen untuk merespon aduan dalam waktu maksimal 2 jam selama jam operasional (08:00 - 20:00). 
                            Untuk pengerjaan fisik tergantung tingkat kerusakan, namun biasanya diselesaikan dalam waktu 1x24 jam.
                        </div>
                    </div>
                </div>

                {{-- Item 5 --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bolehkah saya memperbaiki sendiri fasilitas yang rusak?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small pt-0">
                            Demi keamanan dan standarisasi fasilitas, kami sangat menyarankan untuk melaporkan setiap kerusakan melalui Fasiliticare agar teknisi resmi kami yang menangani. 
                            Memperbaiki sendiri tanpa izin dapat menghilangkan jaminan tanggung jawab pengelola.
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Bolehkah saya memperbaiki sendiri fasilitas yang rusak?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small pt-0">
                            Demi keamanan dan standarisasi fasilitas, kami sangat menyarankan untuk melaporkan setiap kerusakan melalui Fasiliticare agar teknisi resmi kami yang menangani. 
                            Memperbaiki sendiri tanpa izin dapat menghilangkan jaminan tanggung jawab pengelola.
                        </div>
                    </div>
                </div>
<div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Bolehkah saya memperbaiki sendiri fasilitas yang rusak?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small pt-0">
                            Demi keamanan dan standarisasi fasilitas, kami sangat menyarankan untuk melaporkan setiap kerusakan melalui Fasiliticare agar teknisi resmi kami yang menangani. 
                            Memperbaiki sendiri tanpa izin dapat menghilangkan jaminan tanggung jawab pengelola.
                        </div>
                    </div>
                </div>
<div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            Bolehkah saya memperbaiki sendiri fasilitas yang rusak?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted small pt-0">
                            Demi keamanan dan standarisasi fasilitas, kami sangat menyarankan untuk melaporkan setiap kerusakan melalui Fasiliticare agar teknisi resmi kami yang menangani. 
                            Memperbaiki sendiri tanpa izin dapat menghilangkan jaminan tanggung jawab pengelola.
                        </div>
                    </div>
                </div>


                {{-- Tambahkan item lainnya di sini dengan format yang sama --}}

            </div>

            {{-- WhatsApp Box --}}
            <div class="bg-cta-primary p-4 mt-5 shadow-sm text-center">
                <div class="d-md-flex align-items-center justify-content-between text-white text-start">
                    <div>
                        <h5 class="fw-bold mb-1">Masih punya pertanyaan lain?</h5>
                        <p class="small mb-0 opacity-75">Tim kami selalu siap membantu anda 24/7 untuk kendala mendesak.</p>
                    </div>
                    <a href="https://wa.me/6285697376203" class="btn btn-white bg-white text-primary fw-bold rounded-pill px-4 mt-3 mt-md-0">
                        <i class="bi bi-whatsapp me-2"></i> Hubungi WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection