<?php
require_once '../config/database.php';
// checkLogin(); // Aktifkan jika sistem auth sudah berjalan

// PROSES SIMPAN DATA KUNJUNGAN
if (isset($_POST['simpan'])) {
    $id_kunjungan   = $_POST['id_kunjungan'];
    $nama_siswa     = $_POST['nama_siswa'];
    $nama_pic       = $_POST['nama_pic'];
    $asal_sekolah   = $_POST['asal_sekolah'];
    $no_hp          = $_POST['no_hp'];
    $alamat         = $_POST['alamat'];
    $tgl_kunjungan  = $_POST['tgl_kunjungan'];
    $jam            = $_POST['jam'];
    $jenis_kunjungan= $_POST['jenis_kunjungan'];
    $hasil_kunjungan= $_POST['hasil_kunjungan'];
    $status         = $_POST['status'];
    $tgl_follow_up  = $_POST['tgl_follow_up'];
    $link_ig        = $_POST['link_ig'];
    $link_tiktok    = $_POST['link_tiktok'];

    // Query simpan ke database (pastikan struktur tabel menyesuaikan kolom di bawah)
    /*
    $query = "INSERT INTO kunjungan (id_kunjungan, nama_siswa, nama_pic, asal_sekolah, no_hp, alamat, tgl_kunjungan, jam, jenis_kunjungan, hasil_kunjungan, status, tgl_follow_up, link_ig, link_tiktok) 
              VALUES ('$id_kunjungan', '$nama_siswa', '$nama_pic', '$asal_sekolah', '$no_hp', '$alamat', '$tgl_kunjungan', '$jam', '$jenis_kunjungan', '$hasil_kunjungan', '$status', '$tgl_follow_up', '$link_ig', '$link_tiktok')";
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
    <title>Form Kunjungan - CRM System</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR STYLING */
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        
        /* Menu Kunjungan Aktif */
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        /* MAIN CONTENT STYLING */
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 30px; }
        
        /* FORM STYLING */
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
        <a href="index.php" class="active" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- MENU CRM (Dropdown Tertutup) -->
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

        <a href="index.php" style="justify-content: flex-start; gap: 10px;">📋 Laporan</a>
        <a href="../users/index.php" style="justify-content: flex-start; gap: 10px;">🧑 Pengguna</a>
        <a href="../pengaturan/index.php" style="justify-content: flex-start; gap: 10px;">⚙️ Pengaturan</a>
        
        <a href="../auth/logout.php" style="position: absolute; bottom: 20px; width: 100%; justify-content: flex-start; gap: 10px;">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER -->
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Form Kunjungan</h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / Kunjungan / Form Kunjungan</span>
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
            
            <!-- TOMBOL KEMBALI DAN JUDUL -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-dark">Form Kunjungan</h6>
                <a href="index.php" class="btn btn-sm text-white px-3" style="background-color: #6c757d; font-size: 12px;">← Kembali ke Menu Kunjungan</a>
            </div>

            <div class="form-card mb-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <!-- KOLOM KIRI -->
                        <div class="col-md-6 pe-md-4">
                            
                            <div class="mb-3">
                                <label class="form-label">ID Kunjungan</label>
                                <input type="text" name="id_kunjungan" class="form-control" value="KJN001" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Siswa/Wali</label>
                                <input type="text" name="nama_siswa" class="form-control" placeholder="Nama lengkap" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Pic (Staf)</label>
                                <input type="text" name="nama_pic" class="form-control" placeholder="Nama staf penerima" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="form-control" placeholder="Contoh: SMPN 1" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No.HP / WA</label>
                                <input type="number" name="no_hp" class="form-control" placeholder="0812345689" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat Lengkap" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Foto/Video</label>
                                <input type="file" name="berkas" class="form-control">
                            </div>

                        </div>

                        <!-- KOLOM KANAN -->
                        <div class="col-md-6 ps-md-4">
                            
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kunjungan</label>
                                <input type="date" name="tgl_kunjungan" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jam</label>
                                <input type="time" name="jam" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kunjungan</label>
                                <input type="text" name="jenis_kunjungan" class="form-control" placeholder="Konsultasi Pendaftaran" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hasil Kunjungan</label>
                                <textarea name="hasil_kunjungan" class="form-control" rows="2" placeholder="Catatan Hasil Diskusi" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="d-flex gap-3 mt-1" style="font-size: 12px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="deal" value="Deal">
                                        <label class="form-check-label" for="deal">Deal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="followup" value="Follow Up" checked>
                                        <label class="form-check-label" for="followup">Follow Up</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="pending" value="Pending">
                                        <label class="form-check-label" for="pending">Pending</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tgl Follow Up</label>
                                <input type="date" name="tgl_follow_up" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link Instagram</label>
                                <input type="url" name="link_ig" class="form-control" placeholder="https://instagram.com">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link Tik Tok</label>
                                <input type="url" name="link_tiktok" class="form-control" placeholder="https://tiktok.com">
                            </div>

                        </div>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="reset" class="btn btn-light px-4" style="font-size: 12px; border: 1px solid #ccc;">Reset</button>
                        <button type="submit" name="simpan" class="btn text-white px-4" style="background-color: #4a628a; font-size: 12px;">Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>