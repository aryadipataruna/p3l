<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Merchandise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Basic reset and font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f0f0f0; /* Light grey background */
            color: #333; /* Default text color */
            line-height: 1.6;
        }

        .navbar {
            background-color: #1a1a1a; /* Dark background for navbar */
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-links {
            display: flex;
            gap: 20px;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .navbar .nav-links a:hover {
            color: #7BC9FF; /* Highlight color on hover */
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .user-info .user-avatar {
            width: 30px;
            height: 30px;
            background-color: #7BC9FF; /* Avatar background color */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1a1a;
            font-weight: 700;
        }

        .navbar .user-info .user-details {
            display: flex;
            flex-direction: column;
            font-size: 0.9rem;
        }

        .navbar .user-info .user-details .role {
            font-size: 0.8rem;
            color: #ccc;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .page-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #8576FF; /* Underline title */
            padding-bottom: 10px;
        }

        .filter-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }

        .filter-section label {
            font-weight: 600;
        }

        .filter-section .search-input {
            flex-grow: 1; /* Allow search input to take available space */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            min-width: 150px; /* Minimum width for search input */
        }

        .filter-section .add-button {
            background-color: #8576FF; /* Button background */
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .filter-section .add-button:hover {
            background-color: #6b60c4; /* Darker color on hover */
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .data-table th {
            background-color: #f2f2f2; /* Header background */
            font-weight: 700;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Zebra striping */
        }

        .data-table .action-buttons a {
            margin-right: 5px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .data-table .action-buttons .edit-btn {
            background-color: #7BC9FF; /* Edit button color */
            color: #fff;
        }

        .data-table .action-buttons .delete-btn {
            background-color: #ff6b6b; /* Delete button color */
            color: #fff;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 10px;
            }

            .navbar .nav-links {
                flex-direction: column;
                align-items: center;
            }

            .filter-section {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-section .search-input,
            .filter-section .add-button {
                width: 100%;
            }

            .data-table th,
            .data-table td {
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
            }
        }

    </style>
</head>
<body>

    <div class="navbar">
        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="#">Pegawai</a>
            <a href="#">Organisasi</a>
            <a href="#">Merchandise</a>
            <a href="#">Profile</a>
        </div>
        <div class="user-info">
            <div class="user-details">
                <span>GreenTea123</span>
                <span class="role">Admin</span>
            </div>
            <div class="user-avatar">
                 <i class="fas fa-user"></i> {{-- User icon --}}
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="page-title">Data Merchandise - ReUse Mart</h1>

        <div class="filter-section">
            <label for="search">Filter Rows:</label>
            <input type="text" id="search" class="search-input" placeholder="Search By Id">
            <button class="add-button">
                 <i class="fas fa-plus"></i> Tambah Merchandise
            </button>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>ID Merchandise</th>
                    <th>Nama Merchandise</th>
                    <th>ID Penukaran</th>
                </tr>
            </thead>
            <tbody>
                {{-- Example Data (replace with your actual data loop) --}}
                <tr>
                    <td class="action-buttons">
                        <a href="#" class="edit-btn">Edit</a>
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                    <td>MCH001</td>
                    <td>Tumbler Exclusive</td>
                    <td>PNK001</td>
                </tr>
                {{-- Add more rows here with a foreach loop in Blade --}}
                {{--
                @foreach($merchandiseData as $item)
                <tr>
                    <td class="action-buttons">
                        <a href="#" class="edit-btn">Edit</a>
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                    <td>{{ $item->ID_MERCHANDISE }}</td>
                    <td>{{ $item->NAMA_MERCHANDISE }}</td>
                    <td>{{ $item->ID_PENUKARAN }}</td>
                </tr>
                @endforeach
                --}}
            </tbody>
        </table>
    </div>

    <script>
        // You can add JavaScript here for:
        // 1. Handling the search input to filter the table data (requires fetching data or filtering existing data)
        // 2. Handling button clicks (e.g., "Tambah Merchandise" to open a modal or redirect)
        // 3. Handling Edit/Delete button actions (e.g., confirming delete, redirecting to edit page)

        // Example: Simple alert for Add button
        document.querySelector('.add-button').addEventListener('click', () => {
            alert('Tambah Merchandise button clicked!');
            // Implement actual logic here (e.g., window.location.href = '/admin/merchandise/create';)
        });

        // Example: Simple alerts for Edit/Delete buttons (delegation recommended for dynamic rows)
        document.querySelectorAll('.action-buttons .edit-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default link behavior
                const merchandiseId = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
                alert('Edit button clicked for Merchandise ID: ' + merchandiseId);
                 // Implement actual logic here (e.g., window.location.href = '/admin/merchandise/' + merchandiseId + '/edit';)
            });
        });

         document.querySelectorAll('.action-buttons .delete-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default link behavior
                const merchandiseId = event.target.closest('tr').querySelector('td:nth-child(2)').textContent;
                if (confirm('Are you sure you want to delete Merchandise ID: ' + merchandiseId + '?')) {
                    alert('Delete confirmed for Merchandise ID: ' + merchandiseId);
                    // Implement actual delete logic here (e.g., send AJAX request to delete route)
                }
            });
        });

    </script>

</body>
</html>
