@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0" style="background: #23272f;">
                <div class="card-header text-white fw-bold fs-4 d-flex align-items-center" style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); border-radius: 1rem 1rem 0 0;">
                    <span class="me-2"><svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='white' class='bi bi-speedometer2' viewBox='0 0 16 16'><path d='M8 4a.5.5 0 0 1 .5.5v4.707l2.146 2.147a.5.5 0 0 1-.708.708l-2.2-2.2A.5.5 0 0 1 7.5 9V4.5A.5.5 0 0 1 8 4z'/><path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14z'/></svg></span>
                    Dashboard Admin
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <span class="fs-5 text-white">Selamat datang di <span class="fw-bold text-info">Dashboard Admin</span>!</span>
                    </div>
                    <div class="d-flex flex-wrap gap-3 justify-content-center mb-4">
                        <a href="{{ url('products') }}" class="btn btn-primary btn-lg px-4 shadow-sm"><i class="bi bi-box-seam me-2"></i>Kelola Produk</a>
                        <a href="{{ url('transactions') }}" class="btn btn-success btn-lg px-4 shadow-sm"><i class="bi bi-cash-coin me-2"></i>Kelola Transaksi</a>
                        <a href="{{ url('reports') }}" class="btn btn-info btn-lg px-4 shadow-sm"><i class="bi bi-bar-chart-line me-2"></i>Laporan Penjualan</a>
                    </div>
                    <a href="{{ url('logout') }}" class="btn btn-danger float-end">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
