<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CRM System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; margin: 0; }
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; background-color: #F8F9FA; display: flex; flex-direction: column; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 25px 30px; flex-grow: 1; }
        
        .summary-card { background: white; border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .chart-container, .table-container { background: white; border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); margin-top: 20px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="index.php" class="active" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
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
        <a href="../pengaturan/index.php" style="justify-content: flex-start; gap: 10px;">⚙️ Pengaturan</a>
        
        <a href="../auth/logout.php" style="position: absolute; bottom: 20px; width: 100%; justify-content: flex-start; gap: 10px;">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 17px;">Dashboard</h5>
                <span class="text-muted" style="font-size: 11px;">Selamat datang di Dashboard</span>
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

        <div class="content-area">
            <!-- SUMMARY CARDS (TANPA LOGO/IKON) -->
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="summary-card">
                        <span class="text-muted d-block mb-1" style="font-size: 12px;">Total Kunjungan</span>
                        <h4 class="m-0 fw-bold text-dark">128</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card">
                        <span class="text-muted d-block mb-1" style="font-size: 12px;">Status Deal</span>
                        <h4 class="m-0 fw-bold text-success">85</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card">
                        <span class="text-muted d-block mb-1" style="font-size: 12px;">Follow Up</span>
                        <h4 class="m-0 fw-bold text-warning">32</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card">
                        <span class="text-muted d-block mb-1" style="font-size: 12px;">Pending</span>
                        <h4 class="m-0 fw-bold text-secondary">11</h4>
                    </div>
                </div>
            </div>

            <!-- GRAFIK AREA -->
            <div class="row">
                <div class="col-12">
                    <div class="chart-container">
                        <h6 class="fw-bold text-dark mb-3" style="font-size: 14px;">Statistik Kunjungan (6 Bulan Terakhir)</h6>
                        <canvas id="barChart" height="80"></canvas>
                    </div>
                </div>
            </div>

            <!-- TABEL DATA KUNJUNGAN TERBARU -->
            <div class="row">
                <div class="col-12">
                    <div class="table-container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-dark m-0" style="font-size: 14px;">Data Kunjungan Terbaru</h6>
                            <a href="../kunjungan/index.php" class="btn btn-sm btn-outline-secondary" style="font-size: 12px;">Lihat Semua</a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">No</th>
                                        <th scope="col">Nama Pengunjung</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Keperluan</th>
                                        <th scope="col">Agent</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="fw-bold text-dark">Budi Santoso</td>
                                        <td>18 Sep 2026</td>
                                        <td>Pendaftaran Siswa Baru</td>
                                        <td>Siti Rahma</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success px-2 py-1">Deal</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="fw-bold text-dark">Dewi Lestari</td>
                                        <td>17 Sep 2026</td>
                                        <td>Konsultasi Biaya & Fasilitas</td>
                                        <td>Ahmad Fauzi</td>
                                        <td><span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1">Follow Up</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="fw-bold text-dark">Rahmat Hidayat</td>
                                        <td>16 Sep 2026</td>
                                        <td>Survei Lingkungan Sekolah</td>
                                        <td>Siti Rahma</td>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- BOOTSTRAP JS BUNDLE -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT CHART.JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: [15, 22, 18, 30, 45, 38],
                        backgroundColor: '#4a628a',
                        borderRadius: 4,
                        barThickness: 35
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [5, 5] }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</body>
</html>