<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .card { border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
        .btn-primary, .btn-success, .btn-info { box-shadow: 0 2px 4px rgba(0,0,0,0.06); }
        h1, h4 { font-weight: 700; }
        table th { background: #e9ecef; }
        .form-control:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.2rem rgba(13,110,253,.15); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">POS App</a>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
