<?php
require_once '../config/database.php';

// Menangkap parameter tahap dari URL
$tahap_aktif = isset($_GET['tahap']) ? $_GET['tahap'] : 'Kontak Baru (New Lead)';

// Data dummy daftar siswa sesuai tahap
$daftar_siswa = [
    [
        'id' => 1,
        'nama' => 'Budi Santoso',
        'sekolah' => 'SMPN 1',
        'label' => 'Minat',
        'agent' => 'Budi Prasetyo'
    ],
    [
        'id' => 2,
        'nama' => 'Siti Aminah',
        'sekolah' => 'SMPN 2',
        'label' => 'Ragu',
        'agent' => 'Ahmad'
    ],
    [
        'id' => 3,
        'nama' => 'Andi',
        'sekolah' => 'SMPN 3',
        'label' => 'Minat',
        'agent' => 'Siti'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - CRM System</title>
    
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
        .card-custom { background: white; border: 1px solid #eaeaea; border-radius: 12px; padding: 25px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05); }
        
        /* Styling Tabel */
        .table-custom th { background-color: #f8f9fa; font-size: 13px; color: #495057; border-top: none; }
        .table-custom td { font-size: 13px; vertical-align: middle; }
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
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Daftar Siswa &mdash; Tahap <?php echo htmlspecialchars($tahap_aktif); ?></h5>
                <span class="text-muted" style="font-size: 12px;">Dashboard / CRM / Tahap / Daftar Siswa</span>
            </div>
            <a href="tahap.php" class="btn btn-secondary btn-sm px-3 fw-bold"><i class="fas fa-arrow-left me-1"></i> Kembali ke Tahap</a>
        </div>

        <!-- CONTENT AREA -->
        <div class="content-area">
            <div class="card-custom">
                
                <!-- KONTROL PENCARIAN & FILTER -->
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" id="cariSiswa" class="form-control" placeholder="Cari siswa...">
                        </div>
                    </div>
                    
                    <div class="col-md-6 d-flex gap-2 justify-content-md-end">
                        <select id="filterAgent" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">Filter Agent</option>
                            <option value="Budi Prasetyo">Budi Prasetyo</option>
                            <option value="Ahmad">Ahmad</option>
                            <option value="Siti">Siti</option>
                        </select>
                        
                        <select id="filterLabel" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">Filter Label</option>
                            <option value="Minat">Minat</option>
                            <option value="Ragu">Ragu</option>
                        </select>
                    </div>
                </div>

                <!-- TABEL DAFTAR SISWA -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle table-custom" id="tabelDaftarSiswa">
                        <thead>
                            <tr>
                                <th width="8%" class="text-center">No</th>
                                <th width="30%">Nama Siswa</th>
                                <th width="25%">Asal Sekolah</th>
                                <th width="15%">Label</th>
                                <th width="22%">Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($daftar_siswa as $siswa): ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="fw-bold text-dark"><?php echo htmlspecialchars($siswa['nama']); ?></td>
                                <td><?php echo htmlspecialchars($siswa['sekolah']); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo ($siswa['label'] == 'Minat') ? 'success' : 'warning'; ?> bg-opacity-10 text-<?php echo ($siswa['label'] == 'Minat') ? 'success' : 'warning'; ?> px-2 py-1">
                                        <?php echo htmlspecialchars($siswa['label']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($siswa['agent']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Script Pencarian -->
    <script>
        document.getElementById('cariSiswa').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tabelDaftarSiswa tbody tr');
            
            rows.forEach(function(row) {
                let nama = row.cells[1].textContent.toLowerCase();
                let sekolah = row.cells[2].textContent.toLowerCase();
                if (nama.includes(keyword) || sekolah.includes(keyword)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>