<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>signin-signup</title>
    <style>
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
            background: #444;
        }
        .container {
            position: relative;
            width: 100vw;
            height: 100vh;
            background: #fff;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #8576FF, #7BC9FF);
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
            width: 40%;
            min-width: 238px;
            padding: 0 10px;
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
            font-size: 35px;
            color: #8576FF;
            margin-bottom: 10px;
        }
        .input-field {
            width: 100%;
            height: 50px;
            background: #f0f0f0;
            margin: 10px 0;
            border: 2px solid #8576FF;
            border-radius: 50px;
            display: flex;
            align-items: center;
        }
        .input-field i {
            flex: 1;
            text-align: center;
            color: #666;
            font-size: 18px;
        }
        .input-field input {
            flex: 5;
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            color: #444;
        }
        .btn {
            width: 150px;
            height: 50px;
            border: none;
            border-radius: 50px;
            background: #8576FF;
            color: #fff;
            font-weight: 600;
            margin: 10px 0;
            text-transform: uppercase;
            cursor: pointer;
        }
        .btn:hover {
            background: #6b60c4;
        }
        a {
            text-decoration: none;
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
            min-width: 238px;
            padding: 0 10px;
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
            font-size: 24px;
            font-weight: 600;
        }
        .panel p {
            font-size: 15px;
            padding: 10px 0;
        }
        .image {
            width: 100%;
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
        /*Animation*/
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
        /*Responsive*/
        @media (max-width:779px) {
            .container {
                width: 100vw;
                height: 100vh;
            }
        }
        @media (max-width:635px) {
            .container::before {
                display: none;
            }
            form {
                width: 80%;
            }
            form.sign-up-form {
                display: none;
            }
            .container.sign-up-mode2 form.sign-up-form {
                display: flex;
                opacity: 1;
            }
            .container.sign-up-mode2 form.sign-in-form {
                display: none;
            }
            .panels-container {
                display: none;
            }
            .account-text {
                display: initial;
                margin-top: 30px;
            }
        }
        @media (max-width:320px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="signin-signup">
            {{-- Update action to your login route --}}
            <form action="{{ route('login') }}" method="POST" class="sign-in-form">
                {{-- Include CSRF token for security if using Laravel Blade --}}
                @csrf
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    {{-- Assuming your LoginController expects 'email' for login --}}
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                {{-- Add a checkbox for 'remember' if your LoginController uses it --}}
                {{-- <div class="input-field" style="border: none; background: none; margin-bottom: 0;">
                     <input type="checkbox" name="remember" id="remember" style="width: auto; flex: none; margin-right: 5px;">
                     <label for="remember" style="color: #444; font-weight: normal; font-size: 1rem;">Remember Me</label>
                 </div> --}}
                <input type="submit" value="Login" class="btn">
                <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
            </form>

 {{-- The form action will be set dynamically by JavaScript based on the selected role --}}
            <form action="" method="POST" class="sign-up-form">
                 {{-- Include CSRF token for security if using Laravel Blade --}}
                 @csrf
                <h2 class="title">Sign up</h2>

                <div class="input-field">
                    <i class="fas fa-user"></i>
                    {{-- Name field - adjust name attribute based on what your backend expects --}}
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                </div>

                 <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    {{-- Email field - adjust name attribute based on what your backend expects --}}
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                 <div class="input-field">
                    {{-- Icon for role selection --}}
                    <i class="fas fa-user-tag"></i>
                    {{-- Role selection dropdown --}}
                    <select name="role" id="role-select" required>
                        <option value="" disabled selected>Pilih Role</option> {{-- Default disabled option --}}
                        <option value="pembeli">Pembeli</option>
                        <option value="penitip">Penitip</option>
                    </select>
                </div>

                <div class="input-field">
                    <i class="fas fa-phone"></i>
                     {{-- Phone Number field - adjust name attribute based on what your backend expects --}}
                    <input type="text" name="phone" placeholder="Nomor Telepon" required>
                </div>

                <div class="input-field">
                    <i class="fas fa-map-marker-alt"></i>
                     {{-- Address field - adjust name attribute based on what your backend expects --}}
                    <input type="text" name="address" placeholder="Alamat" required>
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                     {{-- Password field - adjust name attribute based on what your backend expects --}}
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                 {{-- Password confirmation is typically handled in the backend validation --}}
                 {{-- If your backend expects it from the form, uncomment and add name="password_confirmation" --}}
                 {{-- <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div> --}}

                 {{-- You might need hidden inputs for default values for nullable fields
                      depending on the selected role and your backend logic. --}}
                 {{-- Example for Pembeli: <input type="hidden" name="POIN_PEMBELI" value="0"> --}}


                <input type="submit" value="Sign Up" class="btn"> {{-- Changed button text back to Sign Up --}}
                 <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Sudah punya akun?</h3>
                    <p>Masuk untuk melanjutkan pengalaman berbelanja Anda!</p> <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
                <img src="signin.svg" alt="Sign In Illustration" class="image"> </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Belum punya akun?</h3>
                    <p>Daftar sekarang dan temukan barang-barang unik di ReUse Mart!</p> <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
                <img src="signup.svg" alt="Sign Up Illustration" class="image"> </div>
        </div>
    </div>

    <script>
        // Get references to DOM elements
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");
        const sign_in_btn2 = document.querySelector("#sign-in-btn2");
        const sign_up_btn2 = document.querySelector("#sign-up-btn2");

        // Get references to the sign-up form and the role select dropdown
        const signUpForm = document.querySelector(".sign-up-form");
        const roleSelect = document.querySelector("#role-select");

        // Function to update the form action based on the selected role
        function updateSignUpFormAction() {
            const selectedRole = roleSelect.value;
            let registrationRoute = '';

            // Determine the registration route based on the selected role
            switch (selectedRole) {
                case 'pembeli':
                    registrationRoute = '{{ route("pembeli.store") }}'; // Use the named route for pembeli registration
                    break;
                case 'organisasi':
                    registrationRoute = '{{ route("organisasi.store") }}'; // Use the named route for organisasi registration
                    break;
                default:
                    // Set a default or handle the case where no role is selected
                    registrationRoute = ''; // Or a default registration route if applicable
            }

            // Update the form's action attribute
            signUpForm.action = registrationRoute;
        }

        // Add event listener to the role select dropdown to update the form action on change
        roleSelect.addEventListener("change", updateSignUpFormAction);

        // Call the function initially to set the correct action based on the default selected option
        updateSignUpFormAction();


        // Event listener for the desktop "Sign up" button
        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        // Event listener for the desktop "Sign in" button
        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

        // Event listener for the mobile "Sign up" link
        sign_up_btn2.addEventListener("click", () => {
            container.classList.add("sign-up-mode2");
        });

        // Event listener for the mobile "Sign in" link
        sign_in_btn2.addEventListener("click", () => {
            container.classList.remove("sign-up-mode2");
        });

        // Note: Form submissions are now handled by the browser using the 'action' and 'method' attributes.
        // JavaScript is primarily used here for the panel switching animation and dynamically setting the form action.
        // Server-side validation and response handling will be done by your Laravel controllers.

    </script>
</body>
</html>
