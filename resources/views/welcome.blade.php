<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAMBURGER - Modern Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-orange: #e67e22; --dark-orange: #d35400; }
        body { font-family: 'Poppins', sans-serif; scroll-behavior: smooth; color: #333; }
        
        /* Navbar Styling */
        .text-orange { color: #e67e22 !important; }
        .text-dark { color: #000000 !important; }
        .navbar-brand { font-weight: 800; color: var(--dark-orange) !important; font-size: 1.5rem; }
        .nav-link { font-weight: 500; color: #555 !important; margin: 0 15px; position: relative; cursor: pointer; }
        .nav-link.active::after {
            content: ''; position: absolute; bottom: -5px; left: 0; width: 100%; height: 2px; background: var(--primary-orange);
        }

        /* Hero Section */
        .section-padding { padding: 100px 0; }
        .hero-title { font-weight: 800; font-size: 3.5rem; line-height: 1.1; margin-bottom: 20px; }
        .hero-title span { color: var(--primary-orange); }
        .btn-custom { 
            background-color: var(--primary-orange); color: white; border-radius: 30px; 
            padding: 12px 35px; border: none; font-weight: 600; transition: 0.3s;
        }
        .btn-custom:hover { background-color: var(--dark-orange); transform: scale(1.05); color: white; }
        
        /* Floating Animation */
        .img-floating { animation: float 4s ease-in-out infinite; width: 100%; max-width: 500px; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-25px); }
        }

        /* About Section (The Exploded Burger) */
        .about-title { font-weight: 700; font-size: 2.5rem; margin-bottom: 30px; }
        .about-title span { color: var(--primary-orange); }
        .about-text { font-size: 0.95rem; line-height: 1.8; color: #666; max-width: 800px; margin: 0 auto; }

        /* Menu Placeholder */
        .menu-placeholder { 
            background: #f0f0f0; height: 250px; width: 200px; border-radius: 10px; margin: 0 auto; 
        }

        /* Footer Line */
        .footer-line { border-top: 1px solid #eee; padding: 40px 0; }
    </style>
</head>
<body>

    <!-- SECTION 1: HEADER & HERO -->
    <nav class="navbar navbar-expand-lg sticky-top bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" class="me-2">
                <span class="text-dark">HAM</span> <span class="text-orange">BURGER</span>
            </a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h5 class="fw-bold mb-3">GOOD FOOD, GOOD MOOD,</h5>
                    <h1 class="hero-title">GREAT <span>BURGER</span></h1>
                    <p class="text-muted mb-4">
                        Saat lapar datang, burger ini siap jadi penyelamat mood kamu. Dengan rasa yang lezat, tekstur yang pas, dan aroma yang menggoda, setiap gigitan bakal bikin kamu senyum sendiri.
                    </p>
                    <div class="d-flex gap-4 mb-5">
                        <div class="text-center">
                            <img src="{{ asset('images/yummy.png') }}" alt="yummy" width="30" class="me-2">
                            <p class="small fw-bold">Yummy</p></div>
                        <div class="text-center">
                            <img src="{{ asset('images/hidang.png') }}" alt="hidangan" width="30" class="me-2">
                            <p class="small fw-bold">Soft Bun</p></div>
                        <div class="text-center">
                            <img src="{{ asset('images/garpu.png') }}" alt="garpu" width="30" class="me-2">
                            <p class="small fw-bold">Flavorful</p></div>
                    </div>
                    <a href="{{ url('/login') }}" class="btn btn-custom">order now</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/burger.png') }}" class="img-fluid floating" alt="Burger">
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: WHY SHOULD YOU TRY (About) -->
    <section id="about" class="section-padding">
        <div class="container text-center">
            <h2 class="about-title">Why Should <span>You Try?</span></h2>
            <div class="my-5">
                <!-- Gambar burger yang terurai (exploded view) -->
                <img src="{{ asset('images/tentang.png') }}" 
                     alt="Exploded Burger" style="max-width: 100%; height: auto; max-height: 400px;">
            </div>
            <p class="about-text">
                Kami tidak hanya menyajikan burger; kami menciptakan momen—di mana roti yang lembut dan fresh berpadu dengan daging yang juicy dan bumbu yang pas, serta sayuran segar yang membuat semuanya terasa hidup. Ini adalah kualitas yang tidak perlu diragukan, karena bisa langsung kamu rasakan di setiap gigitan.
            </p>
        </div>
    </section>

    <!-- SECTION 4: CONTACT US (Simple Footer) -->
    <section id="contact" class="section-padding">
    <footer class="footer-line">
        <div class="container text-center">
            <p class="text-muted mb-0">© 2026 Hana Marmella. All rights reserved.</p>
        </div>
    </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>