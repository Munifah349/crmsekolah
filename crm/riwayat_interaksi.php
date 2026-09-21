<?php
// Simulasi data tabel riwayat interaksi siswa
$data_riwayat = [
    [
        'id_siswa' => 'CRM001',
        'nama' => 'Budi Santoso',
        'ortu' => 'Ortu: Bpk. Santoso (Jakarta)',
        'jalur_daftar' => 'Regular',
        'asal_sekolah' => 'Nama Sekolah',
        'no_hp' => '0812345678',
        'sumber_info' => 'Brosur / Sosmed',
        'status' => 'Konsultasi Pendaftaran',
        'status_warna' => 'warning text-dark',
        'biaya_spp' => 'Rp 500.000',
        'tgl_followup' => '30/08/2026'
    ]
];

// --- PROSES EXPORT / CETAK WORD ---
if (isset($_GET['export']) && $_GET['export'] === 'word') {
    $target_id = $_GET['id'] ?? null;
    $export_data = $data_riwayat;

    // Jika ada ID spesifik (tombol cetak di kolom Aksi), filter data
    if ($target_id) {
        $export_data = array_filter($data_riwayat, function($item) use ($target_id) {
            return $item['id_siswa'] === $target_id;
        });
        $filename = "Riwayat_Interaksi_" . $target_id . "_" . date('Ymd') . ".doc";
        $judul_laporan = "LAPORAN INTERAKSI SISWA (" . htmlspecialchars($target_id) . ")";
    } else {
        $filename = "Riwayat_Interaksi_CRM_Semua_" . date('Ymd_His') . ".doc";
        $judul_laporan = "LAPORAN KESELURUHAN RIWAYAT INTERAKSI CRM";
    }

    // Header HTTP untuk mengunduh dokumen MS Word
    header("Content-Type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="utf-8">
        <title><?= $judul_laporan ?></title>
        <style>
            body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 11pt; color: #333; }
            h3 { text-align: center; margin-bottom: 5px; color: #2b436f; }
            p.meta { text-align: center; font-size: 9pt; color: #666; margin-top: 0; margin-bottom: 20px; }
            table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            th, td { border: 1px solid #999; padding: 8px 10px; text-align: left; vertical-align: top; font-size: 10pt; }
            th { background-color: #4a628a; color: #ffffff; font-weight: bold; }
            tr:nth-child(even) { background-color: #f9f9f9; }
            .badge { font-weight: bold; color: #222; }
        </style>
    </head>
    <body>
        <h3><?= $judul_laporan ?></h3>
        <p class="meta">Dicetak pada: <?= date('d/m/Y H:i') ?></p>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>ID Siswa</th>
                    <th>Nama Calon Siswa</th>
                    <th>Jalur Daftar</th>
                    <th>Asal Sekolah</th>
                    <th>No HP / WA</th>
                    <th>Sumber Info</th>
                    <th>Status</th>
                    <th>Biaya SPP</th>
                    <th>Tgl Follow Up</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($export_data as $row): ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td><b><?= htmlspecialchars($row['id_siswa']) ?></b></td>
                    <td>
                        <b><?= htmlspecialchars($row['nama']) ?></b><br>
                        <span style="font-size: 9pt; color: #555;"><?= htmlspecialchars($row['ortu']) ?></span>
                    </td>
                    <td><?= htmlspecialchars($row['jalur_daftar']) ?></td>
                    <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                    <td><?= htmlspecialchars($row['no_hp']) ?></td>
                    <td><?= htmlspecialchars($row['sumber_info']) ?></td>
                    <td><span class="badge"><?= htmlspecialchars($row['status']) ?></span></td>
                    <td><?= htmlspecialchars($row['biaya_spp']) ?></td>
                    <td><?= htmlspecialchars($row['tgl_followup']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Interaksi CRM - CRM System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; margin: 0; }
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; background-color: #F8F9FA; display: flex; flex-direction: column; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 30px; flex-grow: 1; }
        .whatsapp-link { color: #198754; text-decoration: none; font-weight: 500; }
        .whatsapp-link:hover { color: #146c43; text-decoration: underline; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" style="justify-content: space-between; align-items: center;" aria-expanded="true">
            <div style="display: flex; gap: 10px; align-items: center;"><span>👤</span><span>CRM</span></div>
            <span>▼</span>
        </a>
        <div class="collapse show" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                <a href="riwayat_interaksi.php" class="active" style="padding-left: 45px; border-left: none;">Riwayat Interaksi</a>
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
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Riwayat Interaksi CRM</h5>
                <span class="text-muted" style="font-size: 11.5px;">Dashboard / CRM / Riwayat Interaksi</span>
            </div>
            <div class="d-flex align-items-center text-end">
                <div class="me-3">
                    <span class="d-block fw-bold text-dark" style="font-size: 13px;">Admin Sekolah</span>
                    <span class="text-muted" style="font-size: 11px;">Kepala Tata Usaha</span>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background-color: #dbe4f0; color: #4a628a; border: 1px solid #4a628a;">AS</div>
            </div>
        </div>

        <div class="content-area">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-dark mb-0" style="font-size: 15px;">Daftar Data & Interaksi Calon Siswa</h6>
                <div class="d-flex gap-2">
                    <!-- Tombol Cetak Word (Semua Data) -->
                    <a href="?export=word" class="btn btn-success btn-sm px-3 py-1.5 fw-semibold shadow-sm text-decoration-none d-flex align-items-center gap-1" style="font-size: 12px; background-color: #198754; border-color: #198754;" title="Cetak Semua Data">
                        <i class="fas fa-file-word"></i> Cetak Semua Word
                    </a>
                    <!-- Tombol Tambah Interaksi -->
                    <a href="form_tambah_interaksi.php" class="btn btn-primary btn-sm px-3 py-1.5 fw-semibold shadow-sm text-decoration-none" style="font-size: 12px; background-color: #2b436f; border-color: #2b436f;">
                        + Tambah Interaksi
                    </a>
                </div>
            </div>

            <div class="card border shadow-sm bg-white" style="border-radius: 8px;">
                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="font-size: 12px;">
                        <thead class="table-light text-secondary" style="font-size: 11px;">
                            <tr>
                                <th class="py-3 ps-3">ID Siswa</th>
                                <th class="py-3">Nama Calon Siswa</th>
                                <th class="py-3">Jalur Daftar</th>
                                <th class="py-3">Asal Sekolah</th>
                                <th class="py-3">No HP / WA</th>
                                <th class="py-3">Sumber Info</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Biaya SPP</th>
                                <th class="py-3">Tgl Follow Up</th>
                                <th class="py-3 text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_riwayat as $row): 
                                $clean_phone = preg_replace('/[^0-9]/', '', $row['no_hp']);
                                if (substr($clean_phone, 0, 1) === '0') {
                                    $clean_phone = '62' . substr($clean_phone, 1);
                                }
                                $wa_message = urlencode("Halo {$row['nama']}, berikut informasi terkait interaksi dan pendaftaran Anda di sekolah.");
                            ?>
                            <tr>
                                <td class="ps-3 fw-bold text-dark"><?= htmlspecialchars($row['id_siswa']) ?></td>
                                <td>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($row['nama']) ?></span><br>
                                    <span class="text-muted" style="font-size: 10.5px;"><?= htmlspecialchars($row['ortu']) ?></span>
                                </td>
                                <td><?= htmlspecialchars($row['jalur_daftar']) ?></td>
                                <td class="text-muted"><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                                <td>
                                    <a href="https://wa.me/<?= $clean_phone ?>?text=<?= $wa_message ?>" target="_blank" class="whatsapp-link" title="Kirim WhatsApp">
                                        <i class="fab fa-whatsapp text-success"></i> <?= htmlspecialchars($row['no_hp']) ?>
                                    </a>
                                </td>
                                <td class="text-muted"><?= htmlspecialchars($row['sumber_info']) ?></td>
                                <td><span class="badge bg-<?= $row['status_warna'] ?> px-2 py-1 fw-normal" style="font-size: 11px;"><?= htmlspecialchars($row['status']) ?></span></td>
                                <td class="fw-semibold text-dark"><?= htmlspecialchars($row['biaya_spp']) ?></td>
                                <td class="text-muted"><?= htmlspecialchars($row['tgl_followup']) ?></td>
                                <td class="text-center pe-3">
                                    <div class="d-flex justify-content-center gap-1">
                                        <!-- Tombol Cetak Word per Siswa -->
                                        <a href="?export=word&id=<?= $row['id_siswa'] ?>" class="btn btn-success btn-sm px-2 py-0 text-decoration-none d-inline-flex align-items-center gap-1" style="font-size: 10.5px;" title="Cetak Word Siswa Ini">
                                            <i class="fas fa-file-word"></i> Word
                                        </a>
                                        <!-- Tombol Edit -->
                                        <a href="form_tambah_interaksi.php?id=<?= $row['id_siswa'] ?>" class="btn btn-primary btn-sm px-2 py-0 text-decoration-none" style="font-size: 10.5px;">Edit</a>
                                        <!-- Tombol Hapus -->
                                        <a href="#" class="btn btn-danger btn-sm px-2 py-0 text-decoration-none" style="font-size: 10.5px;" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>