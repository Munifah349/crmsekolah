<?php
// Data dummy kunjungan dengan tambahan link sosmed
$data_kunjungan = [
    [
        'id' => 'KJN001',
        'nama_siswa' => 'Bpk Hermawan',
        'asal_sekolah' => 'SMPN 1 Bandung',
        'tanggal' => '30 Ags 2026',
        'jam' => '09:15',
        'jenis' => 'Konsultasi Pendaftaran',
        'pic' => 'Admin Sekolah',
        'sosmed' => 'https://instagram.com/hermawan_bdg', // Link Sosmed aktif
        'sosmed_label' => 'IG: @hermawan_bdg',          // Teks yang tampil
        'status' => 'Follow Up',
        'no_hp' => '08123456789',
        'alamat' => 'Jl. Merdeka No. 1, Bandung',
        'hasil' => 'Konsultasi awal peminatan jurusan',
        'foto' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400'
    ],
    [
        'id' => 'KJN002',
        'nama_siswa' => 'Ibu Ratna',
        'asal_sekolah' => 'SMPN 3 Cimahi',
        'tanggal' => '30 Ags 2026',
        'jam' => '10:30',
        'jenis' => 'Penyerahan Berkas',
        'pic' => 'Kepala TU',
        'sosmed' => 'https://tiktok.com/@ratna_cmi',        // Link Sosmed aktif
        'sosmed_label' => 'TikTok: @ratna_cmi',         // Teks yang tampil
        'status' => 'Deal',
        'no_hp' => '08579876543',
        'alamat' => 'Jl. Jend. Sudirman No. 45, Cimahi',
        'hasil' => 'Berkas lengkap dan diterima',
        'foto' => ''
    ]
];

// Helper function untuk sanitasi XSS
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// =========================================================================
// PROSES EKSPOR / CETAK VERSI MS WORD
// =========================================================================

// 1. Ekspor Seluruh Data Kunjungan ke Word
if (isset($_GET['export']) && $_GET['export'] === 'word') {
    $filename = "Laporan_Kunjungan_" . date('Y-m-d') . ".doc";
    header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Disposition: attachment; filename={$filename}");
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Laporan Data Kunjungan Tamu</title>
        <style>
            body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 11pt; color: #333; }
            h2 { text-align: center; color: #2b436f; margin-bottom: 5px; }
            p.subtitle { text-align: center; font-size: 10pt; color: #666; margin-top: 0; margin-bottom: 20px; }
            table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            th, td { border: 1px solid #b0b0b0; padding: 8px 10px; text-align: left; vertical-align: top; font-size: 10pt; }
            th { background-color: #4a628a; color: #ffffff; font-weight: bold; text-align: center; }
            .text-center { text-align: center; }
        </style>
    </head>
    <body>
        <h2>DAFTAR TAMU & KUNJUNGAN - CRM SYSTEM</h2>
        <p class="subtitle">Tanggal Cetak: <?= date('d-m-Y H:i') ?> WIB</p>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 22%;">Nama & Asal Sekolah</th>
                    <th style="width: 13%;">Waktu</th>
                    <th style="width: 18%;">Jenis & PIC</th>
                    <th style="width: 12%;">No. HP / WA</th>
                    <th style="width: 12%;">Sosmed</th>
                    <th style="width: 8%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($data_kunjungan as $row): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><b><?= e($row['id']) ?></b></td>
                    <td>
                        <b><?= e($row['nama_siswa']) ?></b><br>
                        <font color="#666666" size="2"><?= e($row['asal_sekolah']) ?></font>
                    </td>
                    <td><?= e($row['tanggal']) ?><br><font color="#666666" size="2"><?= e($row['jam']) ?></font></td>
                    <td><?= e($row['jenis']) ?><br><font color="#666666" size="2">PIC: <?= e($row['pic']) ?></font></td>
                    <td><?= e($row['no_hp']) ?></td>
                    <td>
                        <?php if (!empty($row['sosmed'])): ?>
                            <a href="<?= e($row['sosmed']) ?>"><?= e($row['sosmed_label']) ?></a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><b><?= e($row['status']) ?></b></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
    exit;
}

// 2. Ekspor Detail Single Kunjungan ke Word
if (isset($_GET['export']) && $_GET['export'] === 'word_single' && !empty($_GET['id'])) {
    $target_id = $_GET['id'];
    $detail = null;
    foreach ($data_kunjungan as $item) {
        if ($item['id'] === $target_id) {
            $detail = $item;
            break;
        }
    }

    if ($detail) {
        $filename = "Detail_Kunjungan_" . $detail['id'] . ".doc";
        header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Disposition: attachment; filename={$filename}");
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Detail Kunjungan - <?= e($detail['id']) ?></title>
            <style>
                body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 11pt; color: #333; }
                h2 { text-align: center; color: #2b436f; margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                td { border: 1px solid #cccccc; padding: 10px; vertical-align: top; }
                .label { font-weight: bold; background-color: #f4f6f9; width: 30%; color: #4a628a; }
            </style>
        </head>
        <body>
            <h2>DETAIL INFORMASI KUNJUNGAN TAMU</h2>
            <table>
                <tr><td class="label">ID Kunjungan</td><td><b><?= e($detail['id']) ?></b></td></tr>
                <tr><td class="label">Nama Siswa / Wali</td><td><?= e($detail['nama_siswa']) ?></td></tr>
                <tr><td class="label">Asal Sekolah</td><td><?= e($detail['asal_sekolah']) ?></td></tr>
                <tr><td class="label">Waktu Kunjungan</td><td><?= e($detail['tanggal']) ?> (<?= e($detail['jam']) ?>)</td></tr>
                <tr><td class="label">Jenis Kunjungan</td><td><?= e($detail['jenis']) ?></td></tr>
                <tr><td class="label">PIC (Staf)</td><td><?= e($detail['pic']) ?></td></tr>
                <tr><td class="label">No. HP / WA</td><td><?= e($detail['no_hp']) ?></td></tr>
                <tr><td class="label">Sosial Media</td><td><?= e($detail['sosmed_label']) ?> (<?= e($detail['sosmed']) ?>)</td></tr>
                <tr><td class="label">Alamat</td><td><?= e($detail['alamat']) ?></td></tr>
                <tr><td class="label">Hasil Kunjungan</td><td><?= e($detail['hasil']) ?></td></tr>
                <tr><td class="label">Status</td><td><b><?= e($detail['status']) ?></b></td></tr>
            </table>
        </body>
        </html>
        <?php
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu & Kunjungan - CRM System</title>
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
        .content-area { padding: 25px 30px; flex-grow: 1; }
        .card-table { background: white; border: 1px solid #e0e0e0; border-radius: 6px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .table { font-size: 12px; vertical-align: middle; }
        .table th { background-color: #f4f6f9; color: #333; font-weight: 600; border-bottom: 2px solid #dee2e6; text-transform: uppercase; font-size: 11px; }
        .img-thumb { width: 35px; height: 35px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; cursor: pointer; transition: 0.2s; }
        .img-thumb:hover { opacity: 0.8; }
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
        
        <!-- MENU CRM -->
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
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 17px;">Daftar Tamu & Kunjungan</h5>
                <span class="text-muted" style="font-size: 11px;">Dashboard / Kunjungan</span>
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-dark m-0" style="font-size: 15px;">Data Riwayat & Kunjungan Tamu</h6>
                <div class="d-flex gap-2">
                    <!-- Tombol Cetak Semua Data ke Word -->
                    <a href="?export=word" class="btn btn-outline-primary btn-sm px-3 py-1 fw-semibold shadow-sm" style="font-size: 11.5px; border-radius: 4px;">
                        <i class="fa-solid fa-file-word me-1"></i> Cetak Word
                    </a>
                    <a href="form_kunjungan.php" class="btn btn-primary btn-sm px-3 py-1 fw-semibold shadow-sm" style="font-size: 11.5px; background-color: #2b436f; border-color: #2b436f; border-radius: 4px;">
                        + Tambah Kunjungan
                    </a>
                </div>
            </div>

            <!-- TABEL UTAMA -->
            <div class="card-table">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">ID</th>
                                <th>Nama & Asal Sekolah</th>
                                <th style="width: 90px;">Waktu</th>
                                <th>Jenis & PIC</th>
                                <th style="width: 105px;">No. HP / WA</th>
                                <th style="width: 115px;">Sosmed (Link)</th>
                                <th class="text-center" style="width: 80px;">Status</th>
                                <th class="text-center" style="width: 65px;">Foto</th>
                                <th class="text-center" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_kunjungan as $row): ?>
                            <tr>
                                <td class="text-center fw-bold text-secondary"><?= e($row['id']) ?></td>
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= e($row['nama_siswa']) ?></span>
                                    <span class="text-muted" style="font-size: 10.5px;"><?= e($row['asal_sekolah']) ?></span>
                                </td>
                                <td>
                                    <span class="d-block"><?= e($row['tanggal']) ?></span>
                                    <span class="text-muted" style="font-size: 10.5px;"><?= e($row['jam']) ?></span>
                                </td>
                                <td>
                                    <span class="d-block"><?= e($row['jenis']) ?></span>
                                    <span class="text-muted" style="font-size: 10.5px;">Staf: <?= e($row['pic']) ?></span>
                                </td>
                                <td>
                                    <span class="text-dark fw-medium"><i class="fa-brands fa-whatsapp text-success me-1"></i><?= e($row['no_hp']) ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($row['sosmed'])): ?>
                                        <a href="<?= e($row['sosmed']) ?>" target="_blank" class="text-decoration-none text-primary fw-semibold" style="font-size: 11px;">
                                            <i class="fa-solid fa-link me-1"></i><?= e($row['sosmed_label']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 11px;">-</span>
                                    <?php endif; ?>
                                </td>
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
                                    <?php if (!empty($row['foto'])): ?>
                                        <img src="<?= e($row['foto']) ?>" class="img-thumb" alt="Dokumentasi" data-bs-toggle="modal" data-bs-target="#modalViewKunjungan"
                                            data-id="<?= e($row['id']) ?>"
                                            data-namasiswa="<?= e($row['nama_siswa']) ?>"
                                            data-asalsekolah="<?= e($row['asal_sekolah']) ?>"
                                            data-tanggal="<?= e($row['tanggal']) ?>"
                                            data-jam="<?= e($row['jam']) ?>"
                                            data-jenis="<?= e($row['jenis']) ?>"
                                            data-pic="<?= e($row['pic']) ?>"
                                            data-nohp="<?= e($row['no_hp']) ?>"
                                            data-sosmed="<?= e($row['sosmed']) ?>"
                                            data-sosmedlabel="<?= e($row['sosmed_label']) ?>"
                                            data-alamat="<?= e($row['alamat']) ?>"
                                            data-hasil="<?= e($row['hasil']) ?>"
                                            data-status="<?= e($row['status']) ?>"
                                            data-foto="<?= e($row['foto']) ?>">
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 11px;">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button type="button" class="btn btn-outline-secondary btn-sm px-2 py-0" style="font-size: 11px;"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalViewKunjungan"
                                            data-id="<?= e($row['id']) ?>"
                                            data-namasiswa="<?= e($row['nama_siswa']) ?>"
                                            data-asalsekolah="<?= e($row['asal_sekolah']) ?>"
                                            data-tanggal="<?= e($row['tanggal']) ?>"
                                            data-jam="<?= e($row['jam']) ?>"
                                            data-jenis="<?= e($row['jenis']) ?>"
                                            data-pic="<?= e($row['pic']) ?>"
                                            data-nohp="<?= e($row['no_hp']) ?>"
                                            data-sosmed="<?= e($row['sosmed']) ?>"
                                            data-sosmedlabel="<?= e($row['sosmed_label']) ?>"
                                            data-alamat="<?= e($row['alamat']) ?>"
                                            data-hasil="<?= e($row['hasil']) ?>"
                                            data-status="<?= e($row['status']) ?>"
                                            data-foto="<?= e($row['foto']) ?>">
                                            View
                                        </button>
                                        <!-- Tombol Cetak Word Single Per Tamu -->
                                        <a href="?export=word_single&id=<?= e($row['id']) ?>" class="btn btn-outline-success btn-sm px-2 py-0" style="font-size: 11px;" title="Cetak Word">
                                            <i class="fa-solid fa-file-word"></i> Word
                                        </a>
                                        <a href="form_kunjungan.php?id=<?= e($row['id']) ?>" class="btn btn-outline-primary btn-sm px-2 py-0" style="font-size: 11px;">Edit</a>
                                        <a href="hapus.php?id=<?= e($row['id']) ?>" class="btn btn-outline-danger btn-sm px-2 py-0" onclick="return confirm('Yakin ingin menghapus data ini?')" style="font-size: 11px;">Hapus</a>
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

    <!-- MODAL VIEW DETAIL DENGAN LINK SOSMED & CETAK WORD -->
    <div class="modal fade" id="modalViewKunjungan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
                <div class="modal-header bg-light border-bottom py-2 px-3">
                    <h6 class="modal-title fw-bold text-dark" style="font-size: 14px;">Detail Informasi Kunjungan</h6>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3 px-3" style="font-size: 12px;">
                    <div class="row">
                        <div class="col-md-7">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td class="fw-bold text-secondary" style="width: 38%;">ID Kunjungan</td>
                                    <td id="view_id" class="text-dark fw-bold"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Nama Siswa/Wali</td>
                                    <td id="view_namasiswa" class="text-dark"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Asal Sekolah</td>
                                    <td id="view_asalsekolah" class="text-dark"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">No. HP / WA</td>
                                    <td id="view_nohp" class="text-dark fw-semibold text-success"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Sosial Media</td>
                                    <td>
                                        <a id="view_sosmed_link" href="#" target="_blank" class="text-decoration-none fw-semibold text-primary">
                                            <i class="fa-solid fa-link me-1"></i><span id="view_sosmed_text"></span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Waktu Kunjungan</td>
                                    <td id="view_waktu" class="text-dark"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Jenis Kunjungan</td>
                                    <td id="view_jenis" class="text-dark"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">PIC (Staf)</td>
                                    <td id="view_pic" class="text-dark"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Alamat</td>
                                    <td id="view_alamat" class="text-dark"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Hasil Kunjungan</td>
                                    <td id="view_hasil" class="text-dark"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Status</td>
                                    <td><span id="view_status" class="badge"></span></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-5 text-center d-flex flex-column justify-content-center align-items-center border-start">
                            <span class="fw-bold text-secondary mb-2" style="font-size: 11px;">Dokumentasi Kunjungan</span>
                            <div id="wrapper_foto" style="width: 100%; min-height: 180px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa; border: 1px dashed #ced4da; border-radius: 6px; overflow: hidden;">
                                <img id="view_foto" src="" alt="Foto Dokumentasi" style="max-width: 100%; max-height: 220px; object-fit: contain; display: none;">
                                <span id="no_foto_text" class="text-muted" style="font-size: 11px;">Tidak ada foto dokumentasi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top py-2 px-3 d-flex justify-content-between">
                    <a id="btn_export_word_modal" href="#" class="btn btn-outline-success btn-sm px-3" style="font-size: 11.5px; border-radius: 4px;">
                        <i class="fa-solid fa-file-word me-1"></i> Cetak Word
                    </a>
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" style="font-size: 11.5px; border-radius: 4px;">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalView = document.getElementById('modalViewKunjungan');
            modalView.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                
                document.getElementById('view_id').textContent = id;
                document.getElementById('view_namasiswa').textContent = button.getAttribute('data-namasiswa');
                document.getElementById('view_asalsekolah').textContent = button.getAttribute('data-asalsekolah');
                document.getElementById('view_nohp').textContent = button.getAttribute('data-nohp');
                
                // Dynamic link untuk tombol Cetak Word di modal
                document.getElementById('btn_export_word_modal').href = '?export=word_single&id=' + encodeURIComponent(id);

                // Set link URL dan teks sosial media
                var sosmedUrl = button.getAttribute('data-sosmed');
                var sosmedLabel = button.getAttribute('data-sosmedlabel');
                var sosmedLinkElement = document.getElementById('view_sosmed_link');
                var sosmedTextElement = document.getElementById('view_sosmed_text');

                if (sosmedUrl && sosmedUrl.trim() !== '') {
                    sosmedLinkElement.href = sosmedUrl;
                    sosmedTextElement.textContent = sosmedLabel;
                    sosmedLinkElement.style.display = 'inline-block';
                } else {
                    sosmedLinkElement.href = '#';
                    sosmedTextElement.textContent = '-';
                }

                document.getElementById('view_waktu').textContent = button.getAttribute('data-tanggal') + ' / ' + button.getAttribute('data-jam');
                document.getElementById('view_jenis').textContent = button.getAttribute('data-jenis');
                document.getElementById('view_pic').textContent = button.getAttribute('data-pic');
                document.getElementById('view_alamat').textContent = button.getAttribute('data-alamat');
                document.getElementById('view_hasil').textContent = button.getAttribute('data-hasil');
                
                var status = button.getAttribute('data-status');
                var badgeStatus = document.getElementById('view_status');
                badgeStatus.textContent = status;
                if (status === 'Deal') {
                    badgeStatus.className = 'badge bg-success';
                } else if (status === 'Follow Up') {
                    badgeStatus.className = 'badge bg-warning text-dark';
                } else {
                    badgeStatus.className = 'badge bg-secondary';
                }

                var fotoUrl = button.getAttribute('data-foto');
                var imgElement = document.getElementById('view_foto');
                var noFotoText = document.getElementById('no_foto_text');

                if (fotoUrl && fotoUrl.trim() !== '') {
                    imgElement.src = fotoUrl;
                    imgElement.style.display = 'block';
                    noFotoText.style.display = 'none';
                } else {
                    imgElement.src = '';
                    imgElement.style.display = 'none';
                    noFotoText.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>