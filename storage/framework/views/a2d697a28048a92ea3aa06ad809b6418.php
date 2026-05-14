<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fasiliticare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; max-width: 400px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-container w-100">
        <div class="card p-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold">FasilitiCare</h3>
                <p class="text-muted">Silakan masuk ke akun Anda</p>
            </div>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <?php echo csrf_field(); ?> 

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo e(old('username')); ?>" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2 fw-bold">Masuk</button>
                </div>

                
<div class="text-center">
    <p class="text-muted small">Belum terdaftar sebagai penghuni?</p>
    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary w-100 py-2 rounded-pill fw-bold small">
        Buat Akun Baru
    </a>
</div>
            </form>
            
            <div class="text-center mt-3">
                <small class="text-muted">Lupa password? Hubungi Admin</small>
            </div>
        </div>
    </div>
</div>

</body>
</html><?php /**PATH C:\xampp\htdocs\fasiliticare-ta\resources\views/auth/login.blade.php ENDPATH**/ ?>