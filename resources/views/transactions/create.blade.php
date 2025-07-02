@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 mb-4" style="background: #23272f;">
        <div class="card-header text-white fw-bold fs-4 d-flex align-items-center" style="background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%); border-radius: 1rem 1rem 0 0;">
            <span class="me-2"><svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='white' class='bi bi-plus-square' viewBox='0 0 16 16'><path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zm-1 1H3a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z'/><path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/></svg></span>
            Tambah Transaksi
        </div>
        <div class="card-body">
            <form action="/transactions" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="transaction_date" class="form-label text-white">Tanggal Transaksi</label>
                    <input type="datetime-local" class="form-control" id="transaction_date" name="transaction_date" required>
                </div>
                <h4 class="text-info">Produk</h4>
                <div id="produk-list">
                    <div class="row mb-2">
                        <div class="col-md-5">
                            <select name="items[0][product_id]" class="form-control" required>
                                <option value="">Pilih Produk</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="items[0][qty]" class="form-control" placeholder="Qty" min="1" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary mb-3" id="add-produk">Tambah Produk</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/transactions" class="btn btn-secondary mb-3">Kembali ke Daftar Transaksi</a>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

<script>
let produkIndex = 1;
document.getElementById('add-produk').onclick = function() {
    let list = document.getElementById('produk-list');
    let row = document.createElement('div');
    row.className = 'row mb-2';
    row.innerHTML = `
        <div class="col-md-5">
            <select name="items[${produkIndex}][product_id]" class="form-control" required>
                <option value=\"\">Pilih Produk</option>
                @foreach($products as $product)
                <option value=\"{{ $product->id }}\">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" name="items[${produkIndex}][qty]" class="form-control" placeholder="Qty" min="1" required>
        </div>
    `;
    list.appendChild(row);
    produkIndex++;
};
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-remove')) {
        e.target.closest('.row').remove();
    }
});
</script>
