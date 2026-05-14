

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex align-items-center mb-4">
                <a href="<?php echo e(route('user.home')); ?>" class="btn btn-link text-dark p-0 me-3">
                    <i class="bi bi-arrow-left fs-4"></i>
                </a>
                <div>
                    <h4 class="fw-bold m-0">Buat Aduan Baru</h4>
                    <p class="text-muted small m-0">Sampaikan detail kendala fasilitas anda</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 20px;">
                <form action="<?php echo e(route('user.aduan.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    
                    <div class="mb-5">
                        <label class="fw-bold small text-uppercase mb-3 d-flex align-items-center">
                            <i class="bi bi-info-circle text-primary me-2"></i> Pilih Kategori
                        </label>
                        <div class="row g-3">
                            
                            <div class="col-6 col-md-3">
                                <input type="radio" class="btn-check" name="id_kategori" id="cat1" value="1" required>
                                <label class="btn btn-outline-light w-100 p-4 border-0 bg-light text-dark shadow-none rounded-4 d-flex flex-column align-items-center justify-content-center" for="cat1">
                                    <i class="bi bi-lightning-charge fs-2 mb-2"></i>
                                    <span class="small fw-bold">Listrik</span>
                                </label>
                            </div>
                            
                            <div class="col-6 col-md-3">
                                <input type="radio" class="btn-check" name="id_kategori" id="cat2" value="2">
                                <label class="btn btn-outline-light w-100 p-4 border-0 bg-light text-dark shadow-none rounded-4 d-flex flex-column align-items-center justify-content-center" for="cat2">
                                    <i class="bi bi-droplet fs-2 mb-2"></i>
                                    <span class="small fw-bold">Air</span>
                                </label>
                            </div>
                            
                            <div class="col-6 col-md-3">
                                <input type="radio" class="btn-check" name="id_kategori" id="cat3" value="3">
                                <label class="btn btn-outline-light w-100 p-4 border-0 bg-light text-dark shadow-none rounded-4 d-flex flex-column align-items-center justify-content-center" for="cat3">
                                    <i class="bi bi-tools fs-2 mb-2"></i>
                                    <span class="small fw-bold">Perbaikan</span>
                                </label>
                            </div>
                            
                            <div class="col-6 col-md-3">
                                <input type="radio" class="btn-check" name="id_kategori" id="cat4" value="4">
                                <label class="btn btn-outline-light w-100 p-4 border-0 bg-light text-dark shadow-none rounded-4 d-flex flex-column align-items-center justify-content-center" for="cat4">
                                    <i class="bi bi-question-circle fs-2 mb-2"></i>
                                    <span class="small fw-bold">Lainnya</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-5">
                        <label class="fw-bold small text-uppercase mb-3">Deskripsi Masalah</label>
                        <textarea name="deskripsi_masalah" class="form-control border-0 bg-light p-4 rounded-4" rows="5" 
                            placeholder="Jelaskan secara detail kendala yang dialami, misalnya: 'Kran di kamar mandi menetes terus meskipun sudah ditutup rapat'..." required></textarea>
                    </div>

                    
                    <div class="mb-5">
                        <label class="fw-bold small text-uppercase mb-3">Foto Pendukung (Opsional)</label>
                        <div class="border-2 border-dashed rounded-4 p-5 text-center bg-light position-relative" id="drop-area">
                            <input type="file" name="foto" class="form-control position-absolute h-100 w-100 top-0 start-0 opacity-0 cursor-pointer" accept="image/*" id="input-foto">
                            <div id="preview-text">
                                <i class="bi bi-camera fs-1 text-muted d-block mb-2"></i>
                                <p class="mb-0 fw-bold">Klik untuk unggah foto</p>
                                <p class="text-muted small">PNG, JPG up to 5MB</p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card border-0 bg-light p-3 mb-4" style="border-radius: 15px;">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <label class="text-muted small text-uppercase fw-bold d-block" style="font-size: 10px;">Aduan Dari</label>
            <span class="fw-bold">
                
                <?php echo e(Auth::user()->username); ?> - Kamar <?php echo e(Auth::user()->anggota->nomor_kamar ?? 'N/A'); ?>

            </span>
        </div>
        <div class="bg-white rounded-circle p-2 shadow-sm">
            <i class="bi bi-person text-primary"></i>
        </div>
    </div>
</div>

                    
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-4 shadow-sm">
                        <i class="bi bi-send-fill me-2"></i> Kirim Aduan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-check:checked + label {
        background-color: #eef2ff !important;
        border: 2px solid #4e73df !important;
        color: #4e73df !important;
    }
    .border-dashed {
        border-style: dashed !important;
        border-width: 2px !important;
        border-color: #dee2e6 !important;
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fasiliticare-ta\resources\views/user/aduan_create.blade.php ENDPATH**/ ?>