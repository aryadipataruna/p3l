<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f0f0;
            color: #333;
        }
        .shopee-header {
            background-color: #ee4d2d;
            padding: 10px 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .shopee-header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .shopee-header .search-bar input {
            padding: 8px;
            width: 300px;
            border: none;
            border-radius: 3px;
        }
        .shopee-header .nav-icons span {
            margin-left: 15px;
            cursor: pointer;
        }
        .container {
            display: flex;
            margin-top: 10px;
        }
        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 15px;
            margin-right: 10px;
            min-height: calc(100vh - 70px); /* Adjust based on header height */
        }
        .sidebar h4 {
            margin-top: 0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 10px 0;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }
        .sidebar ul li.active {
            color: #ee4d2d;
            font-weight: bold;
        }
        .main-content {
            flex-grow: 1;
            background-color: #fff;
            padding: 15px;
        }
        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .tabs .tab-item {
            padding: 10px 15px;
            cursor: pointer;
            color: #555;
        }
        .tabs .tab-item.active {
            border-bottom: 2px solid #ee4d2d;
            color: #ee4d2d;
            font-weight: bold;
        }
        .order-search input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .order-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 15px;
        }
        .order-card .seller-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        .seller-info .seller-name {
            font-weight: bold;
        }
        .seller-info .seller-name .mall-tag {
            background-color: #ee4d2d;
            color: white;
            font-size: 0.7em;
            padding: 2px 5px;
            border-radius: 2px;
            margin-right: 5px;
        }
        .seller-info .visit-store {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9em;
        }
        .order-card .order-status {
            font-size: 0.9em;
            color: green;
        }
        .order-item {
            display: flex;
            margin-bottom: 10px;
            padding-bottom:10px;
            border-bottom: 1px dashed #eee;
        }
        .order-item:last-child{
            border-bottom: none;
            margin-bottom:0;
            padding-bottom:0;
        }
        .order-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 15px;
            border: 1px solid #eee;
        }
        .order-item .item-details {
            flex-grow: 1;
        }
        .order-item .item-details .item-name {
            font-weight: bold;
            display: block; /* Ensure it takes full width before price */
        }
        .order-item .item-details .item-variation {
            font-size: 0.9em;
            color: #777;
        }
        .order-item .item-price {
            text-align: right;
        }
        .order-item .item-price .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9em;
        }
        .order-item .item-price .discounted-price {
            color: #ee4d2d;
            font-weight: bold;
        }
        .order-total {
            text-align: right;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 1.1em;
        }
        .order-total strong {
            color: #ee4d2d;
        }
        .order-actions button {
            padding: 8px 12px;
            margin-left: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            cursor: pointer;
            background-color: #f8f8f8;
        }
        .order-actions button.primary {
            background-color: #ee4d2d;
            color: white;
            border-color: #ee4d2d;
        }
        .order-actions {
            text-align: right; /* Align buttons to the right */
        }

        .floating-chat {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: green;
            color: white;
            padding: 10px 15px;
            border-radius: 25px;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <header class="shopee-header">
        <div class="logo">Shopee</div>
        <div class="search-bar">
            <input type="text" placeholder="CEK: Fashion & Beauty Ekstra Diskon s/d 20%...">
            <button>🔍</button>
        </div>
        <div class="nav-icons">
            <span>🛒</span>
            </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <h4>danielwdie999</h4>
            <button style="width:100%; margin-bottom:10px;">✏️ Ubah Profil</button>
            <ul>
                <li>🛍️ Akun Saya</li>
                <li class="active">📖 Pesanan Saya</li>
                <li>🔔 Notifikasi</li>
                <li>🎟️ Voucher Saya</li>
                <li>💰 Koin Shopee Saya</li>
            </ul>
        </aside>
        <main class="main-content">
            <div class="tabs">
                <div class="tab-item active">Semua</div>
                <div class="tab-item">Belum Bayar</div>
                <div class="tab-item">Sedang Dikemas</div>
                <div class="tab-item">Dikirim</div>
                <div class="tab-item">Selesai</div>
                <div class="tab-item">Dibatalkan</div>
                </div>
            <div class="order-search">
                <input type="text" placeholder="Kamu bisa cari berdasarkan Nama Penjual, No. Pesanan atau Nama Produk">
            </div>

            <div class="order-card">
                <div class="seller-info">
                    <div>
                        <span class="seller-name"><span class="mall-tag">Mall</span> TechHub_id</span>
                        <button style="padding: 3px 6px; font-size:0.8em; margin-left:5px;">💬 Chat</button>
                        <a href="#" class="visit-store" style="margin-left:5px;">Kunjungi Toko</a>
                    </div>
                    <span class="order-status">SELESAI</span>
                </div>
                <div class="order-item" onclick="goToOrderDetail()"> <img src="https://via.placeholder.com/80x80.png?text=Mouse" alt="Produk Mouse">
                    <div class="item-details">
                        <span class="item-name">Fantech XD3 V3 8K 4K Helios II PRO S Wireless Mouse Gaming 3in1 Connection</span>
                        <span class="item-variation">Variasi: XD3 V3 Putih 1K</span>
                        <span>x1</span>
                    </div>
                    <div class="item-price">
                        <div class="original-price">Rp999.000</div>
                        <div class="discounted-price">Rp529.000</div>
                    </div>
                </div>
                <div class="order-total">
                    Total Pesanan: <strong>Rp483.080</strong>
                </div>
                 <div style="font-size:0.8em; color:#666; margin-bottom:10px;">
                    Nilai produk sebelum 01-07-2025<br>
                    Nilai sekarang & dapatkan 25 Koin Shopee!
                </div>
                <div class="order-actions">
                    <button>Nilai</button>
                    <button>Hubungi Penjual</button>
                    <button class="primary">Beli Lagi</button>
                </div>
            </div>

            <div class="order-card">
                <div class="seller-info">
                     <div>
                        <span class="seller-name"><span class="mall-tag" style="background-color: #d0011b;">OR</span> Remington Indonesia Official ...</span>
                        <button style="padding: 3px 6px; font-size:0.8em; margin-left:5px;">💬 Chat</button>
                        <a href="#" class="visit-store" style="margin-left:5px;">Kunjungi Toko</a>
                    </div>
                    <span class="order-status">SELESAI</span>
                </div>
                <div class="order-item" onclick="goToOrderDetail()"> <img src="https://via.placeholder.com/80x80.png?text=Catokan" alt="Produk Catokan">
                    <div class="item-details">
                        <span class="item-name">Paket Remington Catokan S5408 + Hairdryer D2400</span>
                        <span>x1</span>
                    </div>
                     <div class="item-price">
                        <div class="original-price">Rp1.548.000</div>
                        <div class="discounted-price">Rp1.083.600</div>
                    </div>
                </div>
                <div class="order-total">
                    Total Pesanan: <strong>Rp1.083.600</strong>
                </div>
                <div class="order-actions">
                    <button>Nilai</button>
                    <button>Hubungi Penjual</button>
                    <button class="primary">Beli Lagi</button>
                </div>
            </div>

        </main>
    </div>

    <div class="floating-chat">💬 Chat</div>

    <script>
        function goToOrderDetail() {
            // Placeholder untuk navigasi. Di aplikasi nyata, ini akan mengarahkan ke URL detail pesanan.
            alert('Navigasi ke halaman detail pesanan...');
            // window.location.href = 'detail_pesanan.html'; // Contoh jika ada file terpisah
        }
    </script>
</body>
</html>
