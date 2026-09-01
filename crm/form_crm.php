<?php
require_once '../config/database.php';
// checkLogin(); // Aktifkan jika sistem auth sudah berjalan

if (isset($_POST['simpan'])) {
    $id_calon_siswa = $_POST['id_calon_siswa'];
    $tanggal        = $_POST['tanggal'];
    $tahap_crm      = $_POST['tahap_crm'];
    $status         = $_POST['status'];
    $catatan        = $_POST['catatan'];
    $agent_pic      = $_POST['agent_pic'];

    /*
    // Contoh query simpan interaksi ke database:
    $query = "INSERT INTO crm_interaksi (id_calon_siswa, tanggal, tahap_crm, status, catatan, agent_pic) 
              VALUES ('$id_calon_siswa', '$tanggal', '$tahap_crm', '$status', '$catatan', '$agent_pic')";
    mysqli_query($conn, $query);
    header("Location: index.php");
    exit;
    */
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CRM Siswa - CRM System</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR STYLING */
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        
        /* Menu CRM Aktif */
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        /* MAIN CONTENT STYLING */
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 30px; }
        
        /* FORM CARD */
        .form-card { background: white; border-radius: 6px; border: 1px solid #eaeaea; padding: 25px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .form-label { font-size: 12px; font-weight: 600; color: #333; margin-bottom: 4px; }
        .form-control, .form-select { font-size: 12px; padding: 8px 12px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- MENU CRM (Dropdown Terbuka) -->
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" class="active" style="justify-content: space-between; align-items: center;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span>👤</span>
                <span>CRM</span>
            </div>
            <span>▼</span>
        </a>
        
        <div class="collapse show" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                <a href="index.php" class="active" style="padding-left: 45px; border-left: 4px solid white;">Riwayat Interaksi</a>
                <a href="tahap.php" style="padding-left: 45px;">Tahap</a>
                <a href="agent.php" style="padding-left: 45px;">Agent</a>
                <a href="label_status.php" style="padding-left: 45px;">Label Status</a>
            </div>
        </div>

        <a href="../laporan/index.php" style="justify-content: flex-start; gap: 10px;">📋 Laporan</a>
        <a href="../users/index.php" style="justify-content: flex-start; gap: 10px;">🧑 Pengguna</a>
        <a href="../pengaturan/index.php" style="justify-content: flex-start; gap: 10px;">⚙️ Pengaturan</a>
        
        <a href="../auth/logout.php" style="position: absolute; bottom: 20px; width: 100%; justify-content: flex-start; gap: 10px;">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER -->
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Form CRM Siswa</h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / CRM / Form CRM</span>
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
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-dark">Form Input Interaksi Calon Siswa</h6>
                <a href="index.php" class="btn btn-sm text-white px-3" style="background-color: #6c757d; font-size: 12px;">← Kembali ke Riwayat</a>
            </div>

            <div class="form-card">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ID Calon Siswa</label>
                            <input type="text" name="id_calon_siswa" class="form-control" value="CRM001" readonly>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jalur Daftar</label>
                            <input type="text" name="jalur_daftar" class="form-control" placeholder="Reguler / Prestasi">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Calon Siswa</label>
                            <input type="text" name="nama_calon_siswa" class="form-control" value="Budi Santoso">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sumber Info</label>
                            <input type="text" name="sumber_info" class="form-control" placeholder="Brosur / Sosmed">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control" placeholder="Nama Sekolah Asal">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" name="status" class="form-control" value="Konsultasi Pendaftaran">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Orang Tua</label>
                            <input type="text" name="nama_ortu" class="form-control" placeholder="Bpk. / Ibu...">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Biaya / SPP (Rp)</label>
                            <input type="text" name="biaya_spp" class="form-control" placeholder="Nominal SPP">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">NO HP / WA</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="0812345678">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tgl Follow Up</label>
                            <input type="date" name="tgl_follow_up" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" name="kota" class="form-control" placeholder="Jakarta">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="reset" class="btn btn-light px-4" style="font-size: 12px; border: 1px solid #ccc;">Reset</button>
                        <button type="submit" name="simpan" class="btn text-white px-4" style="background-color: #198754; font-size: 12px;">Update</button>
                        <button type="submit" name="simpan_baru" class="btn text-white px-4" style="background-color: #0d6efd; font-size: 12px;">Simpan Baru</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>