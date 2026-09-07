<?php
// Data dummy kunjungan sesuai dengan desain Figma
$data_kunjungan = [
    [
        'id' => 'KJN001',
        'nama_siswa' => 'Bpk Hermawan',
        'asal_sekolah' => 'SMPN 1 Bandung',
        'tanggal' => '30 Ags 2026',
        'jam' => '09:15',
        'jenis' => 'Konsultasi Pendaftaran',
        'pic' => 'Admin Sekolah',
        'sosmed' => 'IG/TikTok',
        'status' => 'Follow Up', // Pilihan: Follow Up, Deal, Pending
        'media' => 'Ada'         // Pilihan: Ada, Tidak
    ],
    [
        'id' => 'KJN002',
        'nama_siswa' => 'Ibu Ratna',
        'asal_sekolah' => 'SMPN 3 Cimahi',
        'tanggal' => '30 Ags 2026',
        'jam' => '10:30',
        'jenis' => 'Penyerahan Berkas',
        'pic' => 'Kepala TU',
        'sosmed' => '-',
        'status' => 'Deal',
        'media' => 'Tidak'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu & Kunjungan - CRM System</title>
    
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; margin: 0; }
        
        /* SIDEBAR STYLING */
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        /* MAIN CONTENT STYLING */
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; background-color: #F8F9FA; display: flex; flex-direction: column; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 25px 30px; flex-grow: 1; }
        
        /* TABLE STYLING SESUAI FIGMA */
        .card-table { background: white; border: 1px solid #e0e0e0; border-radius: 6px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .table { font-size: 12px; vertical-align: middle; }
        .table th { background-color: #f4f6f9; color: #333; font-weight: 600; border-bottom: 2px solid #dee2e6; text-transform: uppercase; font-size: 11px; }
        
        /* STATUS BADGES */
        .badge-followup { background-color: #ffc107; color: #000; font-weight: 500; padding: 4px 10px; border-radius: 4px; font-size: 11px; }
        .badge-deal { background-color: #198754; color: #fff; font-weight: 500; padding: 4px 10px; border-radius: 4px; font-size: 11px; }
        .badge-pending { background-color: #6c757d; color: #fff; font-weight: 500; padding: 4px 10px; border-radius: 4px; font-size: 11px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="index.php" class="active" style="justify-content: flex-start; gap: 10px; border-left: 4px solid white;">👥 Kunjungan</a>
        
        <!-- MENU CRM DROPDOWN -->
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" style="justify-content: space-between; align-items: center;" aria-expanded="false">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span>👤</span>
                <span>CRM</span>
            </div>
            <span>▼</span>
        </a>
        <div class="collapse" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                <a href="../crm/riwayat_interaksi.php" style="padding-left: 45px;">Riwayat Interaksi</a>
                <a href="../crm/tahap.php" style="padding-left: 45px;">Tahap</a>
                <a href="../crm/agent.php" style="padding-left: 45px;">Agent</a>
                <a href="../crm/label_status.php" style="padding-left: 45px;">Label Status</a>
            </div>
        </div>

        <a href="../laporan/index.php" style="justify-content: flex-start; gap: 10px;">📋 Laporan</a>
        <a href="../users/index.php" style="justify-content: flex-start; gap: 10px;">🧑 Pengguna</a>
        <a href="../pengaturan/index.php" style="justify-content: flex-start; gap: 10px;">⚙️ Pengaturan</a>
        
        <a href="../auth/logout.php" style="position: absolute; bottom: 20px; width: 100%; justify-content: flex-start; gap: 10px;">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER ATAS -->
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 17px;">DaftarTamu & Kunjungan</h5>
                <span class="text-muted" style="font-size: 11px;">Dasboard / Kunjungan</span>
            </div>
            
            <div class="d-flex align-items-center text-end">
                <div class="me-3">
                    <span class="d-block fw-bold text-dark" style="font-size: 13px;">Admin Sekolah</span>
                    <span class="text-muted" style="font-size: 11px;">Kepala Tata Usaha</span>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; background-color: #dbe4f0; color: #4a628a; border: 1px solid #4a628a; font-size: 13px;">
                    AS
                </div>
            </div>
        </div>

        <!-- KONTEN UTAMA HALAMAN -->
        <div class="content-area">
            
            <!-- JUDUL SECTION & TOMBOL TAMBAH KUNJUNGAN -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-dark m-0" style="font-size: 15px;">Data Riwayat & Kunjungan Tamu</h6>
                
                <!-- Mengarah ke form_kunjungan.php yang dibuat sebelumnya -->
                <a href="form_kunjungan.php" class="btn btn-primary btn-sm px-3 py-1 fw-semibold shadow-sm" style="font-size: 11.5px; background-color: #2b436f; border-color: #2b436f; border-radius: 4px;">
                    + Tambah Kunjungan
                </a>
            </div>

            <!-- KOTAK TABEL -->
            <div class="card-table">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">ID</th>
                                <th>Nama & Asal Sekolah</th>
                                <th style="width: 100px;">Waktu</th>
                                <th>Jenis & PIC</th>
                                <th class="text-center" style="width: 90px;">Sosmed</th>
                                <th class="text-center" style="width: 90px;">Status</th>
                                <th class="text-center" style="width: 70px;">Media</th>
                                <th class="text-center" style="width: 110px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_kunjungan as $row): ?>
                            <tr>
                                <td class="text-center fw-bold text-secondary"><?= $row['id'] ?></td>
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= $row['nama_siswa'] ?></span>
                                    <span class="text-muted" style="font-size: 10.5px;"><?= $row['asal_sekolah'] ?></span>
                                </td>
                                <td>
                                    <span class="d-block"><?= $row['tanggal'] ?></span>
                                    <span class="text-muted" style="font-size: 10.5px;"><?= $row['jam'] ?></span>
                                </td>
                                <td>
                                    <span class="d-block"><?= $row['jenis'] ?></span>
                                    <span class="text-muted" style="font-size: 10.5px;">Staf: <?= $row['pic'] ?></span>
                                </td>
                                <td class="text-center text-muted"><?= $row['sosmed'] ?></td>
                                <td class="text-center">
                                    <?php if ($row['status'] == 'Follow Up'): ?>
                                        <span class="badge-followup">Follow Up</span>
                                    <?php elseif ($row['status'] == 'Deal'): ?>
                                        <span class="badge-deal">Deal</span>
                                    <?php else: ?>
                                        <span class="badge-pending">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['media'] ?>
                                </td>
                                <td class="text-center">
                                    <a href="form_kunjungan.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm px-2 py-0" style="font-size: 11px;">Edit</a>
                                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm px-2 py-0" onclick="return confirm('Yakin ingin menghapus data ini?')" style="font-size: 11px;">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>