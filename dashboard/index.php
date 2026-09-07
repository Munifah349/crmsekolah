<?php
require_once '../config/database.php';
// checkLogin(); // Aktifkan jika ada sistem auth
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CRM System</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR STYLING */
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        
        /* Menu Aktif */
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        /* MAIN CONTENT STYLING */
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; background-color: #FFFFFF; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 30px; }
        
        /* STAT CARDS */
        .stat-card { border: 1px solid #ddd; border-radius: 4px; padding: 15px 10px; text-align: center; background-color: white; height: 100%; display: flex; flex-direction: column; justify-content: center;}
        .stat-card .title { font-size: 11px; color: #666; margin-bottom: 8px; font-weight: 500; }
        .stat-card .value { font-size: 22px; font-weight: bold; color: #333; margin: 0; }

        /* GRID UNTUK 7 KOTAK */
        .seven-cols { display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; }

        /* KUSTOMISASI AKTIVITAS TERBARU */
        .activity-time { font-weight: bold; font-size: 14px; color: #333; margin-bottom: 2px; }
        .activity-desc { font-size: 13px; color: #666; margin-bottom: 15px; line-height: 1.4; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="index.php" class="active" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- MENU CRM (Dropdown Tertutup secara Default) -->
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" style="justify-content: space-between; align-items: center;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span>👤</span>
                <span>CRM</span>
            </div>
            <span>▼</span>
        </a>
        
        <div class="collapse" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                 <a href="index.php" style="padding-left: 45px;">Riwayat Interaksi</a>
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
        
        <!-- HEADER -->
        <div class="top-header">
            <h5 class="m-0 text-dark fw-normal" style="font-size: 20px;">Dashboard</h5>
            
            <div class="d-flex align-items-center text-end">
                <div class="me-3">
                    <span class="d-block fw-bold text-dark" style="font-size: 13px;">Admin Sekolah</span>
                    <span class="text-muted" style="font-size: 11px;">Kepala Tata Usaha</span>
                </div>
                <!-- Lingkaran Profil Singkatan -->
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background-color: #dbe4f0; color: #4a628a; border: 1px solid #4a628a;">
                    AS
                </div>
            </div>
        </div>

        <div class="content-area">
            
            <!-- 7 KOTAK STATISTIK -->
            <div class="seven-cols mb-5">
                <div class="stat-card">
                    <div class="title">Total Siswa Aktif</div>
                    <div class="value">250</div>
                </div>
                <div class="stat-card">
                    <div class="title">Calon Siswa</div>
                    <div class="value">78</div>
                </div>
                <div class="stat-card">
                    <div class="title">Total Kunjungan</div>
                    <div class="value">135</div>
                </div>
                <div class="stat-card">
                    <div class="title">Follow Up</div>
                    <div class="value">42</div>
                </div>
                <div class="stat-card">
                    <div class="title">Pendaftaran Deal</div>
                    <div class="value">65</div>
                </div>
                <div class="stat-card">
                    <div class="title">Pending</div>
                    <div class="value">28</div>
                </div>
                <div class="stat-card">
                    <div class="title">Batal / Lost</div>
                    <div class="value">12</div>
                </div>
            </div>

            <!-- AREA KONTEN BAWAH -->
            <div class="row">
                
                <!-- KIRI: REKAP KUNJUNGAN BULANAN (Tanpa Tren) -->
                <div class="col-lg-8 pe-lg-4">
                    <h6 class="fw-bold mb-4 text-dark">Rekap Kunjungan Bulanan</h6>
                    <table class="table table-borderless table-sm align-middle" style="font-size: 14px;">
                        <thead class="border-bottom">
                            <tr>
                                <th class="text-secondary fw-normal pb-2">Bulan</th>
                                <th class="text-secondary fw-normal pb-2 text-center">Total Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 fw-bold text-dark">Agustus 2026</td>
                                <td class="py-2 text-center">25</td>
                            </tr>
                            <tr>
                                <td class="py-2 fw-bold text-dark">Juli 2026</td>
                                <td class="py-2 text-center">18</td>
                            </tr>
                            <tr>
                                <td class="py-2 fw-bold text-dark">Juni 2026</td>
                                <td class="py-2 text-center">21</td>
                            </tr>
                            <tr>
                                <td class="py-2 fw-bold text-dark">Mei 2026</td>
                                <td class="py-2 text-center">15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- KANAN: AKTIVITAS TERBARU -->
                <div class="col-lg-4 ps-lg-4 border-start">
                    <h6 class="fw-bold mb-4 text-dark">Aktivitas Terbaru</h6>
                    
                    <div class="activity-item">
                        <div class="activity-time">08.30</div>
                        <div class="activity-desc">Menambahkan data calon siswa baru</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-time">09.15</div>
                        <div class="activity-desc">Mengisi form kunjungan orang tua</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-time">10.45</div>
                        <div class="activity-desc">Mengubah status pendaftaran (Follow Up)</div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>