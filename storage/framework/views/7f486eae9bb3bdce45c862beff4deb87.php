

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    
    <div class="card border-0 shadow-sm text-white mb-4" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); border-radius: 20px;">
        <div class="card-body p-5 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-2">Halo, <?php echo e(Auth::user()->username); ?>! 👋</h2>
                <p class="mb-0 opacity-75">Ada kendala di kamar atau fasilitas kost? Sampaikan aduanmu,<br>kami siap membantu dengan cepat.</p>
            </div>
            <a href="<?php echo e(route('user.aduan.create')); ?>" class="btn btn-light text-primary fw-bold px-4 py-2 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Buat Aduan Baru
            </a>
        </div>
    </div>

    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning p-3 rounded-circle"><i class="bi bi-clock fs-4"></i></div>
                    <div class="text-start">
                        <div class="text-muted small fw-bold text-uppercase">Sedang Diproses</div>
                        <h2 class="fw-bold m-0"><?php echo e($diproses); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success p-3 rounded-circle"><i class="bi bi-check-circle fs-4"></i></div>
                    <div class="text-start">
                        <div class="text-muted small fw-bold text-uppercase">Selesai Perbaikan</div>
                        <h2 class="fw-bold m-0"><?php echo e($selesai); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary-subtle text-primary p-3 rounded-circle"><i class="bi bi-chat-dots fs-4"></i></div>
                    <div class="text-start">
                        <div class="text-muted small fw-bold text-uppercase">Total Aduan Anda</div>
                        <h2 class="fw-bold m-0"><?php echo e($totalAduan); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold m-0">Aduan Terbaru</h5>
        <a href="<?php echo e(route('user.aduan.list')); ?>" class="text-primary text-decoration-none small fw-bold">
            Lihat Semua <i class="bi bi-chevron-right"></i>
        </a>
    </div>

    
    <?php $__empty_1 = true; $__currentLoopData = $aduanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card border-0 shadow-sm mb-3 p-3" style="border-radius: 15px;">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    
                    <div class="bg-light p-3 rounded-3 text-primary">
                        <?php if($aduan->kategori->nama_kategori == 'Listrik'): ?>
                            <i class="bi bi-lightning-charge fs-5"></i>
                        <?php elseif($aduan->kategori->nama_kategori == 'Air'): ?>
                            <i class="bi bi-droplet fs-5"></i>
                        <?php else: ?>
                            <i class="bi bi-box-seam fs-5"></i>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <div class="text-muted small mb-1">
                            ID: <?php echo e($aduan->id_aduan); ?> • <?php echo e(\Carbon\Carbon::parse($aduan->waktu_aduan)->format('d M Y')); ?>

                        </div>
                        <h6 class="fw-bold mb-1">
                            <?php echo e($aduan->kategori->nama_kategori); ?> - <?php echo e(Auth::user()->nomor_kamar ?? 'N/A'); ?>

                        </h6>
                        <p class="text-muted small mb-0"><?php echo e(Str::limit($aduan->deskripsi_masalah, 100)); ?></p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    
                    <?php
                        $statusStyles = [
                            'Menunggu' => 'bg-warning-subtle text-warning',
                            'Diproses' => 'bg-primary-subtle text-primary',
                            'Selesai'  => 'bg-success-subtle text-success'
                        ];
                        $currentStatus = $aduan->status->nama_status ?? 'Menunggu';
                        $badgeClass = $statusStyles[$currentStatus] ?? 'bg-secondary-subtle text-secondary';
                    ?>
                    
                    <span class="badge <?php echo e($badgeClass); ?> px-3 py-2 rounded-pill small">
                        <i class="bi bi-dot"></i> <?php echo e($currentStatus); ?>

                    </span>
                    <i class="bi bi-chevron-right text-muted"></i>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        
        <div class="card border-0 shadow-sm py-5 text-center" style="border-radius: 20px; border: 2px dashed #eee !important; background: transparent;">
            <div class="py-5">
                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                    <i class="bi bi-chat-left-text text-muted fs-1"></i>
                </div>
                <h5 class="fw-bold">Belum Ada Aduan</h5>
                <p class="text-muted">Kamu belum pernah mengirimkan aduan fasilitas.</p>
                <a href="<?php echo e(route('user.aduan.create')); ?>" class="btn btn-primary px-4 py-2 mt-2" style="border-radius: 10px;">
                    Buat Aduan Pertama
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fasiliticare-ta\resources\views/user/home.blade.php ENDPATH**/ ?>