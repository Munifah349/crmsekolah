<?php
require_once '../config/database.php';
// checkLogin(); // Aktifkan jika sistem auth sudah berjalan

// Proses simpan pengaturan jika form disubmit
if (isset($_POST['simpan_pengaturan'])) {
    $nama_sekolah = $_POST['nama_sekolah'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $alamat       = $_POST['alamat'];
    $telepon      = $_POST['telepon'];
    // Query update database pengaturan bisa diletakkan di sini
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Sistem - Sistem CRM & Kunjungan</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR STYLING */
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        /* MAIN CONTENT STYLING */
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 30px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- Menu CRM -->
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" style="justify-content: space-between; align-items: center;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span>👤</span>
                <span>CRM</span>
            </div>
            <span>▼</span>
        </a>
        <div class="collapse" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                <a href="../crm/index.php" style="padding-left: 45px;">Riwayat Interaksi</a>
                <a href="../crm/tahap.php" style="padding-left: 45px;">Tahap</a>
                <a href="../crm/agent.php" style="padding-left: 45px;">Agent</a>
                <a href="../crm/label_status.php" style="padding-left: 45px;">Label Status</a>
            </div>
        </div>

        <a href="../laporan/index.php" style="justify-content: flex-start; gap: 10px;">📋 Laporan</a>
        <a href="../users/index.php" style="justify-content: flex-start; gap: 10px;">🧑 Pengguna</a>
        <a href="index.php" class="active" style="justify-content: flex-start; gap: 10px;">⚙️ Pengaturan</a>
        
        <a href="../auth/logout.php" style="position: absolute; bottom: 20px; width: 100%; justify-content: flex-start; gap: 10px;">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER -->
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Pengaturan Sistem</h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / Pengaturan Aplikasi</span>
            </div>
            
            <div class="d-flex align-items-center text-end">
                <div class="me-3">
                    <span class="d-block fw-bold text-dark" style="font-size: 13px;">Admin Sekolah</span>
                    <span class="text-muted" style="font-size: 11px;">Kepala Tata Usaha</span>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background-color: #dbe4f0; color: #4a628a; border: 1px solid #4a628a;">
                    AS
                </div>
            </div>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="content-area">
            
            <div class="mb-4">
                <h6 class="fw-bold mb-1 text-dark">Konfigurasi Umum Aplikasi</h6>
                <span class="text-muted" style="font-size: 12px;">Sesuaikan informasi profil sekolah dan parameter sistem CRM</span>
            </div>

            <!-- FORM PENGATURAN -->
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-4">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 12px; font-weight: 600;">Nama Instansi / Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control" style="font-size: 12px;" value="SMA / SMK Bina Nusantara" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 12px; font-weight: 600;">Tahun Ajaran Aktif</label>
                                <input type="text" name="tahun_ajaran" class="form-control" style="font-size: 12px;" value="2026/2027" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; font-weight: 600;">Alamat Lengkap Sekolah</label>
                            <textarea name="alamat" class="form-control" rows="2" style="font-size: 12px;" required>Jl. Pendidikan No. 45, Kota Bandung, Jawa Barat</textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 12px; font-weight: 600;">No Telepon / WhatsApp Resmi</label>
                                <input type="text" name="telepon" class="form-control" style="font-size: 12px;" value="022-87654321" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 12px; font-weight: 600;">Email Resmi Sekolah</label>
                                <input type="email" name="email" class="form-control" style="font-size: 12px;" value="info@binanusantara.sch.id" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" name="simpan_pengaturan" class="btn text-white px-4 py-2" style="background-color: #4a628a; font-size: 12px; border-radius: 4px;">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>