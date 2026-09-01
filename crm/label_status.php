<?php
require_once '../config/database.php';
// checkLogin(); // Aktifkan jika sistem auth sudah berjalan

// Contoh data label status (nantinya bisa diambil dari tabel database label_status)
$data_label = [
    [
        'id' => 'LBL001',
        'nama_label' => 'Hot Lead',
        'warna' => 'bg-danger',
        'deskripsi' => 'Calon siswa sangat berminat dan siap melakukan pendaftaran dalam waktu dekat',
        'jumlah_leads' => 10
    ],
    [
        'id' => 'LBL002',
        'nama_label' => 'Warm Lead',
        'warna' => 'bg-warning text-dark',
        'deskripsi' => 'Calon siswa tertarik tetapi masih memikirkan biaya atau sekolah lain',
        'jumlah_leads' => 15
    ],
    [
        'id' => 'LBL003',
        'nama_label' => 'Cold Lead',
        'warna' => 'bg-secondary',
        'deskripsi' => 'Calon siswa jarang merespons atau respon kurang aktif saat dihubungi',
        'jumlah_leads' => 6
    ]
];

// Proses simpan label baru jika form disubmit
if (isset($_POST['simpan_label'])) {
    $nama_label = $_POST['nama_label'];
    $warna      = $_POST['warna'];
    $deskripsi  = $_POST['deskripsi'];
    // Query insert database bisa diletakkan di sini
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Label Status CRM - CRM System</title>
    
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
        
        /* TABEL CUSTOM */
        .table-custom th { font-size: 11px; background-color: #f1f4f8; color: #333; font-weight: 600; padding: 10px; text-align: center; white-space: nowrap; }
        .table-custom td { font-size: 11px; padding: 10px; vertical-align: middle; text-align: center; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" class="active" style="justify-content: space-between; align-items: center;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span>👤</span>
                <span>CRM</span>
            </div>
            <span>▼</span>
        </a>
        
        <div class="collapse show" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                <a href="index.php" style="padding-left: 45px;">Riwayat Interaksi</a>
                <a href="data_siswa.php" style="padding-left: 45px;">Data Calon Siswa</a>
                <a href="tahap.php" style="padding-left: 45px;">Tahap</a>
                <a href="agent.php" style="padding-left: 45px;">Agent</a>
                <a href="label_status.php" class="active" style="padding-left: 45px; border-left: 4px solid white;">Label Status</a>
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
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Label Status CRM</h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / CRM / Label Status</span>
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
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h6 class="fw-bold mb-1 text-dark">Manajemen Label Status Prospek</h6>
                    <span class="text-muted" style="font-size: 12px;">Kategori tingkat ketertarikan calon siswa terhadap sekolah</span>
                </div>
                <!-- Tombol Trigger Modal Tambah Label -->
                <button type="button" class="btn btn-sm text-white px-3" data-bs-toggle="modal" data-bs-target="#modalTambahLabel" style="background-color: #4a628a; border-radius: 4px; font-size: 12px;">
                    + Tambah Label 
                </button>
            </div>

            <!-- TABEL LABEL STATUS -->
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID Label</th>
                                    <th>Nama Label</th>
                                    <th>Keterangan / Deskripsi</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_label as $label): ?>
                                <tr>
                                    <td><b><?php echo $label['id']; ?></b></td>
                                    <td>
                                        <span class="badge <?php echo $label['warna']; ?> px-2 py-1"><?php echo $label['nama_label']; ?></span>
                                    </td>
                                    <td class="text-start text-muted"><?php echo $label['deskripsi']; ?></td>
                                    <td>
                                        <span class="badge bg-primary px-2 py-1"><?php echo $label['jumlah_leads']; ?> Siswa</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary py-0 px-1" style="font-size: 10px;">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger py-0 px-1" style="font-size: 10px;">Hapus</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL TAMBAH LABEL -->
    <div class="modal fade" id="modalTambahLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 15px; font-weight: bold;">Tambah Label Status Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; font-weight: 600;">Nama Label</label>
                            <input type="text" name="nama_label" class="form-control" style="font-size: 12px;" placeholder="Contoh: Priority Lead" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; font-weight: 600;">Warna Badge Bootstrap</label>
                            <select name="warna" class="form-control" style="font-size: 12px;">
                                <option value="bg-danger">Merah (Danger - Hot Lead)</option>
                                <option value="bg-warning text-dark">Kuning (Warning - Warm Lead)</option>
                                <option value="bg-secondary">Abu-abu (Secondary - Cold Lead)</option>
                                <option value="bg-success">Hijau (Success - Deal)</option>
                                <option value="bg-info text-dark">Biru Muda (Info)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; font-weight: 600;">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="2" style="font-size: 12px;" placeholder="Keterangan singkat label status ini"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="font-size: 12px;">Batal</button>
                        <button type="submit" name="simpan_label" class="btn btn-primary btn-sm" style="font-size: 12px; background-color: #4a628a; border: none;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>