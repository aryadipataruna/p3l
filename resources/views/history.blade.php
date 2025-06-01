<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi Shopee</title>
    <style>
        /* Gaya Umum */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.5;
        }

        /* Header Utama Shopee */
        .shopee-main-header {
            background-color: #ee4d2d; /* Warna oranye Shopee */
            padding: 12px 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .shopee-main-header .logo-area {
            display: flex;
            align-items: center;
        }
        .shopee-main-header .logo {
            font-size: 28px;
            font-weight: bold;
            margin-right: 20px;
        }
        .shopee-main-header .global-search-bar {
            display: flex;
            flex-grow: 1;
            max-width: 600px; /* Batasi lebar search bar */
        }
        .shopee-main-header .global-search-bar input {
            padding: 10px 15px;
            width: 100%;
            border: none;
            border-radius: 3px 0 0 3px;
            font-size: 14px;
        }
        .shopee-main-header .global-search-bar button {
            padding: 10px 15px;
            border: none;
            background-color: #f0795e; /* Warna tombol search lebih muda */
            color: white;
            cursor: pointer;
            border-radius: 0 3px 3px 0;
        }
        .shopee-main-header .header-nav-icons {
            display: flex;
            align-items: center;
        }
        .shopee-main-header .header-nav-icons span {
            margin-left: 20px;
            font-size: 20px; /* Ukuran ikon */
            cursor: pointer;
        }
        .shopee-main-header .user-profile-short {
            margin-left: 20px;
            font-size: 14px;
        }


        /* Kontainer Utama Aplikasi */
        .app-container {
            display: flex;
            margin: 15px auto; /* Pusatkan kontainer */
            padding: 0 15px;
            max-width: 1200px; /* Lebar maksimum konten */
        }

        /* Sidebar Navigasi Pengguna */
        .user-sidebar {
            width: 220px; /* Lebar sidebar */
            background-color: #fff;
            padding: 20px;
            margin-right: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            height: fit-content; /* Agar tinggi sesuai konten */
        }
        .user-sidebar .user-info-summary {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        .user-sidebar .user-info-summary img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            background-color: #eee; /* Placeholder avatar */
        }
        .user-sidebar .user-info-summary .username {
            font-weight: bold;
            font-size: 16px;
        }
        .user-sidebar .edit-profile-btn {
            font-size: 12px;
            color: #888;
            cursor: pointer;
        }
        .user-sidebar .edit-profile-btn:hover {
            color: #ee4d2d;
        }

        .user-sidebar ul.nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .user-sidebar ul.nav-menu li {
            padding: 12px 0;
            cursor: pointer;
            font-size: 14px;
            color: #333;
            display: flex;
            align-items: center;
        }
        .user-sidebar ul.nav-menu li .nav-icon {
            margin-right: 10px;
            font-size: 18px;
            width: 20px; /* Lebar ikon agar teks sejajar */
            text-align: center;
        }
        .user-sidebar ul.nav-menu li:hover,
        .user-sidebar ul.nav-menu li.active {
            color: #ee4d2d;
            font-weight: 500;
        }

        /* Konten Utama (Riwayat Pembelian atau Detail) */
        .main-content-area {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        /* Gaya untuk Halaman Riwayat Pembelian (Page 1) */
        #pagePurchaseHistory .filter-tabs {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
            overflow-x: auto; /* Agar bisa di-scroll di mobile */
        }
        #pagePurchaseHistory .filter-tabs .tab-button {
            padding: 12px 18px;
            cursor: pointer;
            color: #555;
            font-size: 14px;
            border-bottom: 3px solid transparent;
            white-space: nowrap; /* Agar teks tab tidak wrap */
        }
        #pagePurchaseHistory .filter-tabs .tab-button.active,
        #pagePurchaseHistory .filter-tabs .tab-button:hover {
            border-bottom-color: #ee4d2d;
            color: #ee4d2d;
            font-weight: 500;
        }

        #pagePurchaseHistory .order-search-bar input {
            width: calc(100% - 24px); /* Input penuh dikurangi padding */
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 14px;
        }

        .order-card {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #fff; /* Pastikan background putih */
        }
        .order-card .seller-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        .order-card .seller-header .seller-name-section {
            display: flex;
            align-items: center;
        }
        .order-card .seller-header .mall-tag {
            background-color: #ee4d2d;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 2px;
            margin-right: 8px;
            font-weight: bold;
        }
        .order-card .seller-header .seller-name {
            font-weight: bold;
            font-size: 14px;
        }
        .order-card .seller-header .chat-btn,
        .order-card .seller-header .visit-store-btn {
            font-size: 12px;
            color: #555;
            margin-left: 10px;
            cursor: pointer;
            text-decoration: none;
        }
        .order-card .seller-header .chat-btn:hover,
        .order-card .seller-header .visit-store-btn:hover {
            color: #ee4d2d;
        }
        .order-card .order-status-tag {
            font-size: 12px;
            color: #28a745; /* Hijau untuk selesai */
            font-weight: 500;
        }

        .order-item-summary {
            display: flex;
            padding: 15px;
            cursor: pointer; /* Agar bisa diklik untuk detail */
            border-bottom: 1px solid #f0f0f0;
        }
        .order-item-summary:last-child {
            border-bottom: none;
        }
        .order-item-summary img.product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 15px;
            border: 1px solid #eee;
            border-radius: 3px;
        }
        .order-item-summary .product-info {
            flex-grow: 1;
        }
        .order-item-summary .product-name {
            font-weight: 500;
            font-size: 15px;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .order-item-summary .product-variation {
            font-size: 12px;
            color: #777;
            margin-bottom: 2px;
        }
        .order-item-summary .product-quantity {
            font-size: 12px;
            color: #777;
        }
        .order-item-summary .product-pricing {
            text-align: right;
            min-width: 100px; /* Agar harga tidak wrap aneh */
        }
        .order-item-summary .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 12px;
        }
        .order-item-summary .discounted-price {
            color: #ee4d2d;
            font-weight: bold;
            font-size: 15px;
        }

        .order-card-footer {
            padding: 15px;
            background-color: #f9f9f9; /* Footer sedikit beda warna */
            border-top: 1px solid #f0f0f0;
        }
        .order-card-footer .order-total-amount {
            text-align: right;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .order-card-footer .order-total-amount strong {
            font-size: 16px;
            color: #ee4d2d;
        }
        .order-card-footer .order-promo-info {
            font-size: 12px;
            color: #555;
            text-align: right;
            margin-bottom: 15px;
        }
        .order-card-footer .action-buttons {
            text-align: right;
        }
        .order-card-footer .action-buttons .btn {
            padding: 8px 15px;
            margin-left: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            cursor: pointer;
            background-color: white;
            font-size: 13px;
            color: #333;
        }
        .order-card-footer .action-buttons .btn.primary {
            background-color: #ee4d2d;
            color: white;
            border-color: #ee4d2d;
        }
        .order-card-footer .action-buttons .btn:hover {
            opacity: 0.9;
        }


        /* Gaya untuk Halaman Detail Pemesanan (Page 2) */
        #pageOrderDetail .detail-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }
        #pageOrderDetail .back-to-history-btn {
            color: #ee4d2d;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
        }
        #pageOrderDetail .order-id-status .order-number {
            font-size: 13px;
            color: #555;
            margin-right: 10px;
        }
        #pageOrderDetail .order-id-status .current-status {
            font-size: 13px;
            color: #28a745;
            font-weight: 500;
            text-transform: uppercase;
        }

        .order-status-timeline {
            display: flex;
            justify-content: space-around; /* Distribusi merata */
            align-items: flex-start;
            margin-bottom: 25px;
            padding: 20px 10px; /* Padding di dalam box timeline */
            background-color: #fdf6f5; /* Latar belakang lembut untuk timeline */
            border-radius: 5px;
        }
        .order-status-timeline .timeline-step {
            text-align: center;
            flex: 1; /* Agar setiap step mengambil ruang yang sama */
            position: relative;
        }
        .order-status-timeline .timeline-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e0e0e0; /* Abu-abu untuk belum selesai */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 8px auto;
            font-size: 16px;
            border: 3px solid #fdf6f5; /* Untuk efek "gap" dengan connector */
            box-shadow: 0 0 0 2px #e0e0e0; /* Lingkaran luar */
        }
        .order-status-timeline .timeline-step.completed .timeline-icon {
            background-color: #28a745; /* Hijau untuk selesai */
            box-shadow: 0 0 0 2px #28a745;
        }
        .order-status-timeline .timeline-label {
            font-size: 12px;
            color: #555;
        }
        .order-status-timeline .timeline-date {
            font-size: 11px;
            color: #888;
        }
        /* Garis Penghubung (disederhanakan) */
        .order-status-timeline .timeline-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 16px; /* Sejajarkan dengan tengah ikon */
            left: calc(50% + 20px); /* Mulai setelah ikon */
            width: calc(100% - 40px); /* Lebar hingga sebelum ikon berikutnya */
            height: 2px;
            background-color: #e0e0e0;
            z-index: -1; /* Di belakang ikon */
        }
        .order-status-timeline .timeline-step.completed:not(:last-child)::after {
             background-color: #28a745;
        }


        .order-detail-actions {
            text-align: right;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e0e0e0;
        }
        .order-detail-actions .btn {
             padding: 10px 18px; margin-left: 10px; border-radius: 3px; cursor: pointer; font-size: 14px;
        }
        .order-detail-actions .btn-rate { background-color: #ee4d2d; color: white; border: none; }
        .order-detail-actions .btn-secondary { background-color: white; color: #555; border: 1px solid #ccc; }


        .order-info-section {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        .order-info-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .order-info-section .section-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 12px;
            color: #333;
        }
        .order-info-section p, .order-info-section .info-line {
            font-size: 14px;
            margin: 4px 0;
            color: #555;
        }
        .order-info-section .info-line strong {
            color: #333;
        }
        .order-info-section .view-invoice-btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }
        .order-info-section .view-invoice-btn:hover {
            background-color: #0056b3;
        }

        /* Rincian Produk di Halaman Detail */
        .detailed-product-item { /* Mirip .order-item-summary tapi mungkin sedikit beda */
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #f5f5f5;
        }
        .detailed-product-item:last-child { border-bottom: none; }
        .detailed-product-item img.product-image { width: 60px; height: 60px; margin-right: 12px; border-radius: 3px; }
        .detailed-product-item .product-info { flex-grow: 1; }
        .detailed-product-item .product-name { font-weight: 500; font-size: 14px; }
        .detailed-product-item .product-variation, .detailed-product-item .product-quantity { font-size: 12px; color: #777; }
        .detailed-product-item .product-price-calc { text-align: right; font-size: 14px; color: #333; }


        /* Rincian Pembayaran */
        .payment-details-summary .summary-line {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }
        .payment-details-summary .summary-line.grand-total {
            font-weight: bold;
            font-size: 16px;
            color: #ee4d2d;
            margin-top:10px;
            padding-top:10px;
            border-top:1px solid #e0e0e0;
        }
        .payment-details-summary .payment-method-info {
            margin-top: 10px;
            font-size: 13px;
            color: #555;
        }

        /* Floating Chat Button */
        .floating-chat-button {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background-color: #00ac47; /* Warna chat hijau */
            color: white;
            padding: 12px 18px;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-size: 15px;
            display: flex;
            align-items: center;
        }
        .floating-chat-button .chat-icon { margin-right: 8px; font-size: 18px; }

        /* Modal Sederhana */
        .modal-overlay {
            display: none; /* Sembunyikan secara default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }
        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .modal-content h3 { margin-top: 0; color: #333; }
        .modal-content p { margin-bottom: 20px; color: #555; font-size: 14px; }
        .modal-content .modal-close-btn {
            padding: 10px 20px;
            background-color: #ee4d2d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .modal-content .modal-close-btn:hover { opacity: 0.9; }

    </style>
</head>
<body>

    <header class="shopee-main-header">
        <div class="logo-area">
            <div class="logo">Shopee</div>
        </div>
        <div class="global-search-bar">
            <input type="text" placeholder="Fashion & Beauty Ekstra Diskon s/d 20%">
            <button>🔍</button>
        </div>
        <div class="header-nav-icons">
            <span>🛒</span> <span>🔔</span> <span class="user-profile-short">danieldwia999</span>
        </div>
    </header>

    <div class="app-container">
        <aside class="user-sidebar">
            <div class="user-info-summary">
                <img src="https://via.placeholder.com/50/E0E0E0/808080?text=D" alt="Avatar Pengguna"> <div>
                    <div class="username">danieldwia999</div>
                    <div class="edit-profile-btn">✏️ Ubah Profil</div>
                </div>
            </div>
            <ul class="nav-menu">
                <li><span class="nav-icon">👤</span> Akun Saya</li>
                <li class="active" id="navPesananSaya"><span class="nav-icon">🛍️</span> Pesanan Saya</li>
                <li><span class="nav-icon">🔔</span> Notifikasi</li>
                <li><span class="nav-icon">🎟️</span> Voucher Saya</li>
                <li><span class="nav-icon">💰</span> Koin Shopee Saya</li>
            </ul>
        </aside>

        <main class="main-content-area">
            <div id="pagePurchaseHistory">
                <div class="filter-tabs">
                    <button class="tab-button active">Semua</button>
                    <button class="tab-button">Belum Bayar</button>
                    <button class="tab-button">Sedang Dikemas</button>
                    <button class="tab-button">Dikirim</button>
                    <button class="tab-button">Selesai</button>
                    <button class="tab-button">Dibatalkan</button>
                </div>
                <div class="order-search-bar">
                    <input type="text" placeholder="Kamu bisa cari berdasarkan Nama Penjual, No. Pesanan atau Nama Produk">
                </div>

                <div class="order-card">
                    <div class="seller-header">
                        <div class="seller-name-section">
                            <span class="mall-tag">Mall</span>
                            <span class="seller-name">TechHub_id</span>
                            <a href="#" class="chat-btn">💬 Chat</a>
                            <a href="#" class="visit-store-btn">Kunjungi Toko</a>
                        </div>
                        <span class="order-status-tag">SELESAI</span>
                    </div>
                    <div class="order-item-summary" onclick="showOrderDetail('2502279JFKXX6P', 'TechHub_id', 'Fantech XD3 V3 Mouse', 'Rp529.000', 'Rp483.080', 'https://via.placeholder.com/80/EEEEEE/808080?text=Mouse')">
                        <img src="https://via.placeholder.com/80/EEEEEE/808080?text=Mouse" alt="Produk Mouse" class="product-image">
                        <div class="product-info">
                            <span class="product-name">Fantech XD3 V3 8K 4K Helios II PRO S Wireless Mouse Gaming 3in1 Connection</span>
                            <span class="product-variation">Variasi: XD3 V3 Putih 1K</span>
                            <span class="product-quantity">x1</span>
                        </div>
                        <div class="product-pricing">
                            <div class="original-price">Rp999.000</div>
                            <div class="discounted-price">Rp529.000</div>
                        </div>
                    </div>
                    <div class="order-card-footer">
                        <div class="order-promo-info">Nilai sekarang & dapatkan 25 Koin Shopee!</div>
                        <div class="order-total-amount">Total Pesanan: <strong>Rp483.080</strong></div>
                        <div class="action-buttons">
                            <button class="btn">Nilai</button>
                            <button class="btn">Hubungi Penjual</button>
                            <button class="btn primary">Beli Lagi</button>
                        </div>
                    </div>
                </div>

                <div class="order-card">
                    <div class="seller-header">
                        <div class="seller-name-section">
                            <span class="mall-tag" style="background-color: #d0011b;">OR</span> <span class="seller-name">Remington Indonesia Official</span>
                             <a href="#" class="chat-btn">💬 Chat</a>
                            <a href="#" class="visit-store-btn">Kunjungi Toko</a>
                        </div>
                        <span class="order-status-tag">SELESAI</span>
                    </div>
                    <div class="order-item-summary" onclick="showOrderDetail('2502279JFKXX7Q', 'Remington ID', 'Paket Remington Catokan', 'Rp1.083.600', 'Rp1.083.600', 'https://via.placeholder.com/80/EEEEEE/808080?text=Catokan')">
                        <img src="https://via.placeholder.com/80/EEEEEE/808080?text=Catokan" alt="Produk Catokan" class="product-image">
                        <div class="product-info">
                            <span class="product-name">Paket Remington Catokan S5408 + Hairdryer D2400</span>
                            <span class="product-quantity">x1</span>
                        </div>
                        <div class="product-pricing">
                            <div class="original-price">Rp1.548.000</div>
                            <div class="discounted-price">Rp1.083.600</div>
                        </div>
                    </div>
                     <div class="order-card-footer">
                        <div class="order-total-amount">Total Pesanan: <strong>Rp1.083.600</strong></div>
                        <div class="action-buttons">
                            <button class="btn">Nilai</button>
                            <button class="btn">Hubungi Penjual</button>
                            <button class="btn primary">Beli Lagi</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="pageOrderDetail" style="display:none;">
                <div class="detail-page-header">
                    <a href="#" class="back-to-history-btn" onclick="showPurchaseHistory()">&lt; KEMBALI</a>
                    <div class="order-id-status">
                        <span class="order-number" id="detailOrderNumber">NO. PESANAN. 2502279JFKXX6P</span>
                        <span class="current-status">PESANAN SELESAI</span>
                    </div>
                </div>

                <div class="order-status-timeline">
                    <div class="timeline-step completed">
                        <div class="timeline-icon">✓</div>
                        <div class="timeline-label">Pesanan Dibuat</div>
                        <div class="timeline-date">27-02-2025 11:18</div>
                    </div>
                    <div class="timeline-step completed">
                        <div class="timeline-icon">✓</div>
                        <div class="timeline-label">Pesanan Dibayarkan</div>
                        <div class="timeline-date">27-02-2025 11:19</div>
                    </div>
                    <div class="timeline-step completed">
                        <div class="timeline-icon">✓</div>
                        <div class="timeline-label">Pesanan Dikirimkan</div>
                        <div class="timeline-date">27-02-2025 17:03</div>
                    </div>
                    <div class="timeline-step completed">
                        <div class="timeline-icon">✓</div>
                        <div class="timeline-label">Pesanan Selesai</div>
                        <div class="timeline-date">03-03-2025 08:18</div>
                    </div>
                    <div class="timeline-step"> <div class="timeline-icon">★</div>
                        <div class="timeline-label">Belum Dinilai</div>
                    </div>
                </div>
                <div style="font-size:13px; color:#555; margin-bottom:20px; text-align: center;">
                    Nilai pesanan sebelum 01-07-2025 dan dapatkan maks. <span id="detailKoin">25</span> Koin Shopee!
                </div>

                <div class="order-detail-actions">
                    <button class="btn btn-rate">Nilai</button>
                    <button class="btn btn-secondary">Hubungi Penjual</button>
                    <button class="btn btn-secondary">Beli Lagi</button>
                </div>

                <div class="order-info-section">
                    <span class="section-title">Faktur</span>
                    <button class="view-invoice-btn" onclick="openInvoiceModal()">Lihat Tagihan</button>
                    <div style="height: 3px; background: linear-gradient(to right, #ffc0cb 50%, #add8e6 50%); margin-top:15px; border-radius:2px;"></div>
                </div>

                <div class="order-info-section">
                    <h5 class="section-title">Alamat Pengiriman</h5>
                    <p><strong>Daniel Dwie</strong></p>
                    <p>(+62) 812-3456-7890</p>
                    <p>Jl. Jenderal Sudirman Kav. 25, Apartemen Shopee Tower Lt. 10 Unit A, Karet, Setiabudi, Jakarta Selatan, DKI Jakarta, 12920</p>
                </div>

                <div class="order-info-section">
                    <h5 class="section-title">Informasi Pengiriman</h5>
                    <p class="info-line"><strong>JNE REGULAR</strong> - No. Resi: SPX000123456789</p>
                    <p class="info-line"><em>Pesanan telah diterima oleh Yang bersangkutan.</em></p>
                </div>

                <div class="order-info-section">
                    <h5 class="section-title">Produk Dipesan</h5>
                    <div class="detailed-product-item">
                        <img src="https://via.placeholder.com/60/EEEEEE/808080?text=Item" alt="Produk" class="product-image" id="detailProductImage">
                        <div class="product-info">
                            <span class="product-name" id="detailProductName">Nama Produk Detail</span>
                            <span class="product-variation" id="detailProductVariation">Variasi: Detail</span>
                            <span class="product-quantity">x1</span>
                        </div>
                        <div class="product-price-calc" id="detailProductPriceCalc">Rp0</div>
                    </div>
                </div>

                <div class="order-info-section">
                    <h5 class="section-title">Rincian Pembayaran</h5>
                    <div class="payment-details-summary">
                        <div class="summary-line">
                            <span>Subtotal untuk Produk</span>
                            <span id="detailSubtotalProduk">Rp0</span>
                        </div>
                        <div class="summary-line">
                            <span>Ongkos Kirim</span>
                            <span>Rp0</span> </div>
                        <div class="summary-line">
                            <span>Potongan (mis. Koin)</span>
                            <span id="detailPotongan">-Rp0</span>
                        </div>
                        <div class="summary-line grand-total">
                            <span>Total Pesanan</span>
                            <span id="detailTotalPesanan">Rp0</span>
                        </div>
                        <p class="payment-method-info">Metode Pembayaran: ShopeePay</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="floating-chat-button">
        <span class="chat-icon">💬</span> Chat
    </div>

    <div id="invoiceModal" class="modal-overlay">
        <div class="modal-content">
            <h3>Tagihan Pesanan</h3>
            <p>Fitur unduh tagihan dalam format PDF biasanya memerlukan proses di sisi server. Ini adalah placeholder.</p>
            <p>Dalam aplikasi nyata, mengklik ini akan mengunduh file PDF faktur Anda.</p>
            <button class="modal-close-btn" onclick="closeInvoiceModal()">Tutup</button>
        </div>
    </div>

    <script>
        const pagePurchaseHistory = document.getElementById('pagePurchaseHistory');
        const pageOrderDetail = document.getElementById('pageOrderDetail');
        const invoiceModal = document.getElementById('invoiceModal');

        // Elemen di halaman detail untuk diisi data
        const detailOrderNumber = document.getElementById('detailOrderNumber');
        const detailProductName = document.getElementById('detailProductName');
        const detailProductVariation = document.getElementById('detailProductVariation'); // Anda mungkin perlu menambahkan ini jika ada variasi
        const detailProductImage = document.getElementById('detailProductImage');
        const detailProductPriceCalc = document.getElementById('detailProductPriceCalc');
        const detailSubtotalProduk = document.getElementById('detailSubtotalProduk');
        const detailPotongan = document.getElementById('detailPotongan');
        const detailTotalPesanan = document.getElementById('detailTotalPesanan');
        const detailKoin = document.getElementById('detailKoin');


        function showPurchaseHistory() {
            pagePurchaseHistory.style.display = 'block';
            pageOrderDetail.style.display = 'none';
            // Menandai menu sidebar aktif
            document.getElementById('navPesananSaya').classList.add('active');
        }

        function showOrderDetail(orderId, sellerName, productName, productPrice, totalOrder, productImage) {
            // Isi data ke halaman detail (contoh sederhana)
            detailOrderNumber.textContent = `NO. PESANAN. ${orderId}`;
            detailProductName.textContent = productName;
            detailProductImage.src = productImage;
            detailProductPriceCalc.textContent = productPrice; // Harga satuan produk
            detailSubtotalProduk.textContent = productPrice; // Asumsi 1 produk, subtotal sama dengan harga produk

            // Kalkulasi sederhana untuk potongan, bisa lebih kompleks
            const priceNum = parseFloat(productPrice.replace(/[^0-9.-]+/g,""));
            const totalNum = parseFloat(totalOrder.replace(/[^0-9.-]+/g,""));
            const potonganNum = priceNum - totalNum;
            detailPotongan.textContent = `-Rp${potonganNum.toLocaleString('id-ID')}`;
            detailTotalPesanan.textContent = totalOrder;
            detailKoin.textContent = (productName.toLowerCase().includes("mouse")) ? "25" : "50"; // Koin berdasarkan nama produk (contoh)

            // Tampilkan halaman detail
            pagePurchaseHistory.style.display = 'none';
            pageOrderDetail.style.display = 'block';
        }

        function openInvoiceModal() {
            invoiceModal.style.display = 'flex';
        }

        function closeInvoiceModal() {
            invoiceModal.style.display = 'none';
        }

        // Event listener untuk menutup modal jika user klik di luar area konten modal
        invoiceModal.addEventListener('click', function(event) {
            if (event.target === invoiceModal) {
                closeInvoiceModal();
            }
        });

        // Inisialisasi: tampilkan halaman riwayat pembelian saat pertama kali load
        document.addEventListener('DOMContentLoaded', showPurchaseHistory);
    </script>

</body>
</html>
