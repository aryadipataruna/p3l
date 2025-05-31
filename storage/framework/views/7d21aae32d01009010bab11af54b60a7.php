<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - ReUse Mart</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"> 
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar {
            background-color: #222;
            color: #fff;
            width: 100%;
            padding: 15px 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .navbar a {
            color: #eee;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .navbar a.active {
            background-color: #444;
        }

        .profile-container {
            background-color: #ddd;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 80%;
            max-width: 800px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .profile-icon {
            background-color: #aaa;
            color: #fff;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2em;
        }

        .profile-info h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .profile-details {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 10px 20px;
        }

        .profile-details strong {
            font-weight: bold;
            color: #555;
        }

        .profile-details span {
            color: #777;
        }

        .profile-details .edit-button {
            color: #007bff;
            text-decoration: none;
        }

        .profile-details .edit-button:hover {
            text-decoration: underline;
        }

        .admin-label {
            background-color: orange;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .profile-container {
                width: 95%;
                padding: 20px;
            }

            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
        <a href="<?php echo e(route('pegawai.index')); ?>">Pegawai</a>
        <a href="<?php echo e(route('organisasi.index')); ?>">Organisasi</a>
        <a href="<?php echo e(route('merchandise.index')); ?>">Merchandise</a>
        <a href="<?php echo e(route('profile.show')); ?>" class="active">Profile</a>
    </div>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">
                <i class="fas fa-user"></i> 
            </div>
            <div class="profile-info">
                <h2>Profile - ReUse Mart</h2>
                <?php if(auth()->check() && auth()->user()->role === 'admin'): ?>
                    <span class="admin-label">Admin</span>
                <?php endif; ?>
            </div>
        </div>

        <h3>Ubah Biodata diri</h3>

        <div class="profile-details">
            <strong>Nama</strong>
            <span><?php echo e($user->name ?? 'N/A'); ?></span>
            <a href="<?php echo e(route('profile.edit')); ?>" class="edit-button">ubah</a>

            <strong>Tanggal Lahir</strong>
            <span><?php echo e($user->tanggal_lahir ?? 'Tambah Tanggal Lahir'); ?></span>
            <?php if(!$user->tanggal_lahir): ?>
                <a href="<?php echo e(route('profile.edit')); ?>" class="edit-button">Tambah</a>
            <?php else: ?>
                <a href="<?php echo e(route('profile.edit')); ?>" class="edit-button">ubah</a>
            <?php endif; ?>

            <strong>Email</strong>
            <span><?php echo e($user->email ?? 'N/A'); ?></span>
            <span class="edit-button">ubah</span> 

            <strong>No Telepon</strong>
            <span><?php echo e($user->phone ?? 'Tambah Nomor HP'); ?></span>
            <?php if(!$user->phone): ?>
                <a href="<?php echo e(route('profile.edit')); ?>" class="edit-button">Tambah</a>
            <?php else: ?>
                <a href="<?php echo e(route('profile.edit')); ?>" class="edit-button">ubah</a>
            <?php endif; ?>

            <?php if(auth()->check() && auth()->user()->role === 'pembeli'): ?>
                <strong>Poin Pembeli</strong>
                <span><?php echo e($pembeliData->poin ?? '0'); ?></span>
                <span></span> 
            <?php elseif(auth()->check() && auth()->user()->role === 'penitip'): ?>
                <strong>Nomor Rekening</strong>
                <span><?php echo e($penitipData->nomor_rekening ?? 'Belum diatur'); ?></span>
                <a href="<?php echo e(route('profile.edit')); ?>" class="edit-button">ubah</a>

                <strong>Nama Bank</strong>
                <span><?php echo e($penitipData->nama_bank ?? 'Belum diatur'); ?></span>
                <a href="<?php echo e(route('profile.edit')); ?>" class="edit-button">ubah</a>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your_fontawesome_kit.js" crossorigin="anonymous"></script> 
</body>
</html>
<?php /**PATH D:\p3l\resources\views/profile.blade.php ENDPATH**/ ?>