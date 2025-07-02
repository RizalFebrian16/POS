@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transaksi</h1>
    <form action="/transactions/{{ $transaction->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
            <input type="datetime-local" class="form-control" id="transaction_date" name="transaction_date" value="{{ date('Y-m-d\TH:i', strtotime($transaction->transaction_date)) }}" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" value="{{ $transaction->total }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
