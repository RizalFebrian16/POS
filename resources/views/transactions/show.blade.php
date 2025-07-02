@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 mb-4" style="background: linear-gradient(135deg, #f8fafc 80%, #e0e7ff 100%);">
                <div class="card-header bg-gradient text-white fw-bold fs-4 d-flex align-items-center" style="background: linear-gradient(90deg, #6366f1 0%, #0ea5e9 100%);">
                    <span class="me-2"><svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='white' class='bi bi-receipt' viewBox='0 0 16 16'><path d='M1.92.506a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .8.4v14a.5.5 0 0 1-.8.4l-.94-.705-.94.705a.5.5 0 0 1-.58 0l-.94-.705-.94.705a.5.5 0 0 1-.58 0l-.94-.705-.94.705a.5.5 0 0 1-.58 0l-.94-.705-.94.705a.5.5 0 0 1-.58 0l-.94-.705-.94.705a.5.5 0 0 1-.8-.4v-14a.5.5 0 0 1 .8-.4ZM2 1.934v12.132l.44-.33a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.94.705.94-.705a.5.5 0 0 1 .58 0l.44.33V1.934l-.44.33a.5.5 0 0 1-.58 0l-.94-.705-.94.705a.5.5 0 0 1-.58 0l-.94-.705-.94.705a.5.5 0 0 1-.58 0l-.94-.705-.94.705a.5.5 0 0 1-.58 0l-.44-.33Z'/><path d='M3 4.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Z'/></svg></span>
                    Detail Transaksi
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-secondary mb-2">ID: {{ $transaction->id }}</span><br>
                        <strong>Tanggal:</strong> {{ $transaction->transaction_date }}<br>
                    </div>
                    <h4 class="mb-3 text-primary">Item Transaksi</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle shadow-sm">
                            <thead class="table-info">
                                <tr>
                                    <th>Produk</th>
                                    <th>Barcode</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach($transaction->items as $item)
                                @php $subtotal = $item->qty * $item->price; $grandTotal += $subtotal; @endphp
                                <tr>
                                    <td><span class="fw-semibold">{{ $item->product->name ?? '-' }}</span></td>
                                    <td><span class="badge bg-info text-dark">{{ $item->product->barcode ?? '-' }}</span></td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Grand Total</th>
                                    <th class="bg-success text-white fs-5">Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                        @if($transaction->status !== 'void')
                            <form action="/transactions/{{ $transaction->id }}/void" method="POST" style="display:inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger">Void/Batalkan Transaksi</button>
                            </form>
                        @else
                            <span class="badge bg-danger">Transaksi Dibatalkan</span>
                        @endif
                        </div>
                        <a href="/transactions" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
