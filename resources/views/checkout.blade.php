<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - HAMBURGER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fff; }
        .text-orange { color: #e67e22; }
        .checkout-card { border: 1px solid #f1f1f1; border-radius: 25px; padding: 20px; margin-bottom: 15px; transition: 0.2s; }
        .checkout-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
        .product-img { width: 80px; height: 80px; object-fit: contain; }
        .btn-qty { width: 30px; height: 30px; border: none; background: #f5f5f5; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s; }
        .btn-qty:hover { background: #ebebeb; }
        .btn-del { width: 30px; height: 30px; border: none; background: #fff0ee; color: #e74c3c; border-radius: 8px; cursor: pointer; font-size: 12px; }
        .payment-box { position: fixed; bottom: 25px; left: 50%; transform: translateX(-50%); width: 90%; max-width: 700px; background: #fff; border-radius: 20px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); display: flex; justify-content: space-between; align-items: center; z-index: 100; }
        .btn-pay { background: #e67e22; border: none; color: white; padding: 14px 35px; border-radius: 15px; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-pay:hover { background: #d35400; }
        .btn-ganti { border: 1px solid #e67e22; color: #e67e22; background: transparent; padding: 3px 14px; border-radius: 15px; font-size: 11px; text-decoration: none; cursor: pointer; transition: 0.2s; }
        .btn-ganti:hover { background: #fff5ed; }

        /* === MODAL STRUK === */
        .struk-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; justify-content: center; align-items: center; }
        .struk-overlay.show { display: flex; animation: fadeOverlay 0.3s ease; }
        @keyframes fadeOverlay { from{opacity:0} to{opacity:1} }
        .struk-box { background: #fff; border-radius: 28px; padding: 36px 30px 28px; width: 95%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.25); animation: slideUp 0.35s cubic-bezier(.22,1,.36,1); max-height: 90vh; overflow-y: auto; }
        @keyframes slideUp { from{transform:translateY(40px);opacity:0} to{transform:translateY(0);opacity:1} }
        .struk-header { text-align: center; border-bottom: 2px dashed #f0f0f0; padding-bottom: 18px; margin-bottom: 18px; }
        .struk-logo { font-size: 1.6rem; font-weight: 700; }
        .struk-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 7px 0; font-size: 0.87rem; }
        .struk-row .nama { flex: 1; color: #333; }
        .struk-row .harga { font-weight: 600; color: #333; white-space: nowrap; margin-left: 12px; }
        .struk-divider { border: none; border-top: 1.5px dashed #e8e8e8; margin: 12px 0; }
        .struk-total { display: flex; justify-content: space-between; font-size: 1.05rem; font-weight: 700; margin-top: 6px; }
        .struk-total .label { color: #333; }
        .struk-total .amount { color: #e67e22; }
        .struk-footer { text-align: center; margin-top: 20px; }
        .struk-footer p { font-size: 0.78rem; color: #aaa; margin: 0; }
        .struk-footer .order-id { font-size: 0.82rem; color: #888; font-weight: 600; letter-spacing: 1px; margin-bottom: 4px; }
        .btn-struk-close { width: 100%; margin-top: 18px; padding: 13px; border: none; background: #e67e22; color: white; border-radius: 14px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: 0.2s; }
        .btn-struk-close:hover { background: #d35400; }
        .struk-item-qty { color: #888; font-size: 0.78rem; }
        .struk-success-icon { font-size: 3rem; margin-bottom: 8px; }

        /* === MODAL PILIHAN PEMBAYARAN === */
        .payment-method-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9998; justify-content: center; align-items: flex-end; }
        .payment-method-overlay.show { display: flex; animation: fadeOverlay 0.3s ease; }
        .payment-method-box { background: #fff; border-radius: 28px 28px 0 0; padding: 30px 24px 36px; width: 100%; max-width: 700px; box-shadow: 0 -10px 40px rgba(0,0,0,0.15); animation: slideUpSheet 0.35s cubic-bezier(.22,1,.36,1); }
        @keyframes slideUpSheet { from{transform:translateY(100%);opacity:0} to{transform:translateY(0);opacity:1} }
        .payment-method-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 6px; }
        .payment-method-subtitle { font-size: 0.82rem; color: #aaa; margin-bottom: 22px; }
        .payment-option { display: flex; align-items: center; gap: 16px; padding: 14px 18px; border: 2px solid #f0f0f0; border-radius: 18px; margin-bottom: 12px; cursor: pointer; transition: 0.2s; background: #fff; width: 100%; }
        .payment-option:hover { border-color: #e67e22; background: #fff8f2; }
        .payment-option.selected { border-color: #e67e22; background: #fff5ed; }
        .payment-option .pay-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
        .payment-option .pay-info { flex: 1; text-align: left; }
        .payment-option .pay-name { font-weight: 700; font-size: 0.95rem; color: #222; }
        .payment-option .pay-desc { font-size: 0.78rem; color: #aaa; margin-top: 2px; }
        .payment-option .pay-check { width: 22px; height: 22px; border-radius: 50%; border: 2px solid #ddd; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: 0.2s; }
        .payment-option.selected .pay-check { background: #e67e22; border-color: #e67e22; color: white; font-size: 12px; }
        .btn-konfirmasi-bayar { width: 100%; margin-top: 8px; padding: 15px; border: none; background: #e67e22; color: white; border-radius: 16px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.2s; }
        .btn-konfirmasi-bayar:hover { background: #d35400; }
        .btn-konfirmasi-bayar:disabled { background: #ddd; color: #aaa; cursor: not-allowed; }
        .pay-drag-bar { width: 40px; height: 4px; background: #eee; border-radius: 10px; margin: 0 auto 22px; }
    </style>
</head>
<body>

<div class="container py-5" style="padding-bottom: 120px !important;">
    <div class="d-flex align-items-center gap-3 mb-5">
        <a href="/dashboard" class="text-dark"><i class="fa-solid fa-arrow-left fs-5"></i></a>
        <h3 class="fw-bold m-0">Konfirmasi <span class="text-orange">Pesanan</span></h3>
    </div>

    <div id="checkoutList"></div>
</div>

<!-- Payment Bar -->
<div class="payment-box">
    <div>
        <p class="small text-muted mb-0">Total Pembayaran</p>
        <h4 class="fw-bold text-orange mb-0" id="grandTotalText">Rp.0</h4>
    </div>
    <button type="button" class="btn-pay" id="btnBayar" onclick="prosesPayment()">Bayar Sekarang</button>
</div>

<!-- Hidden form untuk server (opsional, dipertahankan untuk backend Laravel) -->
<form id="formBayar" action="/proses-bayar" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="total" id="inputTotal">
    <input type="hidden" name="cart_data" id="inputCartData">
</form>

<!-- ===== MODAL PILIHAN PEMBAYARAN ===== -->
<div class="payment-method-overlay" id="paymentMethodOverlay">
    <div class="payment-method-box">
        <div class="pay-drag-bar"></div>
        <div class="payment-method-title">Pilih Metode Pembayaran</div>
        <div class="payment-method-subtitle">Pilih salah satu metode pembayaran di bawah ini</div>

        <button class="payment-option" id="opt-dana" onclick="pilihMetode('dana')">
            <div class="pay-icon" style="background:#f0f4ff;">
            <img src="/images/dana.png" style="width:36px;height:36px;object-fit:contain;">
        </div>
            <div class="pay-info">
                <div class="pay-name">DANA</div>
                <div class="pay-desc">Bayar lewat dompet digital DANA</div>
            </div>
            <div class="pay-check" id="check-dana"></div>
        </button>

        <button class="payment-option" id="opt-qris" onclick="pilihMetode('qris')">
            <div class="pay-icon" style="background:#fff0f0;">
                <img src="/images/qris.png" style="width:36px;height:36px;object-fit:contain;">
            </div>
            <div class="pay-info">
                <div class="pay-name">QRIS</div>
                <div class="pay-desc">Scan QR dari semua aplikasi e-wallet</div>
            </div>
            <div class="pay-check" id="check-qris"></div>
        </button>

        <button class="payment-option" id="opt-qash" onclick="pilihMetode('qash')">
            <div class="pay-icon" style="background:#f0fff5;">
                <img src="/images/qash.png" style="width:36px;height:36px;object-fit:contain;">
            </div>
            <div class="pay-info">
                <div class="pay-name">QASH</div>
                <div class="pay-desc">Bayar tunai di kasir</div>
            </div>
            <div class="pay-check" id="check-qash"></div>
        </button>

        <button class="btn-konfirmasi-bayar" id="btnKonfirmasiBayar" disabled onclick="konfirmasiBayar()">
            Konfirmasi Pembayaran
        </button>
    </div>
</div>

<!-- ===== MODAL STRUK ===== -->
<div class="struk-overlay" id="strukOverlay">
    <div class="struk-box" id="strukBox">
        <div class="struk-header">
            <div class="struk-success-icon">✅</div>
            <div class="struk-logo">🍔 HAM<span style="color:#e67e22">BURGER</span></div>
            <p style="font-size:0.8rem; color:#aaa; margin:4px 0 0;">Terima kasih atas pesananmu!</p>
            <div class="order-id mt-2" id="strukOrderId" style="font-size:0.8rem;color:#bbb;letter-spacing:1px;"></div>
            <div style="font-size:0.8rem;color:#bbb;" id="strukWaktu"></div>
        </div>

        <!-- Item list akan diisi JS -->
        <div id="strukItems"></div>

        <hr class="struk-divider">

        <div class="struk-row">
            <span class="nama text-muted">Metode Bayar</span>
            <span class="harga" id="strukMetodeBayar"></span>
        </div>
        <div class="struk-row">
            <span class="nama text-muted">Subtotal</span>
            <span class="harga" id="strukSubtotal"></span>
        </div>
        <div class="struk-row">
            <span class="nama text-muted">Pajak (10%)</span>
            <span class="harga" id="strukPajak"></span>
        </div>
        <hr class="struk-divider">
        <div class="struk-total">
            <span class="label">Total Bayar</span>
            <span class="amount" id="strukTotal"></span>
        </div>

        <div class="struk-footer">
            <p class="order-id" id="strukThanks">Pesanan sedang diproses 🔥</p>
            <p>Silahkan tunjukkan struk ini ke kasir</p>
        </div>
        <button class="btn-struk-close" onclick="tutupStruk()">Selesai & Kembali ke Menu</button>
    </div>
</div>

<script>
    // *** BACA CART DARI LOCALSTORAGE (sinkron dengan dashboard) ***
    let cart = JSON.parse(localStorage.getItem('cartBurger')) || [];

    function renderCheckout() {
        const list = document.getElementById('checkoutList');
        let grandTotal = 0; // untuk grantotal keseluruhan
        list.innerHTML = "";

        if(cart.length === 0) {
            list.innerHTML = `
                <div class='text-center mt-5 py-5'>
                    <div style="font-size:4rem">🛒</div>
                    <h5 class="fw-bold mt-3">Keranjang Kosong!</h5>
                    <p class="text-muted">Yuk pilih menu dulu.</p>
                    <a href='/dashboard' class="btn btn-orange px-4 py-2 rounded-pill" style="background:#e67e22;color:white;text-decoration:none;font-weight:600;">Balik ke Menu</a>
                </div>`;
            document.getElementById('btnBayar').disabled = true;
            document.getElementById('btnBayar').style.opacity = '0.5';
            return;
        }

        document.getElementById('btnBayar').disabled = false;
        document.getElementById('btnBayar').style.opacity = '1';

        cart.forEach((item, index) => {
            let totalHargaItem = item.total; // sudah termasuk toping & reduce dari dashboard
            grandTotal += totalHargaItem;
            // Buat label toping
            let topingLabel = '';
            if(item.toping && item.toping.length > 0) {
                topingLabel = item.toping.map(t => `<span class="badge" style="background:#fff5ed;color:#e67e22;font-size:10px;border-radius:8px;padding:2px 7px;margin-right:3px;">+${t.nama} x${t.qty} (+Rp.${(t.harga*t.qty).toLocaleString('id-ID')})</span>`).join('');
            }
            // Buat label reduce
            let reduceLabel = '';
            if(item.reduce && item.reduce.length > 0) {
                reduceLabel = item.reduce.map(r => `<span class="badge" style="background:#f0fff0;color:#27ae60;font-size:10px;border-radius:8px;padding:2px 7px;margin-right:3px;">-${r.nama} (${r.harga.toLocaleString('id-ID')})</span>`).join('');
            }

            list.innerHTML += `
                <div class="checkout-card d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <img src="/images/${item.gambar}" class="product-img" onerror="this.src='/images/placeholder.png'">
                        <div>
                            <h6 class="fw-bold mb-1">${item.nama}</h6>
                            <p class="text-orange fw-bold mb-1">Rp.${totalHargaItem.toLocaleString('id-ID')}</p>
                            <p class="text-muted small mb-1">@ Rp.${item.harga.toLocaleString('id-ID')}</p>
                            ${topingLabel ? `<div class="mb-1">${topingLabel}</div>` : ''}
                            ${reduceLabel ? `<div class="mb-1">${reduceLabel}</div>` : ''}
                            <!-- Tombol GANTI: redirect ke dashboard dengan param index -->
                            <button class="btn-ganti" onclick="gantiItem(${index})">
                                <i class="fa-solid fa-pencil" style="font-size:10px"></i> Ganti
                            </button>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn-qty" onclick="updateQty(${index}, -1)">-</button>
                            <span class="fw-bold">${item.qty}</span>
                            <button class="btn-qty" onclick="updateQty(${index}, 1)">+</button>
                        </div>
                        <button class="btn-del" onclick="hapusItem(${index})" title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>`;
        });

        document.getElementById('grandTotalText').innerText = "Rp." + grandTotal.toLocaleString('id-ID');
        document.getElementById('inputTotal').value = grandTotal;
        document.getElementById('inputCartData').value = JSON.stringify(cart);

        // *** SIMPAN ULANG KE LOCALSTORAGE (sync) ***
        localStorage.setItem('cartBurger', JSON.stringify(cart));
    }

    function updateQty(idx, delta) {
        if(cart[idx].qty + delta > 0) {
            cart[idx].qty += delta;
            // Hitung ulang total: (harga dasar * qty) + semua toping + semua reduce
            let base = cart[idx].harga * cart[idx].qty;
            let topingTotal = 0;
            if(cart[idx].toping) cart[idx].toping.forEach(t => { topingTotal += t.harga * t.qty; });
            let reduceTotal = 0;
            if(cart[idx].reduce) cart[idx].reduce.forEach(r => { reduceTotal += r.harga; });
            cart[idx].total = base + topingTotal + reduceTotal;
        } else {
            hapusItem(idx);
            return;
        }
        renderCheckout();
    }

    function hapusItem(idx) {
        cart.splice(idx, 1);
        localStorage.setItem('cartBurger', JSON.stringify(cart));
        renderCheckout();
    }

    // *** TOMBOL GANTI: hapus item dari cart, redirect ke dashboard dengan param menu ***
    function gantiItem(idx) {
        // Simpan info ganti ke localStorage agar dashboard tahu item mana yang diganti
        localStorage.setItem('cartBurger', JSON.stringify(cart));
        // Redirect ke dashboard dengan query param index item yang akan diganti
        window.location.href = '/dashboard?ganti=' + idx;
    }

    // *** TOMBOL BAYAR → tampilkan PILIHAN PEMBAYARAN dulu ***
    function prosesPayment() {
        if(cart.length === 0) return;
        // Reset pilihan metode
        selectedMetode = null;
        ['dana','qris','qash'].forEach(m => {
            document.getElementById('opt-' + m).classList.remove('selected');
            document.getElementById('check-' + m).innerHTML = '';
        });
        document.getElementById('btnKonfirmasiBayar').disabled = true;
        // Tampilkan modal pilihan pembayaran
        document.getElementById('paymentMethodOverlay').classList.add('show');
    }

    let selectedMetode = null;

    function pilihMetode(metode) {
        selectedMetode = metode;
        ['dana','qris','qash'].forEach(m => {
            document.getElementById('opt-' + m).classList.remove('selected');
            document.getElementById('check-' + m).innerHTML = '';
        });
        document.getElementById('opt-' + metode).classList.add('selected');
        document.getElementById('check-' + metode).innerHTML = '✓';
        document.getElementById('btnKonfirmasiBayar').disabled = false;
    }

    function konfirmasiBayar() {
        if(!selectedMetode) return;
        // Tutup modal pembayaran
        document.getElementById('paymentMethodOverlay').classList.remove('show');
        // Lanjut tampilkan STRUK (logika asli dari prosesPayment)
        tampilkanStruk();
    }

    // *** PROSES BAYAR → tampilkan STRUK ***
    function tampilkanStruk() {
        if(cart.length === 0) return;

        let grandTotal = 0;
        cart.forEach(item => { grandTotal += item.total; }); // pakai item.total yg sudah include toping & reduce
        let pajak = Math.round(grandTotal * 0.10);
        let totalBayar = grandTotal + pajak;

        // Isi items di struk
        let itemsHtml = '';
        cart.forEach(item => {
            // Detail toping & reduce untuk struk
            let extraDetail = '';
            if(item.toping && item.toping.length > 0) {
                item.toping.forEach(t => {
                    extraDetail += `<div class="struk-item-qty" style="color:#e67e22">+ ${t.nama} x${t.qty} &nbsp; Rp.${t.subtotal.toLocaleString('id-ID')}</div>`;
                });
            }
            if(item.reduce && item.reduce.length > 0) {
                item.reduce.forEach(r => {
                    extraDetail += `<div class="struk-item-qty" style="color:#27ae60">- ${r.nama} &nbsp; Rp.${Math.abs(r.harga).toLocaleString('id-ID')}</div>`;
                });
            }
            itemsHtml += `
                <div class="struk-row">
                    <div class="nama">
                        ${item.nama}
                        <div class="struk-item-qty">${item.qty}x @ Rp.${item.harga.toLocaleString('id-ID')}</div>
                        ${extraDetail}
                    </div>
                    <div class="harga">Rp.${item.total.toLocaleString('id-ID')}</div>
                </div>`;
        });
        document.getElementById('strukItems').innerHTML = itemsHtml;

        // Isi total
        document.getElementById('strukSubtotal').innerText = "Rp." + grandTotal.toLocaleString('id-ID');
        document.getElementById('strukPajak').innerText = "Rp." + pajak.toLocaleString('id-ID');
        document.getElementById('strukTotal').innerText = "Rp." + totalBayar.toLocaleString('id-ID');

        // Order ID & waktu
        const now = new Date();
        const orderId = "ORD-" + now.getFullYear().toString().slice(-2) + 
            String(now.getMonth()+1).padStart(2,'0') + 
            String(now.getDate()).padStart(2,'0') + "-" + 
            Math.floor(Math.random()*9000+1000);
        document.getElementById('strukOrderId').innerText = orderId;
        document.getElementById('strukWaktu').innerText = now.toLocaleDateString('id-ID', {weekday:'long',year:'numeric',month:'long',day:'numeric'}) + " · " + now.toLocaleTimeString('id-ID', {hour:'2-digit',minute:'2-digit'});

        // Tampilkan struk
        document.getElementById('strukOverlay').classList.add('show');

        // Tambah info metode pembayaran di struk
        let metodeLabel = {
        dana: '<img src="/images/dana.png" style="height:22px;vertical-align:middle;margin-right:5px;"> DANA',
        qris: '<img src="/images/qris.png" style="height:22px;vertical-align:middle;margin-right:5px;"> QRIS',
        qash: '<img src="/images/qash.png" style="height:22px;vertical-align:middle;margin-right:5px;"> QASH'
     };
        let metodeRow = document.getElementById('strukMetodeBayar');
        if(metodeRow) metodeRow.innerHTML = metodeLabel[selectedMetode] || '-';

        // Submit form ke server (background)
        document.getElementById('inputTotal').value = totalBayar;
        document.getElementById('inputCartData').value = JSON.stringify(cart);
        // Uncomment baris berikut jika ingin kirim ke backend:
        // document.getElementById('formBayar').submit();
    }

    function tutupStruk() {
        // Kosongkan cart setelah bayar
        cart = [];
        localStorage.removeItem('cartBurger');
        document.getElementById('strukOverlay').classList.remove('show');
        // Redirect ke dashboard
        window.location.href = '/dashboard';
    }

    // Render saat halaman load
    renderCheckout();
</script>
</body>
</html>