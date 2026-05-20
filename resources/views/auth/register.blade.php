<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Fasiliticare</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .card-register {
            background: #ffffff;
            border-radius: 24px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }

        .logo-box {
            background-color: #2563eb;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-control {
            background-color: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .btn-register {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .login-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        /* Alert styling */
        .alert {
            border-radius: 12px;
            font-size: 0.85rem;
            border: none;
        }
    </style>
</head>
<body>

<div class="register-container mt-5">
    <div class="card-register">
        <div class="text-center mb-4">
            <div class="d-flex justify-content-center">
                <div class="logo-box shadow-sm">FP</div>
            </div>
            <h4 class="fw-bold m-0 text-dark">Fasiliticare</h4>
            <p class="text-muted small">Griya Prospera</p>
        </div>

        <div class="mb-4">
            <h5 class="fw-bold text-dark mb-1">Daftar Akun</h5>
            <p class="text-muted small">Silakan isi data untuk pendaftaran penghuni.</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.anggota.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama sesuai KTP" required value="{{ old('nama_lengkap') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Contoh: rudi_pro" required value="{{ old('username') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" class="form-control" placeholder="Contoh: B-09 atau A-12" required value="{{ old('nomor_kamar') }}">
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Min. 3 karakter" required>
                </div>
            </div>

            <button type="submit" class="btn btn-register">
                Daftar Sekarang