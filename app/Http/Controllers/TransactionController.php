<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('items')->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = \App\Models\Product::all();
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $total = 0;
            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'transaction_date' => $request->transaction_date ?? now(),
                'total' => 0, // sementara, update setelah item
            ]);
            if ($request->items) {
                foreach ($request->items as $item) {
                    $product = \App\Models\Product::find($item['product_id']);
                    $harga = $product ? $product->price : 0;
                    $subtotal = $item['qty'] * $harga;
                    $total += $subtotal;
                    TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $item['product_id'],
                        'qty' => $item['qty'],
                        'price' => $harga,
                    ]);
                    if ($product) {
                        $product->stock -= $item['qty'];
                        $product->save();
                    }
                }
            }
            $transaction->total = $total;
            $transaction->save();
            DB::commit();
            return redirect('/transactions');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('items.product')->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'transaction_date' => $request->transaction_date,
            'total' => $request->total,
        ]);
        return redirect('/transactions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect('/transactions');
    }

    /**
     * Batalkan transaksi dan kembalikan stok produk.
     */
    public function void($id)
    {
        $transaction = Transaction::with('items')->findOrFail($id);
        if ($transaction->status === 'void') {
            return redirect('/transactions')->with('error', 'Transaksi sudah dibatalkan.');
        }
        // Kembalikan stok produk
        foreach ($transaction->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock += $item->qty;
                $product->save();
            }
        }
        $transaction->status = 'void';
        $transaction->save();
        return redirect('/transactions')->with('success', 'Transaksi berhasil dibatalkan (void).');
    }

    /**
     * Tampilkan laporan penjualan dengan filter tanggal.
     */
    public function report(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $query = Transaction::with('user');
        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }
        $transactions = $query->orderBy('created_at', 'desc')->get();
        return view('reports.index', compact('transactions'));
    }
}
