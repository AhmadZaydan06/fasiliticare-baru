@extends('layouts.sidebar')

@section('content')
<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Daftar Anggota</h2>
            <p class="text-muted small mb-0">Kelola informasi data akun dan nomor kamar seluruh penghuni</p>
        </div>
        <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary shadow-sm px-3 py-2 rounded-3">
            <i class="fas fa-user-plus me-1"></i> Tambah Anggota Baru
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light text-uppercase text-secondary" style="font-size: 12px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 60px;">No</th>
                            <th class="py-3">Nama Lengkap</th>
                            <th class="py-3">Username</th>
                            <th class="py-3">Nomor Kamar</th>
                            <th class="py-3">Role</th>
                            <th class="py-3 text-center" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark" style="font-size: 14px;">
                        @forelse($anggota as $key => $row)
                        <tr>
                            <td class="text-center px-4 fw-medium text-muted">{{ $key + 1 }}</td>
                            <td class="fw-semibold">{{ $row->nama_lengkap }}</td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1.5 font-monospace">{{ $row->user->username }}</span>
                            </td>
                            <td>
                                @if($row->nomor_kamar)
                                    <span class="text-dark"><i class="bi bi-door-open me-1 text-muted"></i>{{ $row->nomor_kamar }}</span>
                                @else
                                    <span class="text-muted italic">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $row->user->role == 'admin' ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary' }} text-uppercase px-2.5 py-1" style="font-size: 11px; font-weight: 600;">
                                    {{ $row->user->role }}
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.anggota.destroy', $row->id_anggota) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota bernama {{ $row->nama_lengkap }}? Semua data akun terkait juga akan terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none shadow-none">
                                        <i class="fas fa-trash-alt fs-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-5 text-muted">
                                <i class="fas fa-users fs-2 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada data anggota yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection