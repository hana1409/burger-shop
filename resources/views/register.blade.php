<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - HAMBURGER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; }
        .register-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 40px; }
        .btn-orange { background-color: #e67e22; color: white; border-radius: 10px; font-weight: 600; }
        .btn-orange:hover { background-color: #d35400; color: white; }
        .text-orange { color: #e67e22; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card register-card">
                <div class="text-center mb-4">
                    <h3 class="fw-bold"><span class="text-dark">HAM</span><span class="text-orange">BURGER</span></h3>
                    <p class="text-muted small">Buat akun baru untuk mulai memesan</p>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="btn btn-orange w-100 py-2 mt-2">Daftar Sekarang</button>
                </form>

                <div class="text-center mt-4">
                    <p class="small">Sudah punya akun? <a href="/login" class="text-orange text-decoration-none fw-bold">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>