<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - ReUse Mart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Basic reset and font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif; /* Use Poppins font */
        }

        body {
            background-color: #1a1a1a; /* Dark background */
            color: #fff; /* Default text color */
            line-height: 1.6;
        }

        .navbar {
            background-color: #222; /* Slightly lighter dark for navbar */
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .navbar .navbar-brand {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .navbar .navbar-brand i {
            margin-right: 5px;
            color: #7BC9FF; /* Highlight icon color */
        }

        .navbar .search-bar {
            flex-grow: 1; /* Allow search bar to take space */
            margin: 0 20px;
        }

        .navbar .search-bar input {
            width: 100%;
            padding: 8px 15px;
            border: none;
            border-radius: 20px; /* Rounded search bar */
            background-color: #333; /* Darker input background */
            color: #fff;
        }

        .navbar .search-bar input::placeholder {
            color: #bbb;
        }

        .navbar .nav-icons a {
            color: #fff;
            text-decoration: none;
            margin-left: 15px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .navbar .nav-icons a:hover {
            color: #7BC9FF; /* Highlight color on hover */
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #222; /* Container background */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        .page-header {
            display: flex;
            justify-content: space-around; /* Distribute space */
            margin-bottom: 30px;
            border-bottom: 2px solid #333; /* Separator */
            padding-bottom: 15px;
        }

        .page-header a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 5px 10px;
            transition: color 0.3s ease, border-bottom 0.3s ease;
        }

        .page-header a:hover,
        .page-header a.active {
            color: #7BC9FF;
            border-bottom: 2px solid #7BC9FF;
        }

        .product-detail-section {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            gap: 30px; /* Space between image/details and side info */
        }

        .product-image-area {
            flex-basis: 40%; /* Take 40% width */
            min-width: 300px; /* Minimum width */
            flex-grow: 1; /* Allow growth */
        }

        .product-image-area img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .product-info-area {
            flex-basis: 55%; /* Take 55% width */
            min-width: 300px; /* Minimum width */
            flex-grow: 1; /* Allow growth */
        }

        .product-info-area h2 {
            font-size: 2rem;
            color: #7BC9FF; /* Highlight color for title */
            margin-bottom: 10px;
        }

        .product-info-area .rating-sold {
            font-size: 0.9rem;
            color: #bbb;
            margin-bottom: 15px;
        }

        .product-info-area .rating-sold i {
            color: #ffc107; /* Star color */
            margin-right: 5px;
        }

        .product-info-area .price {
            font-size: 2.5rem;
            font-weight: 700;
            color: #28a745; /* Green color for price */
            margin-bottom: 20px;
        }

        .product-info-area .description h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
        }

        .product-info-area .description p {
            font-size: 1rem;
            color: #ccc;
        }

        .product-options {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #333;
        }

        .product-options h3 {
             font-size: 1.2rem;
             margin-bottom: 10px;
        }

        .product-options .capacity-options button {
            background-color: #333;
            color: #fff;
            border: 1px solid #555;
            padding: 8px 15px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

         .product-options .capacity-options button:hover,
         .product-options .capacity-options button.selected {
             background-color: #7BC9FF;
             border-color: #7BC9FF;
             color: #1a1a1a;
             font-weight: 600;
         }


        .quantity-adjuster {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }

        .quantity-adjuster label {
            margin-right: 10px;
            font-weight: 600;
        }

        .quantity-adjuster button {
            background-color: #333;
            color: #fff;
            border: 1px solid #555;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .quantity-adjuster button:hover {
             background-color: #555;
             border-color: #777;
        }

        .quantity-adjuster input {
            width: 50px;
            text-align: center;
            padding: 5px;
            margin: 0 5px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }

        .side-info-area {
            flex-basis: 30%; /* Take 30% width */
            min-width: 250px; /* Minimum width */
            background-color: #333; /* Darker background for side info */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .side-info-area h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            border-bottom: 1px solid #555;
            padding-bottom: 10px;
        }

        .side-info-area .info-item {
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .side-info-area .info-item strong {
            display: block;
            margin-bottom: 3px;
        }

        .side-info-area .subtotal {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #555;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .side-info-area .subtotal strong {
            float: right;
            color: #28a745; /* Green color for subtotal */
        }

        /* Style for loading message */
        #loading-message {
            text-align: center;
            padding: 50px;
            font-size: 1.5rem;
            color: #ccc;
        }

         /* Style for error message */
        #error-message {
            text-align: center;
            padding: 50px;
            font-size: 1.5rem;
            color: #ff6b6b; /* Red color for error */
            display: none; /* Hidden by default */
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 10px;
            }

            .navbar .search-bar {
                 margin: 0;
                 width: 100%; /* Full width on small screens */
            }

            .navbar .nav-icons {
                margin-top: 10px;
            }

             .product-detail-section {
                 flex-direction: column; /* Stack sections vertically */
                 gap: 20px;
             }

             .product-image-area,
             .product-info-area,
             .side-info-area {
                 flex-basis: 100%; /* Full width */
                 min-width: unset; /* Remove min-width constraint */
             }

             .page-header {
                 flex-direction: column;
                 align-items: center;
                 gap: 10px;
             }

             .page-header a {
                 font-size: 1rem;
             }
        }

    </style>
</head>
<body>

    <nav class="navbar">
        <a class="navbar-brand" href="#">
            <i class="fa fa-shopping-basket"></i> ReUse <strong>Mart</strong>
        </a>
        <div class="search-bar">
            <input type="text" placeholder="Daftar & cari Barang">
        </div>
        <div class="nav-icons">
            <a href="#"><i class="fa fa-search"></i></a>
            <a href="#"><i class="fa fa-shopping-cart"></i></a>
            <a href="#">Daftar</a>
            <a href="#">Log In</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <a href="#" class="active">Detail Produk</a>
            <a href="#">Diskusi</a>
            <a href="#">Rating</a>
        </div>

        <div id="loading-message">Loading product details...</div>
        <div id="error-message"></div>

        <div class="product-detail-section" id="product-detail-content" style="display: none;">
            <div class="product-image-area">
                <img id="product-image" src="" alt="Product Image">
            </div>
            <div class="product-info-area">
                <h2 id="product-name"></h2>
                <div class="rating-sold">
                    <span id="product-rating"><i class="fas fa-star"></i> Loading...</span>
                    <span id="product-sold"> | Terjual Loading...</span>
                </div>
                <div class="price" id="product-price">Loading...</div>

                <div class="product-options">
                    <h3>Pilih Kapasitas : <span id="selected-capacity">Loading...</span></h3>
                    <div class="capacity-options" id="capacity-options">
                        {{-- Capacity buttons will be added here --}}
                    </div>

                    <div class="quantity-adjuster">
                        <label>Atur Jumlah</label>
                        <button id="decrease-quantity">-</button>
                        <input type="text" id="product-quantity" value="1" readonly>
                        <button id="increase-quantity">+</button>
                         <span id="quantity-info" class="ms-3 text-muted"></span> {{-- e.g., "12/256 GB, Black Unit" --}}
                    </div>
                     <div class="subtotal mt-3">
                        Subtotal <strong id="subtotal-price">Loading...</strong>
                     </div>
                </div>

                <div class="description mt-4">
                    <h3>Deskripsi Produk</h3>
                    <p id="product-description">Loading...</p>
                    {{-- Additional description details like condition, warranty, etc. --}}
                     <div id="additional-description">
                         {{-- Additional details loaded here --}}
                     </div>
                </div>
            </div>

            <div class="side-info-area">
                <h3>Info Produk</h3>
                 <div class="info-item">
                     <strong>Min. Pemesanan:</strong> <span id="min-order">Loading...</span>
                 </div>
                  <div class="info-item">
                     <strong>Etalase:</strong> <span id="etalase">Loading...</span>
                 </div>
                 {{-- Add more info items as needed --}}
            </div>
        </div>

        {{-- Placeholder sections for Diskusi and Rating --}}
        <div id="diskusi-section" style="display: none; margin-top: 30px;">
             <h2>Diskusi</h2>
             <p>Diskusi section content will go here.</p>
        </div>

         <div id="rating-section" style="display: none; margin-top: 30px;">
             <h2>Rating</h2>
             <p>Rating section content will go here.</p>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Get references to DOM elements
        const loadingMessage = document.getElementById('loading-message');
        const errorMessage = document.getElementById('error-message');
        const productDetailContent = document.getElementById('product-detail-content');

        const productImage = document.getElementById('product-image');
        const productName = document.getElementById('product-name');
        const productRating = document.getElementById('product-rating');
        const productSold = document.getElementById('product-sold');
        const productPrice = document.getElementById('product-price');
        const selectedCapacitySpan = document.getElementById('selected-capacity');
        const capacityOptionsDiv = document.getElementById('capacity-options');
        const productQuantityInput = document.getElementById('product-quantity');
        const decreaseQuantityButton = document.getElementById('decrease-quantity');
        const increaseQuantityButton = document.getElementById('increase-quantity');
        const quantityInfoSpan = document.getElementById('quantity-info');
        const subtotalPriceSpan = document.getElementById('subtotal-price');
        const productDescription = document.getElementById('product-description');
        const additionalDescriptionDiv = document.getElementById('additional-description');

        const minOrderSpan = document.getElementById('min-order');
        const etalaseSpan = document.getElementById('etalase');

        // Placeholder for the fetched item data
        let currentItemData = null;

        // Function to display error messages
        function showErrorMessage(message) {
            loadingMessage.style.display = 'none';
            productDetailContent.style.display = 'none';
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
        }

        // Function to fetch item data from the API
        async function fetchBarangDetail(itemId) {
            loadingMessage.style.display = 'block';
            errorMessage.style.display = 'none';
            productDetailContent.style.display = 'none';

            // Basic validation for itemId
            if (!itemId) {
                showErrorMessage('Item ID is missing.');
                return;
            }


            try {
                // Replace with your actual API endpoint base URL if different
                const response = await fetch(`http://127.0.0.1:8000/api/barang/${itemId}`); // <-- Replace base URL

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(`HTTP error! status: ${response.status}, Message: ${errorData.message || response.statusText}`);
                }

                const responseData = await response.json();

                // Assuming your API returns { status: true, data: { ...item } } on success
                if (responseData.status === true && responseData.data) {
                    currentItemData = responseData.data; // Store the fetched data
                    renderBarangDetail(currentItemData); // Render the details
                    loadingMessage.style.display = 'none';
                    productDetailContent.style.display = 'flex'; // Show the content
                } else {
                     console.error('API response indicates failure:', responseData);
                     showErrorMessage(`Failed to load product data: ${responseData.message || 'Unknown error'}`);
                }

            } catch (error) {
                console.error('Error fetching product data:', error);
                showErrorMessage(`Error loading product data: ${error.message}`);
            }
        }

        // Function to render the fetched item data on the page
        function renderBarangDetail(item) {
            // Populate the main details
            // Note: The image URL is hardcoded as a placeholder. You'll need to
            // replace this with the actual image URL from your item data if available.
            // If your API returns an image URL field (e.g., item.image_url), use that.
            // If not, you'll need to adjust your backend or handle images differently.
            const itemPlaceholderImgUrl = `https://placehold.co/600x400/222/white?text=${encodeURIComponent(item.nama_barang || 'No Image')}`;
            productImage.src = item.image_url || itemPlaceholderImgUrl; // Use item.image_url if it exists, otherwise use placeholder
            productImage.alt = item.nama_barang || 'Product Image';
            // Add an error handler for the image in case the URL is broken
            productImage.onerror = function() {
                 this.onerror = null; // Prevent infinite loop
                 this.src = `https://placehold.co/600x400/222/white?text=Image+Not+Found`;
                 this.alt = 'Image Not Found';
            };


            productName.textContent = item.nama_barang || 'Nama Produk Tidak Tersedia';
            // Placeholder for rating and sold count - replace with actual data if available
            productRating.innerHTML = `<i class="fas fa-star"></i> ${item.rating || 'N/A'} (${item.rating_count || 0} rating)`; // Assuming fields like rating and rating_count
            productSold.textContent = ` | Terjual ${item.sold_count || 0}`; // Assuming a field like sold_count
            productPrice.textContent = `Rp ${item.harga_barang ? item.harga_barang.toLocaleString('id-ID') : 'N/A'}`;

            // Populate description
            productDescription.textContent = item.deskripsi_barang || 'Deskripsi tidak tersedia.';

            // Populate side info
            minOrderSpan.textContent = item.min_pemesanan || 'N/A'; // Assuming a field like min_pemesanan
            etalaseSpan.textContent = item.kategori || 'N/A'; // Using kategori as etalase based on the image

            // Handle capacity options (example: assuming capacities are in a field like item.capacities = ['12/256GB', '12/512GB'])
            capacityOptionsDiv.innerHTML = ''; // Clear previous buttons
            if (item.capacities && item.capacities.length > 0) {
                 item.capacities.forEach(capacity => {
                     const button = document.createElement('button');
                     button.textContent = capacity;
                     // Add a click listener to select capacity (client-side only)
                     button.addEventListener('click', () => {
                         // Remove 'selected' class from all buttons
                         capacityOptionsDiv.querySelectorAll('button').forEach(btn => btn.classList.remove('selected'));
                         // Add 'selected' class to the clicked button
                         button.classList.add('selected');
                         // Update the selected capacity text
                         selectedCapacitySpan.textContent = capacity;
                         // Update quantity info text (example)
                         quantityInfoSpan.textContent = `${capacity}, ${item.warna || 'Color'} Unit`; // Assuming item.warna field
                     });
                     capacityOptionsDiv.appendChild(button);
                 });
                 // Optionally, select the first capacity by default
                 if (capacityOptionsDiv.querySelector('button')) {
                     capacityOptionsDiv.querySelector('button').click(); // Simulate click on the first button
                 } else {
                      selectedCapacitySpan.textContent = 'No capacity options available';
                      quantityInfoSpan.textContent = '';
                 }
            } else {
                 selectedCapacitySpan.textContent = 'No capacity options available';
                 capacityOptionsDiv.innerHTML = ''; // Remove placeholder if no options
                 quantityInfoSpan.textContent = '';
            }


            // Handle quantity adjustment (client-side only)
            // Remove existing listeners to prevent duplicates if renderBarangDetail is called multiple times
            const oldDecreaseListener = decreaseQuantityButton.onclick;
            const oldIncreaseListener = increaseQuantityButton.onclick;
            if (oldDecreaseListener) decreaseQuantityButton.removeEventListener('click', oldDecreaseListener);
            if (oldIncreaseListener) increaseQuantityButton.removeEventListener('click', oldIncreaseListener);


            decreaseQuantityButton.addEventListener('click', () => {
                let currentQuantity = parseInt(productQuantityInput.value);
                if (currentQuantity > 1) { // Ensure quantity doesn't go below 1
                    productQuantityInput.value = currentQuantity - 1;
                    updateSubtotal();
                }
            });

            increaseQuantityButton.addEventListener('click', () => {
                let currentQuantity = parseInt(productQuantityInput.value);
                 // You might want to add a check for available stock here
                productQuantityInput.value = currentQuantity + 1;
                updateSubtotal();
            });

            // Function to update the subtotal based on quantity and price
            function updateSubtotal() {
                 const quantity = parseInt(productQuantityInput.value);
                 const price = currentItemData.harga_barang || 0;
                 const subtotal = quantity * price;
                 subtotalPriceSpan.textContent = subtotal.toLocaleString('id-ID');
            }

            // Initial subtotal calculation
            updateSubtotal();

            // Handle additional description details (example: assuming details are in a field like item.additional_details = [{ title: 'Kondisi', text: 'Second' }, ...])
            additionalDescriptionDiv.innerHTML = ''; // Clear previous details
            if (item.additional_details && item.additional_details.length > 0) {
                 item.additional_details.forEach(detail => {
                     const detailDiv = document.createElement('div');
                     detailDiv.classList.add('info-item'); // Use info-item class for styling
                     detailDiv.innerHTML = `<strong>${detail.title}:</strong> ${detail.text}`;
                     additionalDescriptionDiv.appendChild(detailDiv);
                 });
            } else {
                 additionalDescriptionDiv.innerHTML = '<p>No additional details available.</p>';
            }


            // You would also populate Diskusi and Rating sections here if you had the data
            // For now, they are just placeholders.
        }


        // --- Initial Data Load ---
        document.addEventListener('DOMContentLoaded', () => {
            // Get the item ID from the URL query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const itemIdToDisplay = urlParams.get('id'); // Get the value of the 'id' parameter

            // Fetch data using the ID from the URL
            fetchBarangDetail(itemIdToDisplay);
        });

        // Note: The search bar and other navbar links are not functional in this code.
        // The Diskusi and Rating sections are also placeholders.

    </script>

</body>
</html>
