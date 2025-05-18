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
        <a href="{{ route('login-regis') }}" class="nav-link text-light">Log In</a>
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
    // Function to fetch data from the API
    async function fetchBarang() {
        try {
            // Replace with your actual API endpoint URL
            const response = await fetch('http://127.0.0.1:8000/api/barang'); // <-- Replace with your API URL
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            return data.data; // Assuming your API returns data in a 'data' key
        } catch (error) {
            console.error("Error fetching barang data:", error);
            document.getElementById('loadingBarang').innerText = 'Failed to load items.';
            document.getElementById('loadingCategories').innerText = 'Failed to load categories.';
            return []; // Return empty array on error
        }
    }

    // Function to render categories
    function renderCategories(barangData) {
        const categoriesRow = document.getElementById('categoriesRow');
        categoriesRow.innerHTML = ''; // Clear loading message

        if (barangData.length === 0) {
             categoriesRow.innerHTML = '<div class="col-12 text-center text-white">No categories found.</div>';
             return;
        }

        // Extract unique categories
        const uniqueCategories = [...new Set(barangData.map(item => item.kategori))];

        // Render each category
        uniqueCategories.forEach(category => {
            const categoryCol = document.createElement('div');
            categoryCol.classList.add('col-md-3', 'mb-3'); // Use Bootstrap grid classes

            // Basic placeholder image URL - replace with actual category images if available
            // Using placehold.co for simple text placeholders
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

    // Function to render barang items
    function renderBarang(barangData) {
        const barangRow = document.getElementById('barangRow');
        barangRow.innerHTML = ''; // Clear loading message

        if (barangData.length === 0) {
            barangRow.innerHTML = '<div class="col-12 text-center text-white">No items found.</div>';
            return;
        }

        // Render each barang item
        barangData.forEach(item => {
            const itemCol = document.createElement('div');
            itemCol.classList.add('col-md-3', 'mb-4'); // Use Bootstrap grid classes

            // Basic placeholder image URL - replace with actual item images if available
            // Using placehold.co for simple text placeholders
             const itemPlaceholderImgUrl = `https://placehold.co/300x180/222/white?text=${encodeURIComponent(item.nama_barang)}`;


            itemCol.innerHTML = `
                <div class="card-barang" data-id="${item.id_barang}"> <img src="${itemPlaceholderImgUrl}" class="card-img-top" alt="${item.nama_barang}" onerror="this.onerror=null;this.src='https://placehold.co/300x180/222/white?text=No+Image';">
                    <div class="card-body">
                        <h5 class="card-title">${item.nama_barang}</h5>
                        <p class="card-text">${item.deskripsi_barang}</p>
                        <p class="card-price">Rp ${item.harga_barang.toLocaleString('id-ID')}</p>
                    </div>
                </div>
            `;
            barangRow.appendChild(itemCol);
        });

        // Add click event listeners to the item cards after rendering
        attachItemCardListeners();
    }

    // Function to attach click listeners to item cards
    function attachItemCardListeners() {
        document.querySelectorAll('#barangRow .card-barang').forEach(card => {
            card.addEventListener('click', () => {
                const itemId = card.dataset.id; // Get the item ID from the data-id attribute
                // Redirect to the detail page, passing the item ID as a query parameter
                window.location.href = `/detailBarang/{itemId}`; // <-- Adjust the detail page URL if needed
            });
        });
    }


    // Initial load: Fetch data and render
    document.addEventListener('DOMContentLoaded', async () => {
        const barangData = await fetchBarang();
        renderCategories(barangData);
        renderBarang(barangData);
    });

    // Basic search functionality (client-side filtering)
    // For a real application, you'd likely implement server-side search
    document.getElementById('searchInput').addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase();
        const allItems = document.querySelectorAll('#barangRow .col-md-3'); // Get all item columns

        allItems.forEach(itemCol => {
            // Get the card element within the column
            const card = itemCol.querySelector('.card-barang');
            if (card) {
                const itemName = card.querySelector('.card-title').innerText.toLowerCase();
                const itemDescription = card.querySelector('.card-text').innerText.toLowerCase();

                if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                    itemCol.style.display = 'block'; // Show item column
                } else {
                    itemCol.style.display = 'none'; // Hide item column
                }
            }
        });
    });

</script>

</body>
</html>
