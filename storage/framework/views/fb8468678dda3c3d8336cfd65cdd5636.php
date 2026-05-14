<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasiliticare - <?php echo e(Auth::user()->role == 'admin' ? 'Admin' : 'Penghuni'); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root { --sidebar-width: 260px; }
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: white;
            border-right: 1px solid #eee;
            padding: 20px;
            z-index: 1000;
        }
        .main-content { margin-left: var(--sidebar-width); padding: 20px; }
        .nav-link { 
            color: #6c757d; 
            padding: 12px 15px; 
            border-radius: 10px; 
            margin-bottom: 5px;
            transition: 0.3s;
        }
        .nav-link:hover, .nav-link.active { background: #eef2ff; color: #4e73df; font-weight: bold; }
        .logout-btn { position: absolute; bottom: 20px; width: calc(var(--sidebar-width) - 40px); }
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: #eee; }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <div class="mb-5 px-3">
            <h4 class="text-primary fw-bold">FP <span class="text-dark">Fasiliticare</span></h4>
            <small class="text-muted">GRIYA PROSPERA</small>
        </div>

        <nav class="nav flex-column">
            
            <a class="nav-link <?php echo e(request()->is('*/home') ? 'active' : ''); ?>" 
               href="<?php echo e(Auth::user()->role == 'admin' ? route('admin.home') : route('user.home')); ?>">
                <i class="bi bi-house-door me-2"></i> Home
            </a>

            
            <?php if(Auth::user()->role == 'admin'): ?>
                
                <a class="nav-link <?php echo e(request()->is('admin/dashboard*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="bi bi-grid me-2"></i> Admin Dashboard
                </a>
            <?php else: ?>
                
                <a class="nav-link <?php echo e(request()->is('user/aduan/create*') ? 'active' : ''); ?>" href="<?php echo e(route('user.aduan.create')); ?>">
                    <i class="bi bi-plus-circle me-2"></i> Aduan Baru
                </a>
                <a class="nav-link <?php echo e(request()->is('user/aduan/list*') ? 'active' : ''); ?>" href="<?php echo e(route('user.aduan.list')); ?>">
                    <i class="bi bi-journal-text me-2"></i> Aduan Anda
                </a>
                <a class="nav-link <?php echo e(request()->is('user/faq*') ? 'active' : ''); ?>" href="<?php echo e(route('user.faq')); ?>">
    <i class="bi bi-question-circle me-2"></i> FAQ
</a>
            <?php endif; ?>

            
        </nav>

        <div class="logout-btn">
            <div class="d-flex align-items-center mb-3 px-2">
                <div class="bg-light rounded-circle p-2 me-2">
                    <i class="bi bi-person text-primary"></i>
                </div>
                <div>
                    <div class="fw-bold small"><?php echo e(Auth::user()->username); ?></div>
                    <div class="text-muted" style="font-size: 10px;">
                        <?php echo e(Auth::user()->role == 'admin' ? 'Administrator' : (Auth::user()->nomor_kamar ?? 'Penghuni')); ?>

                    </div>
                </div>
            </div>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-outline-danger w-100 rounded-3">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\fasiliticare-ta\resources\views/layouts/admin.blade.php ENDPATH**/ ?>