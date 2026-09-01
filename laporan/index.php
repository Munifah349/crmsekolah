<?php
require_once '../config/database.php';
// checkLogin(); // Aktifkan jika sistem auth sudah berjalan

// Contoh data ringkasan laporan (bisa diisi dari hasil query SUM / COUNT database)
$total_kunjungan = 142;
$total_leads_crm = 85;
$total_deal_crm = 40;
$persentase_deal = ($total_deal_crm / $total_leads_crm) * 100;

// Contoh data riwayat laporan performa bulan ini
$data_laporan = [
    [
        'bulan' => 'Agustus 2026',
        'kunjungan_tamu' => 45,
        'leads_masuk' => 30,
        'leads_deal' => 15,
        'pendapatan_estimasi' => 'Rp 15.000.000'
    ],
    [
        'bulan' => 'Juli 2026',
        'kunjungan_tamu' => 52,
        'leads_masuk' => 35,
        'leads_deal' => 18,
        'pendapatan_estimasi' => 'Rp 18.500.000'
    ],
    [
        'bulan' => 'Juni 2026',
        'kunjungan_tamu' => 45,
        'leads_masuk' => 20,
        'leads_deal' => 7,
        'pendapatan_estimasi' => 'Rp 7.000.000'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Sistem Kunjungan & CRM</title>
    
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
        
        /* WIDGET CARD STYLING */
        .stat-card { border: none; border-radius: 8px; color: white; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .stat-card h3 { font-weight: bold; font-size: 28px; margin-top: 10px; margin-bottom: 0; }
        .stat-card p { margin: 0; font-size: 13px; opacity: 0.9; }
        
        /* TABEL CUSTOM */
        .table-custom th { font-size: 12px; background-color: #f1f4f8; color: #333; font-weight: 600; padding: 12px 10px; text-align: center; white-space: nowrap; }
        .table-custom td { font-size: 12px; padding: 12px 10px; vertical-align: middle; text-align: center; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- Menu CRM (Tertutup karena kita di halaman Laporan) -->
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
                <a href="../crm/data_siswa.php" style="padding-left: 45px;">Data Calon Siswa</a>
                <a href="../crm/tahap.php" style="padding-left: 45px;">Tahap</a>
                <a href="../crm/agent.php" style="padding-left: 45px;">Agent</a>
                <a href="../crm/label_status.php" style="padding-left: 45px;">Label Status</a>
            </div>
        </div>

        <a href="index.php" class="active" style="justify-content: flex-start; gap: 10px;">📋 Laporan</a>
        <a href="../users/index.php" style="justify-content: flex-start; gap: 10px;">🧑 Pengguna</a>
        <a href="../pengaturan/index.php" style="justify-content: flex-start; gap: 10px;">⚙️ Pengaturan</a>
        
        <a href="../auth/logout.php" style="position: absolute; bottom: 20px; width: 100%; justify-content: flex-start; gap: 10px;">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER -->
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Laporan Sistem</h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / Laporan Utama</span>
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
            
            <!-- Filter Tanggal & Judul Halaman -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-1 text-dark">Ringkasan Laporan Keseluruhan</h6>
                    <span class="text-muted" style="font-size: 12px;">Menampilkan data akumulasi kunjungan dan CRM (Default: Semua Data)</span>
                </div>
                <div class="col-md-6 text-end">
                    <form class="d-flex justify-content-end gap-2" method="GET" action="">
                        <input type="date" name="start_date" class="form-control form-control-sm" style="width: 130px; font-size: 12px;">
                        <span style="font-size:12px; margin-top:5px;">s/d</span>
                        <input type="date" name="end_date" class="form-control form-control-sm" style="width: 130px; font-size: 12px;">
                        <button type="submit" class="btn btn-sm text-white" style="background-color: #4a628a; font-size: 12px;">Filter</button>
                        <a href="#" class="btn btn-sm btn-outline-success" style="font-size: 12px;">⬇ Export Excel</a>
                    </form>
                </div>
            </div>

            <!-- STATISTIK KARTU (WIDGET) -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card" style="background-color: #4a628a;">
                        <p>Total Buku Tamu (Kunjungan)</p>
                        <h3><?php echo number_format($total_kunjungan); ?></h3>
                        <p class="mt-2" style="font-size: 11px;">Kunjungan Tercatat</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-info text-dark">
                        <p class="text-dark">Total Leads CRM Masuk</p>
                        <h3 class="text-dark"><?php echo number_format($total_leads_crm); ?></h3>
                        <p class="mt-2 text-dark" style="font-size: 11px;">Calon Siswa Tertarik</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-success">
                        <p>Total Deal / Daftar Ulang</p>
                        <h3><?php echo number_format($total_deal_crm); ?></h3>
                        <p class="mt-2" style="font-size: 11px;">Siswa Resmi Bergabung</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card bg-warning text-dark">
                        <p class="text-dark">Persentase Deal (Closing Rate)</p>
                        <h3 class="text-dark"><?php echo number_format($persentase_deal, 1); ?>%</h3>
                        <p class="mt-2 text-dark" style="font-size: 11px;">Dari total Leads masuk</p>
                    </div>
                </div>
            </div>

            <!-- TABEL LAPORAN BULANAN -->
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="m-0 fw-bold text-dark" style="font-size: 14px;">Rekapitulasi Performa Bulanan</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Kunjungan Tamu</th>
                                    <th>Leads Masuk (CRM)</th>
                                    <th>Closing Deal (Daftar)</th>
                                    <th>Estimasi Pendapatan (SPP/Pendaftaran)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_laporan as $lapor): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $lapor['bulan']; ?></td>
                                    <td><?php echo $lapor['kunjungan_tamu']; ?> Tamu</td>
                                    <td><?php echo $lapor['leads_masuk']; ?> Siswa</td>
                                    <td><span class="badge bg-success px-2 py-1"><?php echo $lapor['leads_deal']; ?> Siswa</span></td>
                                    <td class="fw-bold text-primary"><?php echo $lapor['pendapatan_estimasi']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light py-2 text-center">
                    <a href="#" class="text-decoration-none" style="font-size: 12px; color: #4a628a; font-weight: 600;">Lihat Detail Laporan Penuh ➔</a>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>