<?php
require_once '../config/database.php';
// checkLogin(); // Aktifkan jika sistem auth sudah berjalan
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Interaksi CRM - CRM System</title>
    
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
        
        /* TABEL CUSTOM SESUAI FORM */
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
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Riwayat Interaksi CRM</h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / CRM / Riwayat Interaksi</span>
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
                <h6 class="mb-0 fw-bold text-dark">Daftar Data & Interaksi Calon Siswa</h6>
                <!-- Tombol mengarah ke form_crm.php -->
                <a href="form_crm.php" class="btn btn-sm text-white px-3" style="background-color: #4a628a; border-radius: 4px; font-size: 12px;">+ Tambah Interaksi</a>
            </div>

            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID Siswa</th>
                                    <th>Nama Calon Siswa</th>
                                    <th>Jalur Daftar</th>
                                    <th>Asal Sekolah</th>
                                    <th>No HP / WA</th>
                                    <th>Sumber Info</th>
                                    <th>Status</th>
                                    <th>Biaya SPP</th>
                                    <th>Tgl Follow Up</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- CONTOH DATA DISESUAIKAN DENGAN ISI FORM -->
                                <tr>
                                    <td><b>CRM001</b></td>
                                    <td class="text-start">
                                        <b>Budi Santoso</b><br>
                                        <span class="text-muted" style="font-size:10px;">Ortu: Bpk. Santoso (Jakarta)</span>
                                    </td>
                                    <td>Reguler</td>
                                    <td>Nama Sekolah</td>
                                    <td>0812345678</td>
                                    <td>Brosur / Sosmed</td>
                                    <td><span class="badge bg-warning text-dark">Konsultasi Pendaftaran</span></td>
                                    <td>Rp 500.000</td>
                                    <td>30/08/2026</td>
                                    <td>
                                        <a href="form_crm.php?id=CRM001" class="btn btn-sm btn-outline-primary py-0 px-1" style="font-size: 10px;">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger py-0 px-1" style="font-size: 10px;">Hapus</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>