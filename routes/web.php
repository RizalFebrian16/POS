<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (!session('user_id')) {
        return redirect('/login');
    }
    if (session('user_role') === 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/transactions');
    }
});

Route::get('/admin/dashboard', function () {
    if (!session('user_id') || session('user_role') !== 'admin') {
        return redirect('/login');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');

// Produk hanya untuk admin
Route::resource('products', ProductController::class)->except(['index', 'show']);
Route::get('products', function() {
    if (!session('user_id') || session('user_role') !== 'admin') {
        return redirect('/login');
    }
    return app(ProductController::class)->index();
});
Route::get('products/{id}', function($id) {
    if (!session('user_id') || session('user_role') !== 'admin') {
        return redirect('/login');
    }
    return app(ProductController::class)->show($id);
});

// Transaksi untuk admin dan kasir
Route::get('transactions', function() {
    if (!session('user_id') || !in_array(session('user_role'), ['kasir', 'admin'])) {
        return redirect('/login');
    }
    return app(TransactionController::class)->index();
});
Route::get('transactions/create', function() {
    if (!session('user_id') || !in_array(session('user_role'), ['kasir', 'admin'])) {
        return redirect('/login');
    }
    return app(TransactionController::class)->create();
});
Route::post('transactions', function(Request $request) {
    if (!session('user_id') || !in_array(session('user_role'), ['kasir', 'admin'])) {
        return redirect('/login');
    }
    return app(TransactionController::class)->store($request);
});
Route::get('transactions/{id}', function($id) {
    if (!session('user_id') || !in_array(session('user_role'), ['kasir', 'admin'])) {
        return redirect('/login');
    }
    return app(TransactionController::class)->show($id);
});
Route::get('transactions/{id}/edit', function($id) {
    if (!session('user_id') || !in_array(session('user_role'), ['kasir', 'admin'])) {
        return redirect('/login');
    }
    return app(TransactionController::class)->edit($id);
});
Route::put('transactions/{id}', function(Request $request, $id) {
    if (!session('user_id') || !in_array(session('user_role'), ['kasir', 'admin'])) {
        return redirect('/login');
    }
    return app(TransactionController::class)->update($request, $id);
});
Route::delete('transactions/{id}', function($id) {
    if (!session('user_id') || !in_array(session('user_role'), ['kasir', 'admin'])) {
        return redirect('/login');
    }
    return app(TransactionController::class)->destroy($id);
});

// Laporan untuk admin dan kasir
Route::get('/reports', function(Request $request) {
    if (!session('user_id') || !in_array(session('user_role'), ['admin', 'kasir'])) {
        return redirect('/login');
    }
    return app(\App\Http\Controllers\TransactionController::class)->report($request);
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    $user = \App\Models\User::where('email', $credentials['email'])->first();
    if ($user && $user->password === $credentials['password']) {
        session(['user_id' => $user->id, 'user_role' => $user->role]);
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } else if ($user->role === 'kasir') {
            return redirect('/transactions');
        } else {
            return back()->with('error', 'Role tidak dikenali');
        }
    }
    return back()->with('error', 'Email atau password salah');
});

Route::get('/logout', function () {
    session()->forget(['user_id', 'user_role']);
    return redirect('/login');
})->name('logout');
