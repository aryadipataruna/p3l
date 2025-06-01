<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f0f0f0; color: #333; }
        .shopee-header { background-color: #ee4d2d; padding: 10px 20px; color: white; display: flex; align-items: center; justify-content: space-between; }
        .shopee-header .logo { font-size: 24px; font-weight: bold; }
        .container { display: flex; margin-top: 10px; }
        .sidebar { width: 200px; background-color: #fff; padding: 15px; margin-right: 10px; min-height: calc(100vh - 70px); }
        .sidebar h4 { margin-top: 0; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { padding: 10px 0; cursor: pointer; border-bottom: 1px solid #eee; }
        .sidebar ul li.active { color: #ee4d2d; font-weight: bold; }
        .main-content { flex-grow: 1; background-color: #fff; padding: 15px; }

        .order-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .order-detail-header .back-button {
            color: #ee4d2d;
            text-decoration: none;
            font-weight: bold;
        }
        .order-detail-header .order-id {
            font-size: 0.9em;
            color: #555;
        }
        .order-detail-header .order-status-main {
            color: green;
            font-weight: bold;
        }

        .status-timeline {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Align items to the top for text below */
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .status-timeline .status-step {
            text-align: center;
            flex: 1;
            position: relative;
        }
        .status-timeline .status-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ccc;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 5px auto;
            font-size: 1.2em;
            border: 3px solid white; /* For the gap effect */
            box-shadow: 0 0 0 2px #ccc; /* Outer ring */

        }
        .status-timeline .status-step.completed .status-icon {
            background-color: #28a745; /* Green */
            box-shadow: 0 0 0 2px #28a745;
        }
        .status-timeline .status-text {
            font-size: 0.8em;
            color: #555;
        }
        .status-timeline .status-time {
            font-size: 0.7em;
            color: #888;
        }
        /* Connector lines (simplified) */
        .status-timeline .status-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px; /* Adjust to center with icon */
            left: 50%;
            width: 100%;
            height: 2px;
            background-color: #ccc;
            z-index: -1; /* Behind icons */
        }
        .status-timeline .status-step.completed:not(:last-child)::after {
             background-color: #28a745;
        }


        .action-buttons-section {
            text-align: right;
            margin-bottom: 20px;
        }
        .action-buttons-section button {
            padding: 10px 15px;
            margin-left: 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .action-buttons-section .btn-rate {
            background-color: #ee4d2d;
            color: white;
            border: none;
        }
        .action-buttons-section .btn-secondary {
            background-color: white;
            color: #555;
            border: 1px solid #ccc;
        }

        .detail-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 3px;
        }
        .detail-section h5 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #ee4d2d;
        }
        .detail-section p {
            font-size: 0.9em;
            margin: 5px 0;
            color: #444;
        }
        .detail-section .invoice-link {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 0.9em;
        }
         .order-item { /* Copied from Page 1 for consistency */
            display: flex;
            margin-bottom: 10px;
        }
        .order-item img {
            width: 60px; /* Smaller in detail view maybe */
            height: 60px;
            object-fit: cover;
            margin-right: 15px;
            border: 1px solid #eee;
        }
        .order-item .item-details { flex-grow: 1; }
        .order-item .item-details .item-name { font-weight: bold; }
        .order-item .item-details .item-variation { font-size: 0.9em; color: #777; }
        .order-item .item-price { text-align: right; color: #333; }

        .payment-summary-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.9em;
            margin-bottom: 5px;
        }
        .payment-summary-item.total {
            font-weight: bold;
            font-size: 1em;
            color: #ee4d2d;
            margin-top:10px;
            padding-top:10px;
            border-top:1px solid #eee;
        }

        .floating-chat { /* Copied */
            position: fixed; bottom: 20px; right: 20px; background-color: green; color: white;
            padding: 10px 15px; border-radius: 25px; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <header class="shopee-header">
        <div class="logo">Shopee</div>
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
            <div class="order-detail-header">
                <a href="#" class="back-button">&lt; KEMBALI</a>
                <span class="order-id">NO. PESANAN. 2502279JFKXX6P</span>
                <span class="order-status-main">PESANAN SELESAI</span>
            </div>

            <div class="status-timeline">
                <div class="status-step completed">
                    <div class="status-icon">✓</div>
                    <div class="status-text">Pesanan Dibuat</div>
                    <div class="status-time">27-02-2025 11:18</div>
                </div>
                <div class="status-step completed">
                    <div class="status-icon">✓</div>
                    <div class="status-text">Pesanan Dibayarkan<br>(Rp483.080)</div>
                    <div class="status-time">27-02-2025 11:19</div>
                </div>
                <div class="status-step completed">
                    <div class="status-icon">✓</div>
                    <div class="status-text">Pesanan Dikirimkan</div>
                    <div class="status-time">27-02-2025 17:03</div>
                </div>
                <div class="status-step completed">
                    <div class="status-icon">✓</div>
                    <div class="status-text">Pesanan Selesai</div>
                    <div class="status-time">03-03-2025 08:18</div>
                </div>
                <div class="status-step"> <div class="status-icon">★</div>
                    <div class="status-text">Belum Dinilai</div>
                </div>
            </div>
             <div style="font-size:0.8em; color:#666; margin-bottom:20px; text-align: center;">
                Nilai pesanan sebelum 01-07-2025 dan dapatkan maks. 25 Koin Shopee!
            </div>

            <div class="action-buttons-section">
                <button class="btn-rate">Nilai</button>
                <button class="btn-secondary">Hubungi Penjual</button>
                <button class="btn-secondary">Beli Lagi</button>
            </div>

            <div class="detail-section">
                <h5>Faktur</h5>
                <a href="#" class="invoice-link" onclick="downloadInvoice()">Lihat Tagihan</a>
                <div style="height: 5px; background: linear-gradient(to right, pink 50%, lightblue 50%); margin-top:10px;"></div>
            </div>

            <div class="detail-section">
                <h5>Alamat Pengiriman</h5>
                <p><strong>Daniel Dwie</strong></p>
                <p>(+62) 812-xxxx-xxxx</p>
                <p>Jl. Shopee No. 123, Kel. Ecommerce, Kec. Digital, Kota Jakarta Kode Pos 12345</p>
            </div>

            <div class="detail-section">
                <h5>Info Pengiriman</h5>
                <p>JNE REGULAR - Tracking ID: SPX000123456789</p>
                <p><em>Status: Pesanan telah diterima oleh penerima</em></p>
            </div>


            <div class="detail-section">
                <h5>Produk Dipesan</h5>
                 <div class="order-item">
                    <img src="https://via.placeholder.com/60x60.png?text=Mouse" alt="Produk Mouse">
                    <div class="item-details">
                        <span class="item-name">Fantech XD3 V3 8K 4K Helios II PRO S Wireless Mouse Gaming 3in1 Connection</span>
                        <span class="item-variation">Variasi: XD3 V3 Putih 1K</span>
                        <span>x1</span>
                    </div>
                    <div class="item-price">Rp529.000</div>
                </div>
                </div>

            <div class="detail-section">
                <h5>Rincian Pembayaran</h5>
                <div class="payment-summary-item">
                    <span>Subtotal untuk Produk</span>
                    <span>Rp529.000</span>
                </div>
                 <div class="payment-summary-item">
                    <span>Ongkos Kirim</span>
                    <span>Rp0</span> </div>
                <div class="payment-summary-item">
                    <span>Potongan (mis. Koin Shopee)</span>
                    <span>-Rp45.920</span> </div>
                <div class="payment-summary-item total">
                    <span>Total Pesanan</span>
                    <span>Rp483.080</span>
                </div>
                <p style="margin-top:10px; font-size:0.9em;">Metode Pembayaran: ShopeePay</p>
            </div>

        </main>
    </div>

    <div class="floating-chat">💬 Chat</div>

    <script>
        function downloadInvoice() {
            // Placeholder untuk fungsi unduh PDF.
            // Di aplikasi nyata, ini akan memicu request ke backend untuk generate dan download PDF.
            alert('Memulai unduh tagihan PDF...');
        }
    </script>

</body>
</html>
