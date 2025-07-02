@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 mb-4" style="background: #23272f;">
        <div class="card-header text-white fw-bold fs-4 d-flex align-items-center" style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); border-radius: 1rem 1rem 0 0;">
            <span class="me-2"><svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='white' class='bi bi-box-seam' viewBox='0 0 16 16'><path d='M8.186.113a1.5 1.5 0 0 0-1.372 0l-5.5 2.75A1.5 1.5 0 0 0 0 4.118V12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V4.118a1.5 1.5 0 0 0-1.314-1.255l-5.5-2.75ZM1.5 3.5l5.5-2.75a.5.5 0 0 1 .457 0l5.5 2.75a.5.5 0 0 1 .043.027L8 6.118 1.457 3.527a.5.5 0 0 1 .043-.027ZM1 4.118l6.5 3.25v6.132l-6.5-3.25V4.118Zm7.5 9.382V7.368l6.5-3.25v6.132l-6.5 3.25ZM15 12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.382l6.5 3.25a1.5 1.5 0 0 0 1.372 0l6.5-3.25V12.5Z'/></svg></span>
            Daftar Produk
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <a href="/admin/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
                <a href="/products/create" class="btn btn-primary">Tambah Produk</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle shadow-sm" style="color:#e0e7ef;">
                    <thead style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); color: #fff;">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Barcode</th>
                            <th>Barcode Image</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><span class="badge bg-info text-dark">{{ $product->barcode }}</span></td>
                            <td>{!! DNS1D::getBarcodeHTML($product->barcode, 'C128', 2, 40) !!}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <form action="/products/{{ $product->id }}" method="POST" style="display:inline-block">
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
