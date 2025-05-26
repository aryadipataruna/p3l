<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - ReUseMart</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <style>
        body {
            background: #181818;
            font-family: 'Poppins', sans-serif;
        }
        .container-auth {
            display: flex;
            width: 900px;
            margin: 40px auto;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 20px 0 #0006;
        }
        .auth-left, .auth-right {
            width: 50%;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: #222;
        }
        .auth-left {
            background: linear-gradient(135deg,#7B7B7B,#222);
            color: #fff;
        }
        .auth-right {
            background: #111;
            color: #CAAD7B;
            position: relative;
        }
        .auth-title {
            font-size: 2.5rem;
            margin-bottom: 32px;
            color: #CAAD7B;
            font-weight: bold;
        }
        .btn-auth {
            background: #CAAD7B;
            color: #111;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            padding: 12px 48px;
            margin-top: 24px;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-auth:hover {
            background: #b3935c;
        }
        .form-auth {
            width: 80%;
            max-width: 340px;
            display: flex;
            flex-direction: column;
        }
        .input-group-auth {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
            border: 1.5px solid #CAAD7B;
            background: #181818;
            border-radius: 8px;
            overflow: hidden;
        }
        .input-group-auth img {
            width: 32px;
            height: 32px;
            margin: 0 16px;
        }
        .input-group-auth select,
        .input-group-auth input {
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            font-size: 1rem;
            flex: 1;
            padding: 12px 8px;
        }
        .input-group-auth select option {
            color: #111;
        }
        .form-link {
            color: #CAAD7B;
            cursor: pointer;
            margin-top: 10px;
            text-align: right;
            font-size: 0.98rem;
        }
        .form-link:hover { text-decoration: underline; }
        .error-msg, .success-msg {
            color: #e06666;
            background: #fff3;
            border-radius: 7px;
            padding: 6px 10px;
            margin-bottom: 12px;
            font-size: 0.98rem;
            text-align: center;
        }
        .success-msg { color: #3ac569; background: #353; }
        .hidden { display: none !important; }
        @media (max-width:900px) {
            .container-auth { flex-direction: column; width: 98vw;}
            .auth-left, .auth-right { width: 100%; min-height: 340px;}
            .auth-right { padding-bottom: 40px;}
        }
    </style>
</head>
<body>
    <div class="container-auth">
        <!-- Kiri: Welcome/Login/Register Panel -->
        <div class="auth-left" id="panel-welcome">
            <h2 class="auth-title" id="welcome-title">Welcome Back!</h2>
            <button class="btn-auth" onclick="showRegister()">SIGN UP</button>
            <div style="margin-top:12px; color:#CAAD7B; font-size:0.95rem;">User</div>
        </div>
        <!-- Kanan: Login/Register/Forgot Form -->
        <div class="auth-right" id="panel-form">
            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}" class="form-auth" id="form-login">
                @csrf
                <div class="auth-title" style="text-align:center;">Login</div>
                <div id="errorLogin" class="error-msg hidden"></div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/Email.png') }}" alt="Email">
                    <input type="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/Password.png') }}" alt="Password">
                    <input type="password" name="password" placeholder="Masukkan kata sandi Anda" required>
                </div>
                <div class="form-link" onclick="showForgot()">Lupa Password?</div>
                <button type="submit" class="btn-auth">LOGIN</button>
            </form>
            <!-- REGISTER FORM -->
            <form method="POST" action="" class="form-auth hidden" id="form-register">
                @csrf
                <div class="auth-title" style="text-align:center;">Create Account</div>
                <div id="errorRegister" class="error-msg hidden"></div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/User.png') }}" alt="Nama">
                    <input type="text" name="generic_name" placeholder="Nama Lengkap" required data-generic-name="name">
                </div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/Email.png') }}" alt="Email">
                    <input type="email" name="generic_email" placeholder="Email" required data-generic-name="email">
                </div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/Cart.png') }}" alt="Role">
                    <select name="role" id="role-select" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                        <option value="pegawaigudang">Pegawai Gudang</option>
                        <option value="pembeli">Pembeli</option>
                        <option value="penitip">Penitip</option>
                        <option value="cs">CS</option>
                        <option value="organisasi">Organisasi</option>
                        <option value="hunter">Hunter</option>
                        <option value="kurir">Kurir</option>
                    </select>
                </div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/User.png') }}" alt="NoTelepon">
                    <input type="text" name="generic_phone" placeholder="Nomor Telepon" required data-generic-name="phone">
                </div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/HomeBtn.png') }}" alt="Alamat">
                    <input type="text" name="generic_address" placeholder="Alamat" required data-generic-name="address">
                </div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/Password.png') }}" alt="Password">
                    <input type="password" name="generic_password" placeholder="Password" required data-generic-name="password">
                </div>
                <div class="input-group-auth">
                    <img src="{{ asset('images/Password.png') }}" alt="Confirm">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>
                <input type="hidden" name="generic_poin" value="0" data-generic-name="poin">
                <input type="hidden" name="generic_saldo" value="0" data-generic-name="saldo">
                <button type="submit" class="btn-auth">SIGN UP</button>
                <div class="form-link" onclick="showLogin()">Sudah punya akun? Login</div>
            </form>
            <!-- FORGOT PASSWORD FORM -->
            <form method="POST" action="" class="form-auth hidden" id="form-forgot">
                @csrf
                <div class="auth-title" style="text-align:center;">Reset Password</div>
                <div id="forgot-options" style="margin-bottom:16px;">
                    <select id="forgot-role" style="width:100%;padding:8px;border-radius:6px;border:1.5px solid #CAAD7B;">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                        <option value="pegawaigudang">Pegawai Gudang</option>
                        <option value="cs">CS</option>
                        <option value="pembeli">Pembeli</option>
                        <option value="penitip">Penitip</option>
                        <option value="organisasi">Organisasi</option>
                    </select>
                </div>
                <div id="forgot-form-content"></div>
                <div class="form-link" onclick="showLogin()">Kembali ke login</div>
            </form>
        </div>
    </div>
    <script>
        // ----------------- Show/Hide Panels & Forms
        function showLogin() {
            document.getElementById('form-login').classList.remove('hidden');
            document.getElementById('form-register').classList.add('hidden');
            document.getElementById('form-forgot').classList.add('hidden');
            document.getElementById('panel-welcome').style.display = '';
        }
        function showRegister() {
            document.getElementById('form-login').classList.add('hidden');
            document.getElementById('form-register').classList.remove('hidden');
            document.getElementById('form-forgot').classList.add('hidden');
            document.getElementById('panel-welcome').style.display = 'none';
        }
        function showForgot() {
            document.getElementById('form-login').classList.add('hidden');
            document.getElementById('form-register').classList.add('hidden');
            document.getElementById('form-forgot').classList.remove('hidden');
            document.getElementById('panel-welcome').style.display = 'none';
        }
        showLogin();

        // --------- Lupa Password Option Dynamic (Email atau Tanggal Lahir)
        document.getElementById('forgot-role').addEventListener('change', function() {
            let role = this.value;
            let div = document.getElementById('forgot-form-content');
            div.innerHTML = '';
            if(['pembeli','penitip','organisasi'].includes(role)) {
                // Email Link
                div.innerHTML = `
                <div class="input-group-auth" style="margin-bottom:16px;">
                    <img src="{{ asset('images/Email.png') }}" alt="Email">
                    <input type="email" id="forgot-email" placeholder="Masukkan email Anda" required>
                </div>
                <button type="button" class="btn-auth" onclick="submitForgotEmail('${role}')">Continue</button>
                `;
            } else if(['owner','admin','pegawaigudang','cs'].includes(role)) {
                // Datepicker
                div.innerHTML = `
                <div class="input-group-auth" style="margin-bottom:16px;">
                    <img src="{{ asset('images/User.png') }}" alt="TanggalLahir">
                    <input type="date" id="forgot-date" placeholder="Pilih tanggal lahir" required>
                </div>
                <button type="button" class="btn-auth" onclick="submitForgotDate('${role}')">Continue</button>
                `;
            }
        });

        // -------------- LOGIC REGISTER (dinamis berdasarkan role)
        const registerForm = document.getElementById('form-register');
        const roleSelect = document.getElementById('role-select');
        const registerInputs = registerForm.querySelectorAll('input, select');
        roleSelect.addEventListener('change', function() {
            let role = this.value;
            let action = '';
            let nameMap = {};
            switch(role) {
                case 'owner': action = '/api/owner/register'; nameMap = { name:'NAMA_OWNER', email:'EMAIL_OWNER', phone:'NO_OWNER', address:'ALAMAT_OWNER', password:'PASSWORD_OWNER'}; break;
                case 'admin': action = '/api/admin/register'; nameMap = { name:'NAMA_ADMIN', email:'EMAIL_ADMIN', phone:'NO_ADMIN', address:'ALAMAT_ADMIN', password:'PASSWORD_ADMIN'}; break;
                case 'pegawaigudang': action = '/api/pegawai/register'; nameMap = { name:'NAMA_PEGAWAI', email:'EMAIL_PEGAWAI', phone:'NO_PEGAWAI', address:'ALAMAT_PEGAWAI', password:'PASSWORD_PEGAWAI'}; break;
                case 'pembeli': action = '/api/pembeli/register'; nameMap = { name:'NAMA_PEMBELI', email:'EMAIL_PEMBELI', phone:'NO_PEMBELI', address:'ALAMAT_PEMBELI', password:'PASSWORD_PEMBELI', poin:'POIN_PEMBELI'}; break;
                case 'penitip': action = '/api/penitip/register'; nameMap = { name:'NAMA_PENITIP', email:'EMAIL_PENITIP', phone:'NO_PENITIP', address:'ALAMAT_PENITIP', password:'PASSWORD_PENITIP', poin:'POIN_PENITIP'}; break;
                case 'cs': action = '/api/cs/register'; nameMap = { name:'NAMA_CS', email:'EMAIL_CS', phone:'NO_CS', address:'ALAMAT_CS', password:'PASSWORD_CS'}; break;
                case 'organisasi': action = '/api/organisasi/register'; nameMap = { name:'NAMA_ORGANISASI', email:'EMAIL_ORGANISASI', phone:'NOTELP_ORGANISASI', address:'ALAMAT_ORGANISASI', password:'PASSWORD_ORGANISASI'}; break;
                case 'hunter': action = '/api/hunter/register'; nameMap = { name:'NAMA_HUNTER', email:'EMAIL_HUNTER', phone:'NO_HUNTER', address:'ALAMAT_HUNTER', password:'PASSWORD_HUNTER'}; break;
                case 'kurir': action = '/api/kurir/register'; nameMap = { name:'NAMA_KURIR', email:'EMAIL_KURIR', phone:'NO_KURIR', address:'ALAMAT_KURIR', password:'PASSWORD_KURIR'}; break;
            }
            registerForm.action = action;
            registerInputs.forEach(input => {
                let generic = input.getAttribute('data-generic-name');
                if(generic && nameMap[generic]) input.name = nameMap[generic];
            });
        });

        // -------- SUBMIT REGISTER via AJAX
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('errorRegister').classList.add('hidden');
            let fd = new FormData(registerForm);
            let data = {};
            for (let [k, v] of fd.entries()) data[k] = v;
            if (data[Object.keys(data).find(k => k.toLowerCase().includes('password'))] !== data['password_confirmation']) {
                document.getElementById('errorRegister').textContent = "Password tidak cocok!";
                document.getElementById('errorRegister').classList.remove('hidden');
                return;
            }
            fetch(registerForm.action, {
                method: "POST",
                headers: { "Accept": "application/json", "Content-Type": "application/json" },
                body: JSON.stringify(data)
            })
            .then(r => r.json())
            .then(res => {
                if(res.status || res.success) {
                    alert('Registrasi berhasil! Silakan login.');
                    showLogin();
                } else {
                    document.getElementById('errorRegister').textContent = (res.message || "Register gagal");
                    document.getElementById('errorRegister').classList.remove('hidden');
                }
            })
            .catch(() => {
                document.getElementById('errorRegister').textContent = "Gagal koneksi ke server.";
                document.getElementById('errorRegister').classList.remove('hidden');
            });
        });

        // -------- SUBMIT LOGIN via AJAX
        document.getElementById('form-login').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('errorLogin').classList.add('hidden');
            let fd = new FormData(this);
            let data = { email: fd.get('email'), password: fd.get('password') };
            fetch(this.action, {
                method: "POST",
                headers: { "Accept": "application/json", "Content-Type": "application/json" },
                body: JSON.stringify(data)
            })
            .then(r => r.json())
            .then(res => {
                if(res.success || res.status) {
                    // Simpan token jika ada
                    if(res.data && res.data.token) localStorage.setItem('api_token', res.data.token);
                    let role = (res.data && res.data.role) ? res.data.role : null;
                    // Redirect ke halaman role
                    switch(role) {
                        case "owner": window.location.href = "/dashboardOwner"; break;
                        case "admin": window.location.href = "/adminPagePegawai"; break;
                        case "pegawaigudang": window.location.href = "/dashboardGudang"; break;
                        case "pembeli": window.location.href = "/home"; break;
                        case "penitip": window.location.href = "/penitipDashboard"; break;
                        case "cs": window.location.href = "/dashboardCS"; break;
                        case "organisasi": window.location.href = "/organisasiDashboard"; break;
                        case "hunter": window.location.href = "/dashboardHunter"; break;
                        case "kurir": window.location.href = "/dashboardKurir"; break;
                        default: window.location.href = "/dashboard";
                    }
                } else {
                    document.getElementById('errorLogin').textContent = res.message || "Login gagal";
                    document.getElementById('errorLogin').classList.remove('hidden');
                }
            })
            .catch(() => {
                document.getElementById('errorLogin').textContent = "Gagal koneksi ke server.";
                document.getElementById('errorLogin').classList.remove('hidden');
            });
        });

        // --------- SUBMIT FORGOT EMAIL (Customer)
        window.submitForgotEmail = function(role) {
            let email = document.getElementById('forgot-email').value;
            fetch(`/api/${role}/forgot-password`, {
                method:"POST",
                headers:{ "Accept":"application/json","Content-Type":"application/json" },
                body:JSON.stringify({email})
            }).then(r=>r.json())
            .then(res=>{
                alert(res.message || "Silakan cek email Anda!");
                showLogin();
            }).catch(()=>alert("Gagal reset password!"));
        }
        // --------- SUBMIT FORGOT DATE (Internal)
        window.submitForgotDate = function(role) {
            let tgl = document.getElementById('forgot-date').value;
            fetch(`/api/${role}/reset-password`, {
                method:"POST",
                headers:{ "Accept":"application/json","Content-Type":"application/json" },
                body:JSON.stringify({tanggal_lahir:tgl})
            }).then(r=>r.json())
            .then(res=>{
                alert(res.message || "Password berhasil direset.");
                showLogin();
            }).catch(()=>alert("Gagal reset password!"));
        }
    </script>
</body>
</html>
