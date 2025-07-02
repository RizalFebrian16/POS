@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 mb-4" style="background: #23272f;">
        <div class="card-header text-white fw-bold fs-4 d-flex align-items-center" style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); border-radius: 1rem 1rem 0 0;">
            <span class="me-2"><svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='white' class='bi bi-bar-chart-line' viewBox='0 0 16 16'><path d='M0 0h1v15h15v1H0V0zm10 10h2V5h-2v5zm-3 0h2V1H7v9zm-3 0h2V7H4v3z'/></svg></span>
            Laporan Penjualan
        </div>
        <div class="card-body">
            <form method="GET" action="/reports" class="row g-3 mb-4">
                <div class="col-auto">
                    <input type="date" name="from" class="form-control" value="{{ request('from') }}" placeholder="Dari Tanggal">
                </div>
                <div class="col-auto">
                    <input type="date" name="to" class="form-control" value="{{ request('to') }}" placeholder="Sampai Tanggal">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>
            <a href="{{ url(session('user_role') === 'admin' ? 'admin/dashboard' : 'transactions') }}" class="btn btn-secondary mb-3">Kembali</a>
            <div class="table-responsive">
                <table class="table table-bordered align-middle shadow-sm" style="color:#e0e7ef;">
                    <thead style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); color: #fff;">
                        <tr>
                            <th>Tanggal</th>
                            <th>ID Transaksi</th>
                            <th>Total</th>
                            <th>Kasir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                        <tr>
                            <td>{{ $trx->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $trx->id }}</td>
                            <td>Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                            <td>{{ $trx->user->name ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
