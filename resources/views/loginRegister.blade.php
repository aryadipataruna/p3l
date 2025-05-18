<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPvNnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Login & Sign Up</title>
    <style>
        /* ... (Your existing CSS) ... */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f0f0f0; /* Light gray background */
        }
        .container {
            position: relative;
            width: 80vw; /* Adjusted width */
            height: 80vh; /* Adjusted height */
            background: #fff;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            overflow: hidden;
            border-radius: 10px; /* Added rounded corners */
        }
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #3498db, #2ecc71); /* Updated gradient colors */
            z-index: 6;
            transform: translateX(100%);
            transition: 1s ease-in-out;
        }
        .signin-signup {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 5;
        }
        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 45%; /* Adjusted width */
            min-width: 280px; /* Adjusted min-width */
            padding: 0 20px; /* Adjusted padding */
        }
        form.sign-in-form {
            opacity: 1;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }
        form.sign-up-form {
            opacity: 0;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }
        .title {
            font-size: 2.2em; /* Adjusted font size */
            color: #333; /* Darker text color */
            margin-bottom: 20px; /* Increased margin */
        }
        .input-field {
            width: 100%;
            height: 45px; /* Adjusted height */
            background: #f0f0f0;
            margin: 10px 0;
            border: none;
            border-radius: 5px; /* Adjusted border radius */
            display: flex;
            align-items: center;
            padding: 0 15px; /* Added padding */
        }
        .input-field i {
            flex: 1;
            text-align: center;
            color: #555;
            font-size: 1.1em; /* Adjusted font size */
        }
        .input-field input,
        .input-field select { /* Apply styles to select too */
            flex: 5;
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 1em; /* Adjusted font size */
            font-weight: 500;
            color: #333;
            padding: 0; /* Remove default select padding */
            -webkit-appearance: none; /* Remove default arrow */
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
        }
        .input-field select option {
            color: #333; /* Ensure option text is visible */
            background: #f0f0f0;
        }

        /* Custom arrow for select */
        .input-field i.select-arrow {
            flex: none; /* Don't let the arrow take up flex space */
            width: 30px; /* Adjust width as needed */
            pointer-events: none; /* Allow clicks to pass through to select */
            text-align: center;
        }

        .btn {
            width: 120px; /* Adjusted width */
            height: 40px; /* Adjusted height */
            border: none;
            border-radius: 5px; /* Adjusted border radius */
            background: #3498db; /* Primary button color */
            color: #fff;
            font-weight: 600;
            margin: 15px 0; /* Adjusted margin */
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Added subtle shadow */
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background: #2980b9; /* Darker shade on hover */
        }
        a {
            text-decoration: none;
            color: #555;
            font-size: 0.9em;
        }
        a:hover {
            text-decoration: underline;
        }
        .panels-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 35%;
            min-width: 250px; /* Adjusted min-width */
            padding: 0 20px; /* Adjusted padding */
            text-align: center;
            z-index: 6;
        }
        .left-panel {
            pointer-events: none;
        }
        .content {
            color: #fff;
            transition: 1.1s ease-in-out;
            transition-delay: 0.5s;
        }
        .panel h3 {
            font-size: 1.8em; /* Adjusted font size */
            font-weight: 600;
            margin-bottom: 10px;
        }
        .panel p {
            font-size: 0.95em; /* Adjusted font size */
            padding: 10px 0;
            line-height: 1.6; /* Improved readability */
        }
        .image {
            width: 100%;
            max-width: 200px; /* Adjusted max width */
            transition: 1.1s ease-in-out;
            transition-delay: 0.4s;
        }
        .left-panel .image,
        .left-panel .content {
            transform: translateX(-200%);
        }
        .right-panel .image,
        .right-panel .content {
            transform: translateX(0);
        }
        .account-text {
            display: none;
        }
        /* Animation */
        .container.sign-up-mode::before {
            transform: translateX(0);
        }
        .container.sign-up-mode .right-panel .image,
        .container.sign-up-mode .right-panel .content {
            transform: translateX(200%);
        }
        .container.sign-up-mode .left-panel .image,
        .container.sign-up-mode .left-panel .content {
            transform: translateX(0);
        }
        .container.sign-up-mode form.sign-in-form {
            opacity: 0;
        }
        .container.sign-up-mode form.sign-up-form {
            opacity: 1;
        }
        .container.sign-up-mode .right-panel {
            pointer-events: none;
        }
        .container.sign-up-mode .left-panel {
            pointer-events: all;
        }
        /* Responsive */
        @media (max-width: 870px) {
            .container {
                width: 100vw;
                height: 100vh;
            }
            .signin-signup {
                flex-direction: column;
            }
            form {
                width: 80%;
            }
            .panels-container {
                display: none;
            }
            .account-text {
                display: initial;
                margin-top: 30px;
                text-align: center;
            }
        }
        @media (max-width: 480px) {
            form {
                width: 90%;
            }
            .input-field {
                height: 40px;
                margin: 8px 0;
            }
            .btn {
                height: 35px;
                font-size: 0.9em;
                margin: 10px 0;
            }
            .title {
                font-size: 2em;
                margin-bottom: 15px;
            }
            .account-text {
                font-size: 0.85em;
            }
        }

        /* Change Password Styling */
        .change-password-link {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
        .change-password-modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 7; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .change-password-modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 400px; /* Limit max width */
            border-radius: 5px;
            position: relative;
        }
        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .change-password-form {
            display: flex;
            flex-direction: column;
        }
        .change-password-form .input-field {
            margin-bottom: 15px;
        }
        .change-password-form .btn {
            margin-top: 20px;
            align-self: center; /* Center the button */
        }
         .change-password-modal-content h2 {
            text-align: center;
            margin-bottom: 20px;
         }

         /* Success Message Styling */
         .signup-success-message {
             position: fixed;
             top: 50%;
             left: 50%;
             transform: translate(-50%, -50%);
             background-color: #4CAF50; /* Green background */
             color: white;
             padding: 20px;
             border-radius: 5px;
             z-index: 8; /* Higher than the modal */
             text-align: center;
             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
             display: none; /* Hidden by default */
         }
         .signup-success-message p {
             margin-bottom: 10px;
         }
         .signup-success-message .btn-ok {
             background-color: #388E3C;
             color: white;
             border: none;
             padding: 10px 20px;
             text-align: center;
             text-decoration: none;
             display: inline-block;
             font-size: 16px;
             border-radius: 3px;
             cursor: pointer;
             transition: background-color 0.3s ease;
         }
         .signup-success-message .btn-ok:hover {
             background-color: #1E7E34;
         }
    </style>
</head>
<body>
    <div class="container">
        <div class="signin-signup">
            {{-- Login Form --}}
            <form action="{{ route('login') }}" method="POST" class="sign-in-form">
                @csrf
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    {{-- Placeholder updated to suggest ID or Email --}}
                    <input type="text" name="login_identifier" placeholder="ID / Email" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" value="Login" class="btn">
                <a href="#" class="change-password-link" id="open-change-password">Forgot Password?</a>
                <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
            </form>

            {{-- Sign Up Form --}}
            {{-- The form action and input names will be set dynamically by JavaScript based on the selected role --}}
            <form action="" method="POST" class="sign-up-form" id="signupForm">
                 @csrf
                 <h2 class="title">Sign up</h2>

                 <div class="input-field">
                     <i class="fas fa-user"></i>
                     <input type="text" name="generic_name" placeholder="Nama Lengkap" required data-generic-name="name">
                 </div>

                 <div class="input-field">
                     <i class="fas fa-envelope"></i>
                     <input type="email" name="generic_email" placeholder="Email" required data-generic-name="email">
                 </div>

                 {{-- Role Selection Dropdown for Sign Up --}}
                 <div class="input-field">
                     <i class="fas fa-user-tag"></i>
                     <select name="role" id="signup-role-select" required>
                         <option value="" disabled selected>Pilih Role</option>
                         <option value="pembeli">Pembeli</option>
                         <option value="organisasi">Organisasi</option>
                         <option value="owner">Owner</option>
                         <option value="penitip">Penitip</option>
                         <option value="cs">Cs</option>
                         <option value="admin">Admin</option>
                         <option value="pegawaiGudang">Pegawai Gudang</option>
                         {{-- Pegawai and Penitip roles typically not available for public sign-up --}}
                         {{-- <option value="pegawaiGudang">Pegawai Gudang</option> --}}
                         {{-- <option value="penitip">Penitip</option> --}}
                         {{-- <option value="owner">Owner</option> --}}
                         {{-- <option value="pembeli">Pembeli</option> --}}
                         {{-- <option value="cs">CS</option> --}}
                         {{-- <option value="organisasi">Organisasi</option> --}}
                         {{-- <option value="admin">Admin
			 </option> --}}
                     </select>
                     <i class="fas fa-chevron-down select-arrow"></i> {{-- Custom arrow --}}
                 </div>

                 <div class="input-field">
                     <i class="fas fa-phone"></i>
                     <input type="text" name="generic_phone" placeholder="Nomor Telepon" required data-generic-name="phone">
                 </div>

                 <div class="input-field">
                     <i class="fas fa-map-marker-alt"></i>
                     <input type="text" name="generic_address" placeholder="Alamat" required data-generic-name="address">
                 </div>

                 <div class="input-field">
                     <i class="fas fa-lock"></i>
                     <input type="password" name="generic_password" placeholder="Password" required data-generic-name="password">
                 </div>

                 {{-- Add hidden inputs for default values for nullable fields --}}
                 {{-- These will be updated by JavaScript based on the role --}}
                 <input type="hidden" name="generic_poin" value="0" data-generic-name="poin">
                 <input type="hidden" name="generic_saldo" value="0" data-generic-name="saldo">


                 <button type="submit" class="btn" id="signupSubmitBtn">Sign Up</button>
                 <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Sudah punya akun?</h3>
                    <p>Masuk untuk melanjutkan pengalaman berbelanja Anda!</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="signin.svg" alt="Sign In Illustration" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Belum punya akun?</h3>
                    <p>Daftar sekarang dan temukan barang-barang unik di ReUse Mart!</p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="signup.svg" alt="Sign Up Illustration" class="image">
            </div>
        </div>
    </div>

    {{-- Change Password Modal --}}
    <div id="change-password-modal" class="change-password-modal">
        <div class="change-password-modal-content">
            <span class="close-button" id="close-change-password">&times;</span>
            <h2 class="title">Reset Password</h2>
            <p style="text-align: center; margin-bottom: 15px;">Enter your email address to receive a password reset link.</p>
            {{-- This form still uses the standard Laravel password reset route, which assumes email --}}
            <form class="change-password-form" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <button type="submit" class="btn">Send Reset Link</button>
            </form>
        </div>
    </div>

    {{-- Success Message After Sign Up --}}
    <div id="signup-success-message" class="signup-success-message">
        <p id="signup-success-text"></p>
        <button class="btn-ok" id="ok-btn">OK</button>
    </div>

    <script>
        // Get references to DOM elements
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");
        const sign_in_btn2 = document.querySelector("#sign-in-btn2");
        const sign_up_btn2 = document.querySelector("#sign-up-btn2");
        const signupForm = document.querySelector("#signupForm");
        const signupSubmitBtn = document.querySelector("#signupSubmitBtn");
        const signupSuccessMessage = document.getElementById("signup-success-message");
        const signupSuccessText = document.getElementById("signup-success-text");
        const okBtn = document.getElementById("ok-btn");

        // Get references for Sign Up form
        const signupRoleSelect = document.querySelector("#signup-role-select");
        const signUpInputs = signupForm.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], input[type="hidden"]');

        // Get references for Change Password Modal
        const changePasswordModal = document.getElementById("change-password-modal");
        const openChangePasswordBtn = document.getElementById("open-change-password");
        const closeChangePasswordBtn = document.getElementById("close-change-password");

        // --- Sign Up Form Logic ---
        function updateSignUpForm() {
            const selectedRole = signupRoleSelect.value;
            let registrationRoute = '';
            let nameMapping = {};

            switch (selectedRole) {
                case 'pembeli':
                    registrationRoute = '{{ route("pembeli.store") }}';
                    nameMapping = {
                        'name': 'NAMA_PEMBELI',
                        'email': 'EMAIL_PEMBELI',
                        'password': 'PASSWORD_PEMBELI',
                        'phone': 'NO_PEMBELI',
                        'address': 'ALAMAT_PEMBELI',
                        'poin': 'POIN_PEMBELI',
                        'saldo': 'SALDO_PEMBELI'
                    };
                    break;
                case 'organisasi':
                    registrationRoute = '{{ route("organisasi.store") }}';
                    nameMapping = {
                        'name': 'NAMA_ORGANISASI',
                        'email': 'EMAIL_ORGANISASI',
                        'phone': 'NOTELP_ORGANISASI',
                        'address': 'ALAMAT_ORGANISASI',
                        'password': 'PASSWORD_ORGANISASI',
                        'poin': 'POIN_ORGANISASI',
                        'saldo': 'SALDO_ORGANISASI'
                    };
                    break;
                case 'owner':
                    registrationRoute = '{{ route("owner.store") }}';
                    nameMapping = {
                        'name': 'NAMA_OWNER',
                        'email': 'EMAIL_OWNER',
                        'password': 'PASSWORD_OWNER',
                        'phone': 'NOTELP_OWNER',
                        'address': 'ALAMAT_OWNER',
                        'poin': null,
                        'saldo': null
                    };
                    break;
                case 'penitip':
                    registrationRoute = '{{ route("penitip.store") }}';
                    nameMapping = {
                        'name': 'NAMA_PENITIP',
                        'email': null, // Penitip might not have email
                        'password': 'PASSWORD_PENITIP',
                        'phone': 'NOTELP_PENITIP',
                        'address': 'ALAMAT_PENITIP',
                        'poin': null,
                        'saldo': null
                    };
                    break;
                case 'cs':
                    registrationRoute = '{{ route("cs.store") }}';
                    nameMapping = {
                        'name': 'NAMA_CS',
                        'email': 'EMAIL_CS',
                        'password': 'PASSWORD_CS',
                        'phone': 'NOTELP_CS',
                        'address': 'ALAMAT_CS',
                        'poin': null,
                        'saldo': null
                    };
                    break;
                case 'admin':
                    registrationRoute = '{{ route("admin.store") }}';
                    nameMapping = {
                        'name': 'NAMA_ADMIN',
                        'email': 'EMAIL_ADMIN',
                        'password': 'PASSWORD_ADMIN',
                        'phone': 'NOTELP_ADMIN',
                        'address': 'ALAMAT_ADMIN',
                        'poin': null,
                        'saldo': null
                    };
                    break;
                case 'pegawaiGudang':
                    registrationRoute = '{{ route("pegawai.store") }}';
                    nameMapping = {
                        'name': 'NAMA_PEGAWAI',
                        'email': 'EMAIL_PEGAWAI',
                        'password': 'PASSWORD_PEGAWAI',
                        'phone': 'NOTELP_PEGAWAI',
                        'address': 'ALAMAT_PEGAWAI',
                        'poin': null,
                        'saldo': null
                    };
                    break;
                default:
                    registrationRoute = '';
                    nameMapping = {};
            }

            signupForm.action = registrationRoute;

            signUpInputs.forEach(input => {
                const genericName = input.getAttribute('data-generic-name');
                if (genericName && nameMapping[genericName]) {
                    input.name = nameMapping[genericName];
                } else {
                    input.name = genericName ? 'generic_' + genericName : '';
                }

                if (input.type === 'hidden') {
                    const specificName = input.name;
                    if (specificName && (specificName.toUpperCase().includes('POIN_') || specificName.toUpperCase().includes('SALDO_'))) {
                        input.value = '0';
                    }
                }

                // Disable/enable and clear/require email based on role
                if (genericName === 'email') {
                    if (nameMapping['email'] === null) {
                        input.disabled = true;
                        input.value = '';
                        input.required = false;
                    } else {
                        input.disabled = false;
                        input.required = true;
                    }
                }
            });
        }

        // Add event listener to the Sign Up role select
        signupRoleSelect.addEventListener("change", updateSignUpForm);
        updateSignUpForm(); // Initial call

        // --- Handle Sign Up Form Submission ---
        signupForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);
            const selectedRole = signupRoleSelect.value;

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure CSRF token is sent
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    signupSuccessText.textContent = `Berhasil mendaftar sebagai ${selectedRole}.`;
                    signupSuccessMessage.style.display = 'block';
                    container.classList.remove("sign-up-mode"); // Go back to sign in
                    // Optionally reset the sign-up form
                    signupForm.reset();
                    signupRoleSelect.value = "";
                    updateSignUpForm();
                } else if (data.errors) {
                    // Handle validation errors - display them in the form
                    // Example:
                    let errorMessages = '';
                    for (const key in data.errors) {
                        errorMessages += `${data.errors[key].join(', ')}\n`;
                    }
                    alert('Gagal mendaftar:\n' + errorMessages);
                } else {
                    alert('Gagal mendaftar. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi nanti.');
            });
        });

        // --- Close Success Message ---
        okBtn.addEventListener('click', () => {
            signupSuccessMessage.style.display = 'none';
        });

        // --- Panel Sliding Animation Logic (Same as before) ---
        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

        // Mobile view buttons
        sign_up_btn2.addEventListener("click", () => {
            container.classList.add("sign-up-mode2");
        });

        sign_in_btn2.addEventListener("click", () => {
            container.classList.remove("sign-up-mode2");
        });

        // --- Change Password Modal Logic ---
        openChangePasswordBtn.addEventListener("click", (e) => {
            e.preventDefault(); // Prevent default link behavior
            changePasswordModal.style.display = "block";
        });

        closeChangePasswordBtn.addEventListener("click", () => {
            changePasswordModal.style.display = "none";
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener("click", (event) => {
            if (event.target == changePasswordModal) {
                changePasswordModal.style.display = "none";
            }
        });
    </script>
</body>
</html>
