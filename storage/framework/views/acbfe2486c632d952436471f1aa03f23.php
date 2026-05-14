

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); border-radius: 20px;">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-2">Halo, <?php echo e(Auth::user()->username); ?>! 👋</h2>
                    <p class="mb-0 opacity-75">Ada kendala di kamar atau fasilitas kost? Sampaikan aduanmu,<br>kami siap membantu dengan cepat.</p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning p-3 rounded-circle">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">Sedang Diproses</small>
                        <h3 class="fw-bold m-0"><?php echo e($diproses); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success p-3 rounded-circle">
                        <i class="bi bi-check2-circle fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">Selesai Perbaikan</small>
                        <h3 class="fw-bold m-0"><?php echo e($selesai); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                        <i class="bi bi-chat-left-text fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">Total Aduan Anda</small>
                        <h3 class="fw-bold m-0"><?php echo e($totalAduan); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0">Aduan Terbaru</h5>
        
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-link text-primary text-decoration-none fw-bold p-0">
            Lihat Semua <i class="bi bi-chevron-right small"></i>
        </a>
    </div>

    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $aduanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
            <div class="card border-0 shadow-sm p-3 card-hover" style="border-radius: 15px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-light p-3 rounded-3 text-primary">
                            <i class="fas fa-bolt fs-5"></i>
                        </div>
                        <div>
                            <small class="text-muted" style="font-size: 11px;">ID: <?php echo e($aduan->id_aduan); ?> • <?php echo e(date('d M Y', strtotime($aduan->waktu_aduan))); ?></small>
                            <h6 class="fw-bold mb-1"><?php echo e($aduan->kategori->nama_kategori); ?> - <?php echo e($aduan->anggota->nomor_kamar); ?></h6>
                            <p class="text-muted mb-0 small"><?php echo e(Str::limit($aduan->deskripsi_masalah, 80)); ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge rounded-pill 
                            <?php echo e($aduan->id_status == 1 ? 'bg-warning-subtle text-warning' : ($aduan->id_status == 2 ? 'bg-primary-subtle text-primary' : 'bg-success-subtle text-success')); ?>">
                            <?php echo e($aduan->status->nama_status); ?>

                        </span>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada aduan terbaru.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .card-hover { transition: 0.2s; cursor: pointer; }
    .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    .bg-warning-subtle { background-color: #fff8e1; }
    .bg-success-subtle { background-color: #e8f5e9; }
    .bg-primary-subtle { background-color: #eef2ff; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fasiliticare-ta\resources\views/admin/home.blade.php ENDPATH**/ ?>