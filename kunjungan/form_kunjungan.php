<?php
// Cek apakah ini mode edit atau tambah baru berdasarkan parameter ?id=
$is_edit = isset($_GET['id']);
$id_kunjungan = $is_edit ? $_GET['id'] : 'KJN003';

// Simulasi data jika mode edit
$data = [
    'nama_siswa' => $is_edit ? 'Bpk Hermawan' : '',
    'asal_sekolah' => $is_edit ? 'SMPN 1 Bandung' : '',
    'pic' => $is_edit ? 'Admin Sekolah' : '',
    'jenis' => $is_edit ? 'Konsultasi Pendaftaran' : '',
    'hasil' => $is_edit ? 'Diskusi awal peminatan' : '',
    'no_hp' => $is_edit ? '08123456789' : '',
    'alamat' => $is_edit ? 'Jl. Merdeka No. 1, Bandung' : '',
    'tanggal' => $is_edit ? '2026-08-30' : '',
    'jam' => $is_edit ? '09:15' : '',
    'status' => $is_edit ? 'Follow Up' : 'Follow Up',
    'tgl_followup' => $is_edit ? '2026-09-05' : '',
    'ig' => $is_edit ? 'https://instagram.com/hermawan' : '',
    'tiktok' => $is_edit ? '' : ''
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kunjungan - CRM System</title>
    
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
        
        /* FORM CONTAINER SESUAI FIGMA */
        .form-card { background: white; border: 1px solid #e0e0e0; border-radius: 6px; padding: 25px 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .form-label { font-size: 12px; color: #333; font-weight: 500; margin-bottom: 4px; }
        .form-control, .form-select { font-size: 12px; border-radius: 6px; border-color: #dcedf8; padding: 7px 12px; }
        .form-control:focus, .form-select:focus { border-color: #4a628a; box-shadow: 0 0 0 0.15rem rgba(74, 98, 138, 0.15); }
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
        
        <!-- HEADER ATAS -->
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 17px;">Form Kunjungan</h5>
                <span class="text-muted" style="font-size: 11px;">Dashboard / Kunjungan / Form Kunjungan</span>
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
            
            <!-- BARIS JUDUL FORM & TOMBOL KEMBALI -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-dark m-0" style="font-size: 15px;">Form Kunjungan</h6>
                
                <!-- Tombol Kembali persis seperti di Figma -->
                <a href="index.php" class="btn btn-outline-primary btn-sm px-3 py-1 fw-semibold shadow-sm" style="font-size: 11.5px; border-radius: 5px; border-color: #4a628a; color: #4a628a;">
                    ← Kembali ke Menu Kunjungan
                </a>
            </div>

            <!-- KOTAK KERTAS FORM -->
            <div class="form-card">
                <form action="proses_simpan.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <!-- KOLOM KIRI -->
                        <div class="col-md-6 pe-md-4">
                            <div class="mb-3">
                                <label class="form-label">ID Kunjungan</label>
                                <input type="text" name="id_kunjungan" class="form-control" value="<?= $id_kunjungan ?>" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa/Wali</label>
                                <input type="text" name="nama_siswa" class="form-control" value="<?= $data['nama_siswa'] ?>" placeholder="Nama lengkap" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Pic (Staf)</label>
                                <input type="text" name="pic" class="form-control" value="<?= $data['pic'] ?>" placeholder="Nama staf penerima" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="form-control" value="<?= $data['asal_sekolah'] ?>" placeholder="Contoh: SMPN 1" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No.HP / WA</label>
                                <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp'] ?>" placeholder="0812345689" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat Lengkap"><?= $data['alamat'] ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Dokumentasi</label>
                                <input type="file" name="dokumentasi" class="form-control">
                            </div>
                        </div>

                        <!-- KOLOM KANAN -->
                        <div class="col-md-6 ps-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kunjungan</label>
                                <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Jam</label>
                                <input type="time" name="jam" class="form-control" value="<?= $data['jam'] ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Jenis Kunjungan</label>
                                <input type="text" name="jenis" class="form-control" value="<?= $data['jenis'] ?>" placeholder="Konsultasi Pendaftaran" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Hasil Kunjungan</label>
                                <input type="text" name="hasil_kunjungan" class="form-control" value="<?= $data['hasil'] ?>" placeholder="Catatan Hasil Diskusi">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label d-block mb-1">Status</label>
                                <div class="form-check form-check-inline mt-1">
                                    <input class="form-check-input" type="radio" name="status" id="deal" value="Deal" <?= ($data['status'] == 'Deal') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="deal" style="font-size: 12px;">Deal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="followup" value="Follow Up" <?= ($data['status'] == 'Follow Up') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="followup" style="font-size: 12px;">Follow Up</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="pending" value="Pending" <?= ($data['status'] == 'Pending') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="pending" style="font-size: 12px;">Pending</label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Tgl Follow Up</label>
                                <input type="date" name="tgl_followup" class="form-control" value="<?= $data['tgl_followup'] ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Link Instagram</label>
                                <input type="text" name="link_ig" class="form-control" value="<?= $data['ig'] ?>" placeholder="https://instagram.com">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Link Tik Tok</label>
                                <input type="text" name="link_tiktok" class="form-control" value="<?= $data['tiktok'] ?>" placeholder="https://tiktok.com">
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI BAWAH -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-3">
                        <button type="reset" class="btn btn-secondary btn-sm px-4" style="border-radius: 6px; font-size: 12px;">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 6px; background-color: #2b436f; border-color: #2b436f; font-size: 12px;">Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>