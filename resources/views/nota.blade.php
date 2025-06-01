<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tagihan Pesanan - {{ $order->id ?? 'INV-DUMMY' }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            font-size: 12px; /* Ukuran font dasar untuk PDF */
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px; /* Ukuran font lebih kecil untuk nama toko */
            color: #000;
        }
        .header p {
            margin: 2px 0;
            font-size: 11px; /* Ukuran font lebih kecil untuk alamat */
        }
        .invoice-details {
            margin-bottom: 20px;
            width: 100%;
        }
        .invoice-details td {
            padding: 2px 0;
            font-size: 11px;
        }
        .invoice-details .label {
            font-weight: bold;
            width: 120px; /* Lebar kolom label */
        }

        .customer-details {
            margin-bottom: 20px;
        }
        .customer-details h2 {
            font-size: 13px;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
        }
        .customer-details p {
            margin: 2px 0;
            font-size: 11px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.items th, table.items td {
            border-bottom: 1px solid #eee; /* Garis bawah tipis antar item */
            padding: 8px 5px; /* Padding lebih sedikit */
            text-align: left;
            font-size: 11px;
        }
        table.items th {
            background-color: #f9f9f9;
            font-weight: bold;
            border-top: 1px solid #eee; /* Garis atas untuk header tabel */
        }
        table.items td.price, table.items th.price {
            text-align: right;
        }
        table.items td.quantity, table.items th.quantity {
            text-align: center;
            width: 60px; /* Lebar kolom kuantitas */
        }

        .totals {
            width: 100%;
            margin-top: 20px;
        }
        .totals td {
            padding: 3px 5px; /* Padding lebih sedikit */
            font-size: 11px;
        }
        .totals .label {
            text-align: right;
            font-weight: bold;
            width: 75%; /* Label total mengambil sebagian besar lebar */
        }
        .totals .amount {
            text-align: right;
            font-weight: bold;
        }
        .totals .grand-total .amount {
            font-size: 13px; /* Total akhir lebih besar */
            color: #000;
        }
        .points-info {
            margin-top: 15px;
            font-size: 10px; /* Info poin lebih kecil */
            color: #555;
        }
        .footer-notes {
            margin-top: 30px;
            font-size: 10px;
            color: #777;
            /* text-align: center; */
        }
        .signature-area {
            margin-top: 40px;
            font-size: 11px;
        }
        .signature-area .line {
            width: 200px;
            border-bottom: 1px solid #333;
            margin-top: 30px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $order->store_name ?? 'ReUse Mart' }}</h1>
            <p>{{ $order->store_address ?? 'Jl. Green Eco Park No. 456 Yogyakarta' }}</p>
        </div>

        <table class="invoice-details">
            <tr>
                <td class="label">No Nota</td>
                <td>: {{ $order->invoice_number ?? '24.02.101' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Pesan</td>
                <td>: {{ isset($order->created_at) ? $order->created_at->format('d/m/Y H:i') : '15/02/2025 18:50' }}</td>
            </tr>
            <tr>
                <td class="label">Lunas pada</td>
                <td>: {{ isset($order->paid_at) ? $order->paid_at->format('d/m/Y H:i') : '15/02/2024 19:01' }}</td> </tr>
            <tr>
                <td class="label">Tanggal Ambil/Kirim</td>
                <td>: {{ isset($order->shipped_at) ? $order->shipped_at->format('d/m/Y') : '16/02/2024' }}</td>
            </tr>
        </table>

        <div class="customer-details">
            <h2>Pembeli:</h2>
            <p>{{ $order->customer_name ?? 'Catherine' }} ({{ $order->customer_email ?? 'cath123@gmail.com' }})</p>
            <p>{{ $order->customer_address_line1 ?? 'Perumahan Griya Persada XII/20' }}</p>
            <p>{{ $order->customer_address_line2 ?? 'Caturtunggal, Depok, Sleman' }}</p>
            <p><strong>Delivery:</strong> {{ $order->delivery_method ?? '(diambil sendiri)' }}</p>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>Deskripsi Produk</th>
                    <th class="quantity">Kuantitas</th>
                    <th class="price">Harga Satuan</th>
                    <th class="price">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $actualTotal = 0; @endphp
                @forelse ($order->items ?? [['name' => 'Kompor tanam 3 tungku', 'quantity' => 1, 'price_per_unit' => 2000000, 'subtotal' => 2000000], ['name' => 'Hair Dryer Ion', 'quantity' => 1, 'price_per_unit' => 500000, 'subtotal' => 500000]] as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td class="quantity">{{ $item['quantity'] }}</td>
                        <td class="price">{{ number_format($item['price_per_unit'], 0, ',', '.') }}</td>
                        <td class="price">{{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                    </tr>
                    @php $actualTotal += $item['subtotal']; @endphp
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">Tidak ada item dalam pesanan ini.</td>
                    </tr>
                @endphp
            </tbody>
        </table>

        <table class="totals">
            <tr>
                <td class="label">Total</td>
                <td class="amount">{{ number_format($actualTotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Ongkos Kirim</td>
                <td class="amount">{{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</td>
            </tr>
            @php $subtotalWithShipping = $actualTotal + ($order->shipping_cost ?? 0); @endphp
            <tr>
                <td class="label">Total Sebelum Potongan</td>
                <td class="amount">{{ number_format($subtotalWithShipping, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Potongan {{ $order->discount_description ?? '200 poin' }}</td>
                <td class="amount">-{{ number_format($order->discount_amount ?? 20000, 0, ',', '.') }}</td>
            </tr>
            <tr class="grand-total">
                <td class="label">TOTAL TAGIHAN</td>
                <td class="amount">{{ number_format($subtotalWithShipping - ($order->discount_amount ?? 20000), 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="points-info">
            Poin dari pesanan ini: {{ $order->points_earned ?? 297 }}<br>
            Total poin customer: {{ $order->customer_total_points ?? 300 }}
        </div>

        <div class="footer-notes">
            QC oleh: {{ $order->qc_by ?? 'Farida (P18)' }}
        </div>

        <div class="signature-area">
            Diambil oleh:
            <div class="line"></div>
            Tanggal: ..............................
        </div>
    </div>
</body>
</html>
