<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Gudang - Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #1a1a1a; /* Dark background */
            color: #f8f9fa; /* Light text */
        }
        .navbar {
            background-color: #2c2c2c; /* Darker navbar */
            border-bottom: 1px solid #444;
        }
        .container-fluid {
            padding-top: 20px;
        }
        .card {
            background-color: #2c2c2c; /* Darker card background */
            border: 1px solid #444;
            border-radius: 0.5rem;
        }
        .card-header {
            background-color: #3a3a3a; /* Slightly lighter card header */
            border-bottom: 1px solid #444;
            color: #f8f9fa;
        }
        .table {
            color: #f8f9fa; /* Light text for table */
        }
        .table thead th {
            border-bottom: 2px solid #555;
        }
        .table tbody tr {
            border-bottom: 1px solid #444;
        }
        .table tbody tr:last-child {
            border-bottom: none;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #1e7e34;
            border-color: #1e7e34;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #117a8b;
            border-color: #117a8b;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #bd2130;
            border-color: #bd2130;
        }
        .btn-warning { /* New style for Perpanjang button */
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529; /* Dark text for warning */
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
        .modal-content {
            background-color: #2c2c2c;
            color: #f8f9fa;
            border: 1px solid #444;
        }
        .modal-header, .modal-footer {
            border-color: #444;
        }
        .form-control, .form-select {
            background-color: #3a3a3a;
            color: #f8f9fa;
            border: 1px solid #555;
        }
        .form-control:focus, .form-select:focus {
            background-color: #3a3a3a;
            color: #f8f9fa;
            border-color: #888;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
        .loading-message, .error-message {
            text-align: center;
            padding: 1rem;
            color: #bbb;
        }
        .error-message {
            color: #dc3545;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa fa-warehouse me-2"></i> Admin <strong>Gudang</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Barang</a>
                    </li>
                    {{-- Add other admin links here if any --}}
                </ul>
                <div class="d-flex">
                    <a href="#" class="nav-link text-light"><i class="fa fa-user me-2"></i> Admin User</a>
                    <a href="{{ route('logout') }}" class="nav-link text-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Daftar Barang</h5>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEditBarangModal" id="addBarangBtn">
                    <i class="fa fa-plus me-2"></i> Tambah Barang
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Tgl Titip</th>
                                <th>Tgl Akhir</th>
                                <th>Status</th>
                                <th>Perpanjangan</th>
                                <th style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="barangTableBody">
                            <tr><td colspan="9" class="loading-message">Memuat data barang...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addEditBarangModal" tabindex="-1" aria-labelledby="addEditBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEditBarangModalLabel">Tambah Barang Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="barangForm">
                        <input type="hidden" id="barangId" name="id_barang">
                        <div class="mb-3">
                            <label for="id_penitip" class="form-label">ID Penitip</label>
                            <input type="text" class="form-control" id="id_penitip" name="id_penitip" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_diskusi" class="form-label">ID Diskusi (Opsional)</label>
                            <input type="text" class="form-control" id="id_diskusi" name="id_diskusi">
                        </div>
                        <div class="mb-3">
                            <label for="id_pegawai" class="form-label">ID Pegawai</label>
                            <input type="text" class="form-control" id="id_pegawai" name="id_pegawai" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
                            <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_barang" class="form-label">Harga Barang</label>
                            <input type="number" class="form-control" id="harga_barang" name="harga_barang" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_titip" class="form-label">Tanggal Titip</label>
                            <input type="date" class="form-control" id="tgl_titip" name="tgl_titip" readonly>
                            <small class="form-text text-muted">Akan diisi otomatis dengan tanggal hari ini.</small>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_laku" class="form-label">Tanggal Laku (Opsional)</label>
                            <input type="date" class="form-control" id="tgl_laku" name="tgl_laku">
                        </div>
                        <div class="mb-3">
                            <label for="tgl_akhir" class="form-label">Tanggal Akhir (Otomatis)</label>
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" readonly>
                            <small class="form-text text-muted">Akan dihitung otomatis berdasarkan tanggal titip.</small>
                        </div>
                        <div class="mb-3">
                            <label for="garansi" class="form-label">Garansi</label>
                            <select class="form-select" id="garansi" name="garansi" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (Opsional)</label>
                            <input type="text" class="form-control" id="status" name="status" placeholder="misal: tersedia, terjual, kadaluarsa">
                        </div>
                        <div class="mb-3">
                            <label for="gambar_barang" class="form-label">URL Gambar Barang (Opsional)</label>
                            <input type="text" class="form-control" id="gambar_barang" name="gambar_barang" placeholder="Contoh: https://example.com/image.jpg">
                        </div>
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                            <input type="text" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                            <small class="form-text text-muted">Ini adalah URL atau referensi bukti pembayaran.</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" id="saveBarangBtn">Simpan Barang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteBarangModal" tabindex="-1" aria-labelledby="deleteBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBarangModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus barang ini?
                    <input type="hidden" id="deleteBarangId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBarangBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const barangTableBody = document.getElementById('barangTableBody');
        const addEditBarangModal = new bootstrap.Modal(document.getElementById('addEditBarangModal'));
        const deleteBarangModal = new bootstrap.Modal(document.getElementById('deleteBarangModal'));
        const barangForm = document.getElementById('barangForm');
        const barangIdInput = document.getElementById('barangId');
        const addEditModalLabel = document.getElementById('addEditBarangModalLabel');
        const confirmDeleteBarangBtn = document.getElementById('confirmDeleteBarangBtn');
        const deleteBarangIdInput = document.getElementById('deleteBarangId');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Form elements for date auto-fill
        const tglTitipInput = document.getElementById('tgl_titip');
        const tglAkhirInput = document.getElementById('tgl_akhir');

        // Function to get today's date in YYYY-MM-DD format
        function getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Function to calculate date + days
        function addDaysToDate(dateString, days) {
            const date = new Date(dateString);
            date.setDate(date.getDate() + days);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Function to fetch all barang data
        async function fetchBarangData() {
            barangTableBody.innerHTML = `<tr><td colspan="9" class="loading-message">Memuat data barang...</td></tr>`;
            try {
                const response = await fetch('/api/barang', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(`HTTP error! status: ${response.status}, Message: ${errorData.message || response.statusText}`);
                }

                const responseData = await response.json();

                if (responseData.status === true && responseData.data) {
                    renderBarangTable(responseData.data);
                } else {
                    barangTableBody.innerHTML = `<tr><td colspan="9" class="error-message">Gagal memuat data barang: ${responseData.message || 'Error tidak diketahui'}</td></tr>`;
                    console.error('API response indicates failure:', responseData);
                }

            } catch (error) {
                barangTableBody.innerHTML = `<tr><td colspan="9" class="error-message">Error memuat data barang. Silakan cek konsol untuk detail.</td></tr>`;
                console.error('Error fetching barang data:', error);
            }
        }

        // Function to render barang data in the table
        function renderBarangTable(barangData) {
            barangTableBody.innerHTML = ''; // Clear existing rows
            if (barangData.length === 0) {
                barangTableBody.innerHTML = `<tr><td colspan="9" class="text-center text-muted">Tidak ada data barang.</td></tr>`;
                return;
            }

            const today = getTodayDate(); // Get today's date for comparison

            barangData.forEach(barang => {
                const row = barangTableBody.insertRow();
                // Format dates for display
                const tglTitipFormatted = barang.tgl_titip ? new Date(barang.tgl_titip).toLocaleDateString('id-ID') : 'N/A';
                const tglAkhirFormatted = barang.tgl_akhir ? new Date(barang.tgl_akhir).toLocaleDateString('id-ID') : 'N/A';

                // Determine if 'Perpanjang' button should be active
                const canExtend = barang.status === 'tersedia' &&
                                  barang.tgl_akhir &&
                                  barang.tgl_akhir === today && // Only if tgl_akhir is today
                                  barang.count_perpanjangan < 2; // Max 2 extensions

                row.innerHTML = `
                    <td>${barang.id_barang || 'N/A'}</td>
                    <td>${barang.nama_barang || 'N/A'}</td>
                    <td>${barang.kategori || 'N/A'}</td>
                    <td>Rp ${barang.harga_barang ? barang.harga_barang.toLocaleString('id-ID') : 'N/A'}</td>
                    <td>${tglTitipFormatted}</td>
                    <td>${tglAkhirFormatted}</td>
                    <td>${barang.status || 'N/A'}</td>
                    <td>${barang.count_perpanjangan || 0} / 2</td>
                    <td>
                        <button class="btn btn-info btn-sm me-2 edit-btn" data-id="${barang.id_barang}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm me-2 delete-btn" data-id="${barang.id_barang}"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-warning btn-sm extend-btn" data-id="${barang.id_barang}" ${canExtend ? '' : 'disabled'} title="${canExtend ? 'Perpanjang Masa Titip' : 'Tidak dapat diperpanjang'}"><i class="fa fa-redo"></i></button>
                    </td>
                `;
            });

            // Attach event listeners for edit, delete, and extend buttons after rendering
            attachTableButtonListeners();
        }

        // Attach event listeners to dynamically created buttons
        function attachTableButtonListeners() {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => showEditModal(button.dataset.id));
            });
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', () => showDeleteConfirmation(button.dataset.id));
            });
            document.querySelectorAll('.extend-btn').forEach(button => {
                button.addEventListener('click', () => {
                    if (confirm('Apakah Anda yakin ingin memperpanjang masa titip barang ini?')) {
                        extendBarangConsignment(button.dataset.id);
                    }
                });
            });
        }

        // Show Add/Edit Modal
        document.getElementById('addBarangBtn').addEventListener('click', () => {
            addEditModalLabel.textContent = 'Tambah Barang Baru';
            barangForm.reset(); // Clear form
            barangIdInput.value = ''; // Clear hidden ID

            // Auto-fill tgl_titip and calculate tgl_akhir for new item
            const today = getTodayDate();
            tglTitipInput.value = today;
            tglAkhirInput.value = addDaysToDate(today, 30);

            addEditBarangModal.show();
        });

        // Show Edit Modal
        async function showEditModal(id) {
            addEditModalLabel.textContent = 'Edit Barang';
            barangForm.reset(); // Clear form
            barangIdInput.value = id; // Set hidden ID

            try {
                const response = await fetch(`/api/barang/${id}`, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(`HTTP error! status: ${response.status}, Message: ${errorData.message || response.statusText}`);
                }
                const responseData = await response.json();
                if (responseData.status === true && responseData.data) {
                    const barang = responseData.data;
                    document.getElementById('id_penitip').value = barang.id_penitip;
                    document.getElementById('id_diskusi').value = barang.id_diskusi;
                    document.getElementById('id_pegawai').value = barang.id_pegawai;
                    document.getElementById('nama_barang').value = barang.nama_barang;
                    document.getElementById('deskripsi_barang').value = barang.deskripsi_barang;
                    document.getElementById('harga_barang').value = barang.harga_barang;
                    document.getElementById('kategori').value = barang.kategori;
                    
                    // Pre-fill dates (read-only for tgl_titip, tgl_akhir is read-only)
                    tglTitipInput.value = barang.tgl_titip ? new Date(barang.tgl_titip).toISOString().split('T')[0] : '';
                    tglAkhirInput.value = barang.tgl_akhir ? new Date(barang.tgl_akhir).toISOString().split('T')[0] : '';
                    document.getElementById('tgl_laku').value = barang.tgl_laku ? new Date(barang.tgl_laku).toISOString().split('T')[0] : '';

                    document.getElementById('garansi').value = barang.garansi ? '1' : '0';
                    document.getElementById('status').value = barang.status;
                    document.getElementById('gambar_barang').value = barang.gambar_barang;
                    document.getElementById('bukti_pembayaran').value = barang.bukti_pembayaran;
                    
                    addEditBarangModal.show();
                } else {
                    alert('Gagal mengambil data barang: ' + (responseData.message || 'Error tidak diketahui'));
                    console.error('Error fetching single barang:', responseData);
                }
            } catch (error) {
                alert('Error mengambil data barang. Silakan cek konsol.');
                console.error('Error fetching single barang:', error);
            }
        }

        // Handle Form Submission (Add or Edit)
        barangForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const id = barangIdInput.value;
            const method = id ? 'PUT' : 'POST'; // Use PUT for edit, POST for add
            const url = id ? `/api/barang/update/${id}` : '/api/barang/create'; // Corrected URL pattern for PUT

            const formData = new FormData(barangForm);
            const data = Object.fromEntries(formData.entries());

            // Remove automatically handled fields from data sent to backend if adding
            if (!id) { // If it's a new item (POST)
                delete data.tgl_titip; // Backend will set this
                delete data.tgl_akhir; // Backend will set this
                // perpanjangan and count_perpanjangan are not in form
            } else { // If it's an existing item (PUT)
                // tgl_titip and tgl_akhir are read-only, ensure they are not sent if unchanged
                // or ensure backend handles them robustly if sent
                // For this scenario, we will explicitly remove them if they are read-only to avoid accidental updates
                delete data.tgl_titip;
                delete data.tgl_akhir;
            }


            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    let errorMessage = `HTTP error! status: ${response.status}`;
                    if (errorData.message) errorMessage += `, Message: ${errorData.message}`;
                    if (errorData.errors) {
                        for (const field in errorData.errors) {
                            errorMessage += `\n${field}: ${errorData.errors[field].join(', ')}`;
                        }
                    }
                    throw new Error(errorMessage);
                }

                const responseData = await response.json();
                if (responseData.status === true) {
                    alert('Barang berhasil disimpan!');
                    addEditBarangModal.hide(); // Close modal
                    fetchBarangData(); // Refresh table
                } else {
                    alert('Gagal menyimpan barang: ' + (responseData.message || 'Error tidak diketahui'));
                    console.error('API response indicates failure:', responseData);
                }

            } catch (error) {
                alert('Error menyimpan barang. Silakan cek konsol untuk detail:\n' + error.message);
                console.error('Error saving barang:', error);
            }
        });

        // Show Delete Confirmation Modal
        function showDeleteConfirmation(id) {
            deleteBarangIdInput.value = id;
            deleteBarangModal.show();
        }

        // Handle Delete Action
        confirmDeleteBarangBtn.addEventListener('click', async () => {
            const id = deleteBarangIdInput.value;
            try {
                const response = await fetch(`/api/barang/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(`HTTP error! status: ${response.status}, Message: ${errorData.message || response.statusText}`);
                }

                const responseData = await response.json();
                if (responseData.status === true) {
                    alert('Barang berhasil dihapus!');
                    deleteBarangModal.hide(); // Close modal
                    fetchBarangData(); // Refresh table
                } else {
                    alert('Gagal menghapus barang: ' + (responseData.message || 'Error tidak diketahui'));
                    console.error('API response indicates failure:', responseData);
                }

            } catch (error) {
                alert('Error menghapus barang. Silakan cek konsol untuk detail.');
                console.error('Error deleting barang:', error);
            }
        });

        // New function to extend barang consignment
        async function extendBarangConsignment(id) {
            try {
                const response = await fetch(`/api/barang/${id}/extend`, { // New endpoint for extension
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({}) // Empty body, as logic is on backend
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    let errorMessage = `HTTP error! status: ${response.status}`;
                    if (errorData.message) errorMessage += `, Message: ${errorData.message}`;
                    throw new Error(errorMessage);
                }

                const responseData = await response.json();
                if (responseData.status === true) {
                    alert(responseData.message);
                    fetchBarangData(); // Refresh table
                } else {
                    alert('Gagal memperpanjang barang: ' + (responseData.message || 'Error tidak diketahui'));
                    console.error('API response indicates failure:', responseData);
                }

            } catch (error) {
                alert('Error memperpanjang barang. Silakan cek konsol untuk detail:\n' + error.message);
                console.error('Error extending barang:', error);
            }
        }


        // Initial fetch when the page loads
        document.addEventListener('DOMContentLoaded', fetchBarangData);
    </script>
</body>
</html>