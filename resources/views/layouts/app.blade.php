<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPPG')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .navbar-brand-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            padding: 5px 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .navbar-brand-box img {
            height: 30px;
            margin-right: 10px;
        }
        .navbar-brand-box span {
            font-weight: bold;
            color: #003366;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Kotak Logo + Teks -->
            <div class="navbar-brand-box d-flex align-items-center">
                <img src="https://web.archive.org/web/20250714151237/http://simdabgn.com/assets/logobgn-DY3NPLU4.png"
                     alt="Logo" 
                     style="height:40px; margin-right:10px;">
                <span class="fw-bold">Badan Gizi Nasional Indonesia</span>
            </div>
            

            <!-- Menu kanan -->
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/statistik">Statistik</a></li>
                    <li class="nav-item"><a class="nav-link" href="/data">Data</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten halaman -->
    <div class="container py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
