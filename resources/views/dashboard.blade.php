<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - HAMBURGER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fff; color: #333; }
        .text-orange { color: #e67e22; }
        .btn-orange { background-color: #e67e22; color: white; border-radius: 12px; font-weight: 600; transition: 0.3s; }
        .btn-orange:hover { background-color: #d35400; color: white; }

        .product-card { border: 1px solid #f1f1f1; border-radius: 20px; transition: 0.3s; cursor: pointer; text-align: center; padding: 20px; height: 100%; background: #fff; }
        .product-card:hover { box-shadow: 0 10px 25px rgba(0,0,0,0.05); transform: translateY(-5px); }
        /* Highlight saat dipanggil dari tombol Ganti di checkout */
        .product-card.highlight-ganti { box-shadow: 0 0 0 3px #e67e22; animation: pulseCard 0.8s ease 2; }
        @keyframes pulseCard { 0%,100%{transform:translateY(0) scale(1);} 50%{transform:translateY(-6px) scale(1.02);} }

        .product-img { width: 100%; height: 130px; object-fit: contain; margin-bottom: 15px; }
        .price { color: #e67e22; font-weight: bold; font-size: 1rem; }
        .title { font-size: 0.9rem; font-weight: 600; margin-bottom: 5px; color: #444; }

        .floating-cart { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); background: #e67e22; color: white; padding: 15px 35px; border-radius: 20px; display: flex; justify-content: space-between; align-items: center; width: 90%; max-width: 450px; text-decoration: none; box-shadow: 0 15px 30px rgba(230,126,34,0.3); z-index: 1000; }

        .size-btn { border: 1px solid #eee; background: white; padding: 10px; border-radius: 12px; flex: 1; margin: 0 5px; font-size: 0.85rem; transition: 0.2s; }
        .size-btn.active { border-color: #e67e22; color: #e67e22; background: #fff9f4; font-weight: bold; }
        .addon-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f9f9f9; }
        .qty-control { display: flex; align-items: center; gap: 12px; }
        .btn-qty { width: 28px; height: 28px; border: 1px solid #ddd; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; transition: 0.2s; cursor: pointer; }
        .btn-qty:hover { background: #f8f8f8; }

        /* Badge keranjang di header */
        .cart-badge { position: relative; display: inline-block; }
        .cart-badge .badge-count { position: absolute; top: -6px; right: -8px; background: #e67e22; color: white; border-radius: 50%; font-size: 10px; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-weight: bold; }
    </style>
</head>
<body>

<div class="container py-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h4 class="fw-bold m-0"> HAM<span class="text-orange">BURGER</span></h4>
        <div class="d-flex align-items-center gap-3">
            <!-- Ikon keranjang dengan badge jumlah item -->
            <div class="cart-badge" id="headerCartIcon" style="display:none; cursor:pointer;" onclick="goToCheckout()">
                <i class="fa-solid fa-cart-shopping fs-5"></i>
                <span class="badge-count" id="headerCartCount">0</span>
            </div>
            <span class="small text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Logout</button>
            </form>
        </div>
    </div>

    <h2 class="fw-bold">Menu <span class="text-orange">Andalan</span> Kami</h2>
    <p class="text-muted small">Pilih burger favoritmu dan kustomisasi sesuai seleramu!</p>

    <!-- Kategori Burger -->
    <h6 class="fw-bold mt-5 mb-3 text-uppercase" style="letter-spacing: 1px;">Burger :</h6>
    <div class="row row-cols-2 row-cols-md-4 g-4">
        <div class="col" id="card-1" onclick="openCustomModal(1)">
            <div class="product-card">
                <img src="{{ asset('images/beef.png') }}" class="product-img">
                <div class="title">Grill Beef Burger</div>
                <div class="price">Rp.35.000</div>
            </div>
        </div>
        <div class="col" id="card-2" onclick="openCustomModal(2)">
            <div class="product-card">
                <img src="{{ asset('images/chicken.png') }}" class="product-img">
                <div class="title">Crispy Chicken Burger</div>
                <div class="price">Rp.28.000</div>
            </div>
        </div>
        <div class="col" id="card-3" onclick="openCustomModal(3)">
            <div class="product-card">
                <img src="{{ asset('images/abon.png') }}" class="product-img">
                <div class="title">Shredded Chicken Burger</div>
                <div class="price">Rp.25.000</div>
            </div>
        </div>
        <div class="col" id="card-4" onclick="openCustomModal(4)">
            <div class="product-card">
                <img src="{{ asset('images/kentang.png') }}" class="product-img">
                <div class="title">French Fries</div>
                <div class="price">Rp.15.000</div>
            </div>
        </div>
    </div>

    <!-- Kategori Minuman -->
    <h6 class="fw-bold mt-5 mb-3 text-uppercase" style="letter-spacing: 1px;">Minuman :</h6>
    <div class="row row-cols-2 row-cols-md-4 g-4 mb-5">
        <div class="col" id="card-5" onclick="openCustomModal(5)">
            <div class="product-card">
                <img src="{{ asset('images/kopi.png') }}" class="product-img">
                <div class="title">Starbuck</div>
                <div class="price">Rp.25.000</div>
            </div>
        </div>
        <div class="col" id="card-6" onclick="openCustomModal(6)">
            <div class="product-card">
                <img src="{{ asset('images/cola.png') }}" class="product-img">
                <div class="title">Coca-Cola</div>
                <div class="price">Rp.15.000</div>
            </div>
        </div>
        <div class="col" id="card-7" onclick="openCustomModal(7)">
            <div class="product-card">
                <img src="{{ asset('images/sprite.png') }}" class="product-img">
                <div class="title">Sprite</div>
                <div class="price">Rp.15.000</div>
            </div>
        </div>
        <div class="col" id="card-8" onclick="openCustomModal(8)">
            <div class="product-card">
                <img src="{{ asset('images/air.png') }}" class="product-img">
                <div class="title">Air Mineral</div>
                <div class="price">Rp.5.000</div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Cart Button -->
<div id="cartTrigger" style="display: none;">
    <div class="floating-cart" onclick="goToCheckout()" style="cursor:pointer;">
        <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="small" id="cartCount">0 produk</span>
            <span class="fw-bold" id="cartTotalDisplay">Rp.0</span>
        </div>
        <i class="fa-solid fa-arrow-right"></i>
    </div>
</div>

<!-- MODAL KUSTOMISASI -->
<div class="modal fade" id="customModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 p-4 shadow-lg" style="border-radius: 30px;">
            <div class="row">
                <div class="col-md-7">
                    <button type="button" class="btn-close mb-3" data-bs-dismiss="modal"></button>
                    <h4 class="fw-bold text-orange" id="modalTitle"></h4>
                    <p class="text-muted small mb-4" id="modalDesc"></p>
                    <h5 class="fw-bold mb-4" id="modalPrice"></h5>

                    <div id="sectionSize">
                        <div class="d-flex mb-4">
                            <button class="size-btn active" onclick="selectSize(this, 'regular')">Regular</button>
                            <button class="size-btn" onclick="selectSize(this, 'small')">Small</button>
                            <button class="size-btn" onclick="selectSize(this, 'large')">Large</button>
                        </div>
                    </div>
                    <div id="sectionSuhu" style="display: none;">
                        <label class="small fw-bold mb-2">Suhu Minuman <span class="text-muted fw-normal">select 1</span></label>
                        <div class="d-flex mb-4">
                            <button class="size-btn active">Cold (Es)</button>
                            <button class="size-btn">Normal</button>
                        </div>
                    </div>

                    <label class="small fw-bold mb-2">Add Toping <span class="text-muted fw-normal">optional</span></label>
                    <div id="topingArea" class="mb-4"></div>

                    <label class="small fw-bold mb-2">Reduce Toping <span class="text-muted fw-normal">optional</span></label>
                    <div id="reduceArea" class="mb-4"></div>
                </div>

                <div class="col-md-5 d-flex flex-column align-items-center justify-content-center bg-light rounded-4 p-4">
                    <img id="modalImg" src="" style="width:100%; max-height:200px; object-fit:contain; margin-bottom:30px;">
                    <div class="qty-control mb-4">
                        <button class="btn-qty" onclick="updateMainQty(-1)">-</button>
                        <span class="fw-bold fs-5" id="mainQty">1</span>
                        <button class="btn-qty" onclick="updateMainQty(1)">+</button>
                    </div>
                    <button class="btn btn-orange w-100 py-3" id="btnAddToCart">+ Keranjang</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const menuData = {
        1: { id:1, nama:"Grill Beef Burger", harga:35000, size:{regular:35000,small:30000,large:40000}, kategori:"makanan", desc:"Daging sapi premium, sayuran segar, dan saus spesial.", gambar:"beef.png", toping:[{n:"Double beef",h:10000},{n:"Double cheese",h:5000},{n:"Double egg",h:7000},{n:"Extra Mayo",h:2000},{n:"Extra Sauce",h:3000},{n:"Extra tomato",h:2000},{n:"Extra selada",h:2000}], reduce:[{n:"tomato",h:-2000},{n:"egg",h:-5000},{n:"salada",h:-8000}]},
        2: { id:2, nama:"Crispy Chicken Burger", harga:28000, size:{regular:28000,small:24000,large:32000}, kategori:"makanan", desc:"Ayam krispi gurih dengan bumbu rempah rahasia.", gambar:"chicken.png", toping:[{n:"Double chicken",h:8000},{n:"Double cheese",h:5000},{n:"Double egg",h:7000},{n:"Extra Mayo",h:3000},{n:"Extra Sauce",h:3000},{n:"Extra Tomato",h:2000},{n:"Extra Selada",h:2000}], reduce:[{n:"tomato",h:-2000},{n:"egg",h:-5000},{n:"salada",h:-8000}]},
        3: { id:3, nama:"Shredded Chicken Burger", harga:25000, size:{regular:25000,small:21000,large:30000}, kategori:"makanan", desc:"Abon yang melimpah dengan selada renyah.", gambar:"abon.png", toping:[{n:"Double abon",h:5000},{n:"Double cheese",h:5000},{n:"Double egg",h:7000},{n:"Extra Mayo",h:3000},{n:"Extra Sauce",h:3000},{n:"Extra Tomato",h:2000},{n:"Extra Selada",h:2000}], reduce:[{n:"tomato",h:-2000},{n:"egg",h:-5000},{n:"salada",h:-8000}]},
        4: { id:4, nama:"French Fries", harga:15000, size:{regular:15000,small:12000,large:20000}, kategori:"makanan", desc:"Kentang goreng renyah dengan garam laut.", gambar:"kentang.png", toping:[{n:"Saus Keju",h:4000},{n:"Saus Mayo",h:4000},{n:"Saus spicy",h:4000}], reduce:[]},
        5: { id:5, nama:"Starbuck", harga:25000, kategori:"minuman", desc:"Kopi berkualitas tinggi dengan cita rasa khas.", gambar:"kopi.png", toping:[], reduce:[]},
        6: { id:6, nama:"Coca-Cola", harga:15000, kategori:"minuman", desc:"Minuman soda klasik dengan rasa yang menyegarkan.", gambar:"cola.png", toping:[], reduce:[]},
        7: { id:7, nama:"Sprite", harga:15000, kategori:"minuman", desc:"Minuman lemon-lime yang menyegarkan.", gambar:"sprite.png", toping:[], reduce:[]},
        8: { id:8, nama:"Air Mineral", harga:5000, kategori:"minuman", desc:"Air mineral murni untuk hidrasi optimal.", gambar:"air.png", toping:[], reduce:[]}
    };

    let currentItem = null;
    let currentPrice = 0;
    // *** LOAD CART DARI LOCALSTORAGE (sinkron dengan checkout) ***
    let carts = JSON.parse(localStorage.getItem('cartBurger')) || [];

    // Update tampilan floating cart dari localStorage saat halaman dibuka
    function refreshCartDisplay() {
        let count = 0, total = 0;
        carts.forEach(item => { count += item.qty; total += item.total; });
        if(count > 0) {
            document.getElementById('cartCount').innerText = count + " produk";
            document.getElementById('cartTotalDisplay').innerText = "Rp." + total.toLocaleString();
            document.getElementById('cartTrigger').style.display = "block";
            document.getElementById('headerCartIcon').style.display = "inline-block";
            document.getElementById('headerCartCount').innerText = count;
        } else {
            document.getElementById('cartTrigger').style.display = "none";
            document.getElementById('headerCartIcon').style.display = "none";
        }
    }

    // *** CEK URL PARAM: jika dari checkout tombol "Ganti", buka modal langsung ***
    window.addEventListener('DOMContentLoaded', function() {
        refreshCartDisplay();
        const params = new URLSearchParams(window.location.search);
        const gantiIdx = params.get('ganti'); // index item di cart
        if(gantiIdx !== null) {
            const cartItem = carts[parseInt(gantiIdx)];
            if(cartItem) {
                // Hapus item lama dari cart
                carts.splice(parseInt(gantiIdx), 1);
                localStorage.setItem('cartBurger', JSON.stringify(carts));
                refreshCartDisplay();
                // Cari menu ID berdasarkan nama
                const menuId = Object.keys(menuData).find(k => menuData[k].nama === cartItem.nama);
                if(menuId) {
                    // Highlight card
                    const cardEl = document.getElementById('card-' + menuId);
                    if(cardEl) {
                        cardEl.scrollIntoView({behavior:'smooth', block:'center'});
                        cardEl.querySelector('.product-card').classList.add('highlight-ganti');
                        setTimeout(() => cardEl.querySelector('.product-card').classList.remove('highlight-ganti'), 2000);
                    }
                    // Buka modal setelah sebentar
                    setTimeout(() => openCustomModal(parseInt(menuId)), 500);
                }
                // Bersihkan URL tanpa reload
                history.replaceState(null, '', '/dashboard');
            }
        }
    });

    function goToCheckout() {
        window.location.href = '/checkout';
    }

    function openCustomModal(id) {
        const item = menuData[id];
        if(!item) return;
        currentItem = item;
        currentPrice = item.harga;

        document.getElementById('modalTitle').innerText = item.nama;
        document.getElementById('modalDesc').innerText = item.desc;
        document.getElementById('modalPrice').innerText = "Rp." + item.harga.toLocaleString();
        document.getElementById('modalImg').src = "{{ asset('images/') }}/" + item.gambar;
        document.getElementById('mainQty').innerText = "1";
        document.getElementById('btnAddToCart').innerText = "+ Keranjang Rp." + item.harga.toLocaleString();

        const sectionSize = document.getElementById('sectionSize');
        const sectionSuhu = document.getElementById('sectionSuhu');
        if(item.kategori === "minuman") {
            sectionSize.style.display = "none";
            sectionSuhu.style.display = "block";
        } else {
            sectionSize.style.display = "block";
            sectionSuhu.style.display = "none";
            // Reset size ke regular
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('#sectionSize .size-btn')[0]?.classList.add('active');
            currentPrice = item.size ? item.size['regular'] : item.harga;
        }

        const area = document.getElementById('topingArea');
        area.innerHTML = "";
        if(item.toping && item.toping.length > 0) {
            item.toping.forEach((t, i) => {
                area.innerHTML += `
                    <div class="addon-row">
                        <span class="small">${t.n}</span>
                        <div class="qty-control">
                            <span class="small text-muted">+ Rp.${t.h.toLocaleString()}</span>
                            <button class="btn-qty" onclick="changeQty('top-${i}', -1)">-</button>
                            <span id="top-${i}">0</span>
                            <button class="btn-qty" onclick="changeQty('top-${i}', 1)">+</button>
                        </div>
                    </div>`;
            });
        } else {
            area.innerHTML = "<p class='small text-muted'>Tidak ada toping tambahan.</p>";
        }

        const reduceArea = document.getElementById('reduceArea');
        reduceArea.innerHTML = "";
        if(item.reduce && item.reduce.length > 0) {
            item.reduce.forEach((r, i) => {
                reduceArea.innerHTML += `
                    <div class="addon-row px-3 bg-light rounded-3 mb-2" style="border:none;">
                        <span class="small fw-bold">${r.n}</span>
                        <div class="d-flex align-items-center gap-3">
                            <span class="small text-orange">-Rp.${Math.abs(r.h).toLocaleString()}</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${r.h}" id="reduce-${i}">
                            </div>
                        </div>
                    </div>`;
            });
            setTimeout(() => {
                document.querySelectorAll('#reduceArea input').forEach(el => {
                    el.addEventListener('change', updateTotalPrice);
                });
            }, 100);
        } else {
            reduceArea.innerHTML = "<p class='small text-muted'>Tidak ada pengurangan.</p>";
        }

        new bootstrap.Modal(document.getElementById('customModal')).show();
    }

    function selectSize(btn, size) {
        document.querySelectorAll('#sectionSize .size-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        if(currentItem.size) currentPrice = currentItem.size[size];
        updateTotalPrice();
    }

    function updateTotalPrice() {
        let total = currentPrice;
        let qty = parseInt(document.getElementById('mainQty').innerText);
        total *= qty;
        if(currentItem.toping) {
            currentItem.toping.forEach((t, i) => {
                let q = parseInt(document.getElementById(`top-${i}`)?.innerText || 0);
                total += t.h * q;
            });
        }
        if(currentItem.reduce) {
            currentItem.reduce.forEach((r, i) => {
                let check = document.getElementById(`reduce-${i}`);
                if(check && check.checked) total += r.h;
            });
        }
        document.getElementById('modalPrice').innerText = "Rp." + total.toLocaleString();
        document.getElementById('btnAddToCart').innerText = "+ Keranjang Rp." + total.toLocaleString();
    }

    function changeQty(id, val) {
        let el = document.getElementById(id);
        let n = parseInt(el.innerText) + val;
        if(n >= 0) el.innerText = n;
        updateTotalPrice();
    }

    function updateMainQty(val) {
        let el = document.getElementById('mainQty');
        let n = parseInt(el.innerText) + val;
        if(n >= 1) el.innerText = n;
        updateTotalPrice();
    }

    document.getElementById('btnAddToCart').addEventListener('click', function() {
        let totalText = document.getElementById('modalPrice').innerText;
        let total = parseInt(totalText.replace(/[^\d]/g, ''));
        let qty = parseInt(document.getElementById('mainQty').innerText);

        // Kumpulkan toping yang dipilih (qty > 0)
        let selectedToping = [];
        if(currentItem.toping) {
            currentItem.toping.forEach((t, i) => {
                let q = parseInt(document.getElementById(`top-${i}`)?.innerText || 0);
                if(q > 0) selectedToping.push({ nama: t.n, qty: q, harga: t.h, subtotal: t.h * q });
            });
        }

        // Kumpulkan reduce yang dicentang
        let selectedReduce = [];
        if(currentItem.reduce) {
            currentItem.reduce.forEach((r, i) => {
                let check = document.getElementById(`reduce-${i}`);
                if(check && check.checked) selectedReduce.push({ nama: r.n, harga: r.h });
            });
        }

        // Item baru selalu push sebagai entry terpisah (beda kustomisasi = beda item)
        carts.push({
            menuId: currentItem.id,
            nama: currentItem.nama,
            gambar: currentItem.gambar,
            qty: qty,
            harga: currentPrice,
            total: total,
            toping: selectedToping,
            reduce: selectedReduce
        });

        // *** SIMPAN KE LOCALSTORAGE - otomatis tersinkron ke checkout ***
        localStorage.setItem('cartBurger', JSON.stringify(carts));

        refreshCartDisplay();
        bootstrap.Modal.getInstance(document.getElementById('customModal')).hide();

        // Toast notifikasi
        showToast(currentItem.nama + " ditambahkan ke keranjang!");
    });

    function showToast(msg) {
        let toast = document.createElement('div');
        toast.style.cssText = "position:fixed;bottom:110px;left:50%;transform:translateX(-50%);background:#222;color:#fff;padding:12px 24px;border-radius:20px;z-index:9999;font-size:0.85rem;font-family:'Poppins',sans-serif;box-shadow:0 4px 20px rgba(0,0,0,0.2);animation:fadeInUp 0.3s ease";
        toast.innerText = "🛒 " + msg;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2500);
    }
    const style = document.createElement('style');
    style.innerText = "@keyframes fadeInUp{from{opacity:0;transform:translateX(-50%) translateY(15px);}to{opacity:1;transform:translateX(-50%) translateY(0);}}";
    document.head.appendChild(style);
</script>
</body>
</html>