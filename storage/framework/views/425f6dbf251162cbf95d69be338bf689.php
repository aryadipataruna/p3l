<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #111;
            color: white;
        }
        .navbar {
            background-color: #222;
        }
        .category-img {
            height: 100px;
            object-fit: cover;
        }
        .card-barang {
            background-color: #222; /* Darker background for cards */
            color: white;
            border: 1px solid #333;
            border-radius: 0.5rem; /* Use Bootstrap's rounded corners */
            overflow: hidden; /* Ensure image corners are rounded */
            height: 100%; /* Make cards fill height in grid */
            display: flex;
            flex-direction: column;
            cursor: pointer; /* Add cursor pointer to indicate clickability */
            transition: transform 0.2s ease-in-out; /* Add a slight hover effect */
        }
        .card-barang:hover {
            transform: translateY(-5px); /* Lift card slightly on hover */
            box-shadow: 0 5px 15px rgba(0,0,0,0.3); /* Add shadow on hover */
        }
        .card-barang img {
             width: 100%;
             height: 180px; /* Fixed height for images */
             object-fit: cover; /* Cover the area without distorting aspect ratio */
             border-top-left-radius: 0.5rem;
             border-top-right-radius: 0.5rem;
        }
        .card-body {
            flex-grow: 1; /* Allow body to take up remaining space */
            display: flex;
            flex-direction: column;
            padding: 1rem; /* Add some padding */
        }
        .card-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #fff;
        }
        .card-text {
            font-size: 0.9rem;
            color: #bbb;
            margin-bottom: 0.5rem;
        }
        .card-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #28a745; /* Green color for price */
            margin-top: auto; /* Push price to the bottom */
        }
         .category-card {
             background-color: #333; /* Slightly lighter than card-barang */
             color: white;
             border: 1px solid #444;
             border-radius: 0.5rem;
             padding: 1rem;
             text-align: center;
             cursor: pointer; /* Indicate it's clickable */
             transition: background-color 0.2s ease-in-out;
         }
         .category-card:hover {
             background-color: #444; /* Darken on hover */
         }
         .category-card strong {
             display: block; /* Ensure title is on its own line */
             margin-top: 0.5rem;
         }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark px-4">
    <a class="navbar-brand" href="#"><i class="fa fa-shopping-basket me-2"></i> ReUse <strong>Mart</strong></a>
    <div class="flex-grow-1 mx-3">
        <input class="form-control" type="search" placeholder="Daftar & cari Barang" id="searchInput">
    </div>
    <div class="d-flex align-items-center">
        <a href="#" class="nav-link text-light"><i class="fa fa-search me-2"></i></a>
        <a href="#" class="nav-link text-light"><i class="fa fa-shopping-cart me-2"></i></a>
        <a href="<?php echo e(route('login-regis')); ?>" class="nav-link text-light">Log In</a>
    </div>
</nav>

<div class="container mt-4">
    <h5>Kategori</h5>
    <div class="row text-center text-dark" id="categoriesRow">
        <div class="col-12 text-center text-white" id="loadingCategories">
            Loading categories...
        </div>
    </div>

    <h5 class="mt-4">Barang</h5>
    <div class="row" id="barangRow">
        <div class="col-12 text-center text-white" id="loadingBarang">
            Loading items...
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ✅ Fungsi ambil parameter itemId dari URL
    function getItemIdFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('itemId'); // Mengambil nilai ?itemId=...
    }

    // ✅ Function untuk fetch data dari API
    async function fetchBarang() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/barang');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            return data.data;
        } catch (error) {
            console.error("Error fetching barang data:", error);
            document.getElementById('loadingBarang').innerText = 'Failed to load items.';
            document.getElementById('loadingCategories').innerText = 'Failed to load categories.';
            return [];
        }
    }

    // ✅ Function untuk render kategori
    function renderCategories(barangData) {
        const categoriesRow = document.getElementById('categoriesRow');
        categoriesRow.innerHTML = '';

        if (barangData.length === 0) {
            categoriesRow.innerHTML = '<div class="col-12 text-center text-white">No categories found.</div>';
            return;
        }

        const uniqueCategories = [...new Set(barangData.map(item => item.kategori))];

        uniqueCategories.forEach(category => {
            const categoryCol = document.createElement('div');
            categoryCol.classList.add('col-md-3', 'mb-3');

            const placeholderImgUrl = `https://placehold.co/100x100/333/white?text=${encodeURIComponent(category)}`;

            categoryCol.innerHTML = `
                <div class="category-card">
                    <img src="${placeholderImgUrl}" class="category-img w-100 mb-2 rounded" alt="${category}" onerror="this.onerror=null;this.src='https://placehold.co/100x100/333/white?text=No+Image';">
                    <strong>${category}</strong>
                </div>
            `;
            categoriesRow.appendChild(categoryCol);
        });
    }

    // ✅ Function untuk render barang
    function renderBarang(barangData) {
        const barangRow = document.getElementById('barangRow');
        barangRow.innerHTML = '';

        if (barangData.length === 0) {
            barangRow.innerHTML = '<div class="col-12 text-center text-white">No items found.</div>';
            return;
        }

        barangData.forEach(item => {
            const itemCol = document.createElement('div');
            itemCol.classList.add('col-md-3', 'mb-4');

            const itemPlaceholderImgUrl = `https://placehold.co/300x180/222/white?text=${encodeURIComponent(item.nama_barang)}`;

            itemCol.innerHTML = `
                <div class="card-barang" data-id="${item.id_barang}">
                    <img src="${itemPlaceholderImgUrl}" class="card-img-top" alt="${item.nama_barang}" onerror="this.onerror=null;this.src='https://placehold.co/300x180/222/white?text=No+Image';">
                    <div class="card-body">
                        <h5 class="card-title">${item.nama_barang}</h5>
                        <p class="card-text">${item.deskripsi_barang}</p>
                        <p class="card-price">Rp ${item.harga_barang.toLocaleString('id-ID')}</p>
                    </div>
                </div>
            `;
            barangRow.appendChild(itemCol);
        });

        attachItemCardListeners(); // Re-attach after render
    }

    // ✅ Tambah event klik pada kartu barang
    function attachItemCardListeners() {
        document.querySelectorAll('#barangRow .card-barang').forEach(card => {
            card.addEventListener('click', () => {
                const itemId = card.dataset.id;
                window.location.href = `/detailBarang?itemId=${itemId}`;
            });
        });
    }

    // ✅ Saat halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', async () => {
        const barangData = await fetchBarang();
        const itemId = getItemIdFromUrl();

        let filteredBarang = barangData;

        if (itemId) {
            filteredBarang = barangData.filter(item => item.id_barang == itemId);
        }

        renderCategories(filteredBarang);
        renderBarang(filteredBarang);
    });

    // ✅ Fitur pencarian (client-side)
    document.getElementById('searchInput').addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase();
        const allItems = document.querySelectorAll('#barangRow .col-md-3');

        allItems.forEach(itemCol => {
            const card = itemCol.querySelector('.card-barang');
            if (card) {
                const itemName = card.querySelector('.card-title').innerText.toLowerCase();
                const itemDescription = card.querySelector('.card-text').innerText.toLowerCase();

                if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                    itemCol.style.display = 'block';
                } else {
                    itemCol.style.display = 'none';
                }
            }
        });
    });
</script>

</body>
</html>
<?php /**PATH D:\p3l\resources\views/homePage.blade.php ENDPATH**/ ?>