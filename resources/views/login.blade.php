<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #23272f;
            border-radius: 1.5rem;
            box-shadow: 0 4px 32px rgba(0,0,0,0.18);
            padding: 2.5rem 2rem 2rem 2rem;
            max-width: 400px;
            width: 100%;
        }
        .login-title {
            font-weight: 700;
            color: #38bdf8;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .form-label, .form-control, .alert {
            color: #e0e7ef;
        }
        .form-control {
            background: #23272f;
            border: 1px solid #495057;
        }
        .form-control:focus {
            background: #23272f;
            color: #fff;
            border-color: #38bdf8;
            box-shadow: 0 0 0 0.2rem rgba(56,189,248,.15);
        }
        .btn-primary {
            background: linear-gradient(90deg, #38bdf8 60%, #6366f1 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
        }
        .alert-danger {
            background: #ef4444;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>
<div class="login-card mx-auto">
    <h2 class="login-title text-center">Login POS</h2>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>
