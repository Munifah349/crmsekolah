<?php
require_once '../config/database.php';

// Jika pengguna sudah login, langsung alihkan ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: ../dashboard/index.php");
    exit;
}

$error_login = '';
$error_reg = '';
$success_reg = '';
$active_tab = 'login'; // Default tab yang terbuka

// ==========================================
// 1. PROSES LOGIN
// ==========================================
if (isset($_POST['login'])) {
    $active_tab = 'login';
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role     = $_POST['role'];

    // Validasi data pengguna
    if (!empty($username) && !empty($password) && !empty($role)) {
        $_SESSION['login']    = true;
        $_SESSION['username'] = $username;
        $_SESSION['role']     = $role;
        $_SESSION['nama']     = ($role == 'Administrator') ? 'Admin Sekolah' : (($role == 'Agent CRM') ? 'Budi Agent' : 'Petugas Resepsionis');
        
        header("Location: ../dashboard/index.php");
        exit;
    } else {
        $error_login = "Silakan lengkapi semua kolom dan pilih peran akses Anda!";
    }
}

// ==========================================
// 2. PROSES REGISTER
// ==========================================
if (isset($_POST['register'])) {
    $active_tab = 'register';
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $username_reg = trim($_POST['username_reg']);
    $password_reg = trim($_POST['password_reg']);
    $role_reg     = $_POST['role_reg'];

    if (!empty($nama_lengkap) && !empty($username_reg) && !empty($password_reg) && !empty($role_reg)) {
        // DI SINI TEMPAT QUERY INSERT DATABASE
        // Contoh: 
        // $hashed_password = password_hash($password_reg, PASSWORD_DEFAULT);
        // mysqli_query($conn, "INSERT INTO users (nama, username, password, role) VALUES ('$nama_lengkap', '$username_reg', '$hashed_password', '$role_reg')");

        $success_reg = "Pendaftaran berhasil! Akun Anda telah dibuat, silakan Masuk.";
        $active_tab = 'login'; // Arahkan kembali ke tab login setelah sukses
    } else {
        $error_reg = "Harap lengkapi seluruh formulir pendaftaran!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Pendaftaran - Sistem CRM & Kunjungan</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #F8F9FA;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .wrapper-center {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 12px;
        }
        .btn-custom {
            background-color: #4a628a;
            color: white;
            transition: 0.2s;
        }
        .btn-custom:hover {
            background-color: #3b5074;
            color: white;
        }
        /* Custom Styling untuk Tab Navigasi */
        .nav-pills .nav-link {
            color: #4a628a;
            border-radius: 50px;
            padding: 8px 25px;
            font-size: 13px;
            font-weight: 600;
        }
        .nav-pills .nav-link.active {
            background-color: #4a628a;
            color: white;
        }
    </style>
</head>
<body>

    <div class="wrapper-center">
        <div class="card login-card shadow-lg bg-white p-4">
            <div class="card-body">
                
                <!-- HEADER LOGO & JUDUL -->
                <div class="text-center mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2" style="width: 55px; height: 55px; background-color: #dbe4f0; color: #4a628a; font-size: 26px;">
                        📈
                    </div>
                    <h5 class="fw-bold text-dark mb-1">CRM & Buku Tamu</h5>
                    <span class="text-muted" style="font-size: 12px;">Sistem Informasi Terpadu Sekolah</span>
                </div>

                <!-- NAVIGASI TAB (LOGIN / REGISTER) -->
                <ul class="nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo ($active_tab == 'login') ? 'active' : ''; ?>" id="tab-login" data-bs-toggle="pill" data-bs-target="#content-login" type="button" role="tab">Masuk</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo ($active_tab == 'register') ? 'active' : ''; ?>" id="tab-register" data-bs-toggle="pill" data-bs-target="#content-register" type="button" role="tab">Daftar Akun</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    
                    <!-- ========================================== -->
                    <!-- TAB 1: FORM LOGIN -->
                    <!-- ========================================== -->
                    <div class="tab-pane fade <?php echo ($active_tab == 'login') ? 'show active' : ''; ?>" id="content-login" role="tabpanel">
                        
                        <?php if (!empty($error_login)): ?>
                            <div class="alert alert-danger py-2 mb-3 text-center" style="font-size: 12px;" role="alert"><?php echo $error_login; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($success_reg)): ?>
                            <div class="alert alert-success py-2 mb-3 text-center" style="font-size: 12px;" role="alert"><?php echo $success_reg; ?></div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size: 12px;">Pilih Peran Pengguna (Role)</label>
                                <select name="role" class="form-select" style="font-size: 13px;" required>
                                    <option value="" selected disabled>-- Pilih Hak Akses --</option>
                                    <option value="Administrator">👨‍💼 Administrator / Tata Usaha</option>
                                    <option value="Agent CRM">🎧 Agent CRM / Tim Follow-up</option>
                                    <option value="Petugas Resepsionis">📋 Petugas Resepsionis / Kunjungan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size: 12px;">Username / Email</label>
                                <input type="text" name="username" class="form-control" style="font-size: 13px;" placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold" style="font-size: 12px;">Kata Sandi (Password)</label>
                                <input type="password" name="password" class="form-control" style="font-size: 13px;" placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-custom w-100 py-2 fw-semibold mb-2" style="font-size: 13px;">
                                Masuk ke Sistem
                            </button>
                        </form>
                    </div>

                    <!-- ========================================== -->
                    <!-- TAB 2: FORM REGISTER -->
                    <!-- ========================================== -->
                    <div class="tab-pane fade <?php echo ($active_tab == 'register') ? 'show active' : ''; ?>" id="content-register" role="tabpanel">
                        
                        <?php if (!empty($error_reg)): ?>
                            <div class="alert alert-danger py-2 mb-3 text-center" style="font-size: 12px;" role="alert"><?php echo $error_reg; ?></div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size: 12px;">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" style="font-size: 13px;" placeholder="Contoh: Budi Santoso" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size: 12px;">Pilih Peran Pengguna (Role)</label>
                                <select name="role_reg" class="form-select" style="font-size: 13px;" required>
                                    <option value="" selected disabled>-- Pilih Hak Akses --</option>
                                    <option value="Administrator">Administrator / Tata Usaha</option>
                                    <option value="Agent CRM">Agent CRM / Tim Follow-up</option>
                                    <option value="Petugas Resepsionis">Petugas Resepsionis</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size: 12px;">Username Akun</label>
                                <input type="text" name="username_reg" class="form-control" style="font-size: 13px;" placeholder="Buat username" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold" style="font-size: 12px;">Kata Sandi (Password)</label>
                                <input type="password" name="password_reg" class="form-control" style="font-size: 13px;" placeholder="Buat password" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-success w-100 py-2 fw-semibold mb-2" style="font-size: 13px;">
                                Daftar Sekarang
                            </button>
                        </form>
                    </div>

                </div>

                <div class="text-center mt-3">
                    <span class="text-muted" style="font-size: 11px;">&copy; 2026 Sistem CRM & Kunjungan Sekolah</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>