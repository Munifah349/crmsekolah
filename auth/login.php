<?php
require_once '../config/database.php';

// Jika pengguna sudah login, langsung alihkan ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: ../dashboard/index.php");
    exit;
}

$error = '';

// Proses saat tombol login ditekan
if (isset($_POST['login'])) {
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
        $error = "Silakan lengkapi semua kolom dan pilih peran akses Anda!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna - Sistem CRM & Kunjungan</title>
    
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
            max-width: 400px;
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
    </style>
</head>
<body>

    <!-- WRAPPER UNTUK MEMASTIKAN POSISI TEPAT DI TENGAH -->
    <div class="wrapper-center">
        <div class="card login-card shadow-lg bg-white p-4">
            <div class="card-body">
                
                <!-- HEADER LOGO & JUDUL -->
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2" style="width: 55px; height: 55px; background-color: #dbe4f0; color: #4a628a; font-size: 26px;">
                        📈
                    </div>
                    <h5 class="fw-bold text-dark mb-1">CRM & Buku Tamu</h5>
                    <span class="text-muted" style="font-size: 12px;">Masuk ke akun Anda untuk melanjutkan</span>
                </div>

                <!-- ALERT ERROR -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 mb-3 text-center" style="font-size: 12px;" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <!-- FORM LOGIN -->
                <form action="" method="POST">
                    
                    <!-- PILIHAN PERAN (ROLE) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px;">Pilih Peran Pengguna (Role)</label>
                        <select name="role" class="form-select" style="font-size: 13px;" required>
                            <option value="" selected disabled>-- Pilih Hak Akses --</option>
                            <option value="Administrator">👨‍💼 Administrator / Tata Usaha</option>
                            <option value="Agent CRM">🎧 Agent CRM / Tim Follow-up</option>
                            <option value="Petugas Resepsionis">📋 Petugas Resepsionis / Kunjungan</option>
                        </select>
                    </div>

                    <!-- USERNAME -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px;">Username / Email</label>
                        <input type="text" name="username" class="form-control" style="font-size: 13px;" placeholder="Masukkan username" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="font-size: 12px;">Kata Sandi (Password)</label>
                        <input type="password" name="password" class="form-control" style="font-size: 13px;" placeholder="Masukkan password" required>
                    </div>

                    <!-- TOMBOL MASUK -->
                    <button type="submit" name="login" class="btn btn-custom w-100 py-2 fw-semibold mb-3" style="font-size: 13px;">
                        Masuk ke Sistem
                    </button>
                </form>

                <div class="text-center">
                    <span class="text-muted" style="font-size: 11px;">&copy; 2026 Sistem CRM & Kunjungan Sekolah</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>