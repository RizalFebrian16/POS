@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 mb-4" style="background: #23272f;">
        <div class="card-header text-white fw-bold fs-4 d-flex align-items-center" style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); border-radius: 1rem 1rem 0 0;">
            <span class="me-2"><svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='white' class='bi bi-receipt-cutoff' viewBox='0 0 16 16'><path d='M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h.5A1.5 1.5 0 0 1 15 2.5v11A1.5 1.5 0 0 1 13.5 15H2.5A1.5 1.5 0 0 1 1 13.5v-11A1.5 1.5 0 0 1 2.5 1H3V.5a.5.5 0 0 1 .5-.5ZM2.5 2A.5.5 0 0 0 2 2.5v11a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-11a.5.5 0 0 0-.5-.5h-11ZM3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Z'/></svg></span>
            Daftar Transaksi
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <a href="/admin/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
                <a href="/transactions/create" class="btn btn-primary">Tambah Transaksi</a>
                <a href="/reports" class="btn btn-info">Laporan Penjualan</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle shadow-sm" style="color:#e0e7ef;">
                    <thead style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); color: #fff;">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->transaction_date }}</td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>
                                <a href="/transactions/{{ $transaction->id }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="/transactions/{{ $transaction->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <form action="/transactions/{{ $transaction->id }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
