<?php
require_once '../config/database.php';

// Menangkap ID siswa dari URL (misal: edit_siswa.php?id=1)
$id_siswa = isset($_GET['id']) ? $_GET['id'] : 1;

// Data dummy (biasanya diambil dari database berdasarkan $id_siswa)
$siswa = [
    'id' => $id_siswa,
    'nama' => 'Budi Santoso',
    'sekolah' => 'SMPN 1',
    'no_hp' => '0812345678',
    'tahap' => '1. Kontak Baru',
    'label_status' => 'Minat',
    'agent' => 'Budi Prasetyo',
    'tanggal_masuk' => '2026-08-30', // Format YYYY-MM-DD untuk input type="date"
    'follow_up' => '2026-09-10'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - CRM System</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 30px; }

        /* Card Styling */
        .card-custom { background: white; border: 1px solid #eaeaea; border-radius: 12px; padding: 30px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05); max-width: 800px; }
        .form-label { font-size: 13px; font-weight: 600; color: #495057; margin-bottom: 5px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" class="active" style="justify-content: space-between; align-items: center;">
            <div style="display: flex; gap: 10px; align-items: center;"><span>👤</span><span>CRM</span></div>
            <span>▼</span>
        </a>
        <div class="collapse show" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                <a href="index.php" style="padding-left: 45px;">Riwayat Interaksi</a>
                <a href="tahap.php" class="active" style="padding-left: 45px; border-left: 4px solid white;">Tahap</a>
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
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;"><?php echo htmlspecialchars($siswa['nama']); ?> &mdash; Edit Data</h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / CRM / Tahap / Edit Siswa</span>
            </div>
            <!-- Tombol Kembali Langsung ke Halaman Tahap -->
            <a href="tahap.php" class="btn btn-secondary btn-sm px-3 fw-bold"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        <!-- CONTENT AREA -->
        <div class="content-area">
            <div class="card-custom mx-auto">
                
                <h6 class="text-uppercase fw-bold text-primary mb-4" style="font-size: 14px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
                    <i class="fas fa-user-edit me-2"></i> Form Edit Calon Siswa
                </h6>
                
                <!-- FORM EDIT -->
                <form action="proses_edit_siswa.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($siswa['nama']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" class="form-control" name="sekolah" value="<?php echo htmlspecialchars($siswa['sekolah']); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">No. HP / WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
                                <input type="text" class="form-control" name="no_hp" value="<?php echo htmlspecialchars($siswa['no_hp']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tahap Saat Ini</label>
                            <select class="form-select" name="tahap">
                                <option value="1. Kontak Baru" <?php echo ($siswa['tahap'] == '1. Kontak Baru') ? 'selected' : ''; ?>>1. Kontak Baru</option>
                                <option value="2. Follow Up" <?php echo ($siswa['tahap'] == '2. Follow Up') ? 'selected' : ''; ?>>2. Follow Up</option>
                                <option value="3. Closing" <?php echo ($siswa['tahap'] == '3. Closing') ? 'selected' : ''; ?>>3. Closing</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Label Status</label>
                            <select class="form-select" name="label_status">
                                <option value="Minat" <?php echo ($siswa['label_status'] == 'Minat') ? 'selected' : ''; ?>>Minat</option>
                                <option value="Ragu" <?php echo ($siswa['label_status'] == 'Ragu') ? 'selected' : ''; ?>>Ragu</option>
                                <option value="Tidak Respon" <?php echo ($siswa['label_status'] == 'Tidak Respon') ? 'selected' : ''; ?>>Tidak Respon</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agent Penanggung Jawab</label>
                            <input type="text" class="form-control" name="agent" value="<?php echo htmlspecialchars($siswa['agent']); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" value="<?php echo htmlspecialchars($siswa['tanggal_masuk']); ?>" readonly style="background-color: #e9ecef; cursor: not-allowed;">
                            <small class="text-muted" style="font-size: 11px;">Tanggal masuk tidak dapat diubah.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jadwal Follow Up</label>
                            <input type="date" class="form-control" name="follow_up" value="<?php echo htmlspecialchars($siswa['follow_up']); ?>">
                        </div>
                    </div>

                    <hr class="text-muted opacity-25">

                    <!-- TOMBOL AKSI -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <!-- Tombol Batal Langsung ke Halaman Tahap -->
                        <a href="tahap.php" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>