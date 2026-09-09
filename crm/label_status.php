<?php
// require_once '../config/database.php';
// checkLogin(); // Aktifkan jika ada sistem auth

// Simulasi data label status dari database
$labels = [
    ['id' => 'LBL001', 'nama' => 'Closing', 'keterangan' => 'Calon siswa sudah yakin dan melakukan pendaftaran.', 'jumlah' => 24, 'status' => 'Aktif', 'warna' => 'success'],
    ['id' => 'LBL002', 'nama' => 'Minat', 'keterangan' => 'Calon siswa tertarik dan masih dalam proses follow up.', 'jumlah' => 35, 'status' => 'Aktif', 'warna' => 'warning'],
    ['id' => 'LBL003', 'nama' => 'Ragu', 'keterangan' => 'Calon siswa masih mempertimbangkan atau belum yakin.', 'jumlah' => 13, 'status' => 'Aktif', 'warna' => 'danger']
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label Status CRM - CRM System</title>
    
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; margin: 0; }
        
        /* SIDEBAR STYLING */
        .sidebar { width: 250px; height: 100vh; background-color: #4a628a; color: white; position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { padding: 0 20px; margin-bottom: 30px; font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .sidebar a { color: #e0e6ed; text-decoration: none; display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover { background-color: #3b5074; color: white; }
        
        /* Menu Aktif */
        .sidebar a.active { background-color: #3b5074; border-left: 4px solid white; color: white; font-weight: bold; }
        
        /* MAIN CONTENT STYLING */
        .main-content { margin-left: 250px; padding: 0; min-height: 100vh; background-color: #F8F9FA; display: flex; flex-direction: column; }
        .top-header { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eaeaea; }
        .content-area { padding: 30px; flex-grow: 1; }
        
        /* CUSTOM CARD STATISTIK */
        .status-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 18px;
            background-color: white;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- MENU CRM -->
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#menuCrm" style="justify-content: space-between; align-items: center;" aria-expanded="true">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span>👤</span>
                <span>CRM</span>
            </div>
            <span>▼</span>
        </a>
        
        <div class="collapse show" id="menuCrm">
            <div style="background-color: #3b5074; display: flex; flex-direction: column;">
                <a href="../crm/riwayat_interaksi.php" style="padding-left: 45px;">Riwayat Interaksi</a>
                <a href="../crm/tahap.php" style="padding-left: 45px;">Tahap</a>
                <a href="../crm/agent.php" style="padding-left: 45px;">Agent</a>
                <a href="label_status.php" class="active" style="padding-left: 45px; border-left: none;">Label Status</a>
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
                <span class="text-muted" style="font-size: 11.5px;">Dashboard / CRM / Label Status</span>
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

        <!-- KONTEN UTAMA HALAMAN -->
        <div class="content-area">
            
            <!-- INFORMASI & TOMBOL TAMBAH -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 15px;">Kelola Kategori Label Status</h6>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">Kelola kategori tingkat ketertarikan calon siswa terhadap sekolah.</p>
                </div>
                <button type="button" class="btn btn-primary btn-sm px-3 py-1.5 fw-semibold shadow-sm" style="font-size: 12px; background-color: #2b436f; border-color: #2b436f;" data-bs-toggle="modal" data-bs-target="#modalTambahLabel">
                    + Tambah Label
                </button>
            </div>

            <!-- 3 KOTAK KARTU RINGKASAN ATAS -->
            <div class="row g-3 mb-4">
                <?php foreach ($labels as $lbl): ?>
                <div class="col-md-4">
                    <div class="status-card">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <div class="bg-<?= $lbl['warna'] ?> rounded" style="width: 22px; height: 22px; margin-top: 2px;"></div>
                            <div>
                                <div class="fw-bold text-<?= $lbl['warna'] ?>" style="font-size: 13.5px;">
                                    <?= $lbl['nama'] ?> <span class="text-muted fw-normal" style="font-size: 11px;"><?= $lbl['id'] ?></span>
                                </div>
                                <p class="text-muted mb-0" style="font-size: 11.5px; line-height: 1.3;"><?= $lbl['keterangan'] ?></p>
                            </div>
                        </div>
                        <div class="border-top pt-2 mt-3">
                            <span class="text-muted" style="font-size: 11.5px;">Jumlah Siswa</span>
                            <div class="fw-bold text-<?= $lbl['warna'] ?>" style="font-size: 17px;">
                                <?= $lbl['jumlah'] ?> <span class="fw-normal text-muted" style="font-size: 11.5px;">siswa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- TABEL DATA -->
            <div class="card border shadow-sm bg-white" style="border-radius: 8px;">
                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="font-size: 13px;">
                        <thead class="table-light text-secondary" style="font-size: 12px;">
                            <tr>
                                <th class="py-3 ps-4" width="5%">No</th>
                                <th class="py-3" width="15%">ID Label</th>
                                <th class="py-3" width="18%">Nama Label</th>
                                <th class="py-3" width="37%">Keterangan</th>
                                <th class="py-3" width="12%">Jumlah Siswa</th>
                                <th class="py-3" width="8%">Status</th>
                                <th class="py-3 pe-4 text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($labels as $lbl): ?>
                            <tr>
                                <td class="ps-4"><?= $no++ ?></td>
                                <td class="text-muted fw-semibold"><?= $lbl['id'] ?></td>
                                <td class="fw-bold text-<?= $lbl['warna'] ?>">
                                    <span class="spinner-grow spinner-grow-sm bg-<?= $lbl['warna'] ?> me-1" style="width: 6px; height: 6px;"></span> <?= $lbl['nama'] ?>
                                </td>
                                <td class="text-muted"><?= $lbl['keterangan'] ?></td>
                                <td><span class="badge bg-primary px-2 py-1" style="font-size: 11.5px;"><?= $lbl['jumlah'] ?> Siswa</span></td>
                                <td><span class="text-success fw-bold" style="font-size: 11.5px;"><?= $lbl['status'] ?></span></td>
                                <td class="pe-4 text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <!-- Tombol Edit memanggil Modal (Aman dari Error 404) -->
                                        <button type="button" class="btn btn-primary btn-sm px-2 py-0" style="font-size: 11px; background-color: #0d6efd; border-color: #0d6efd;" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEditLabel" 
                                                data-id="<?= $lbl['id'] ?>" 
                                                data-nama="<?= $lbl['nama'] ?>" 
                                                data-keterangan="<?= $lbl['keterangan'] ?>" 
                                                data-warna="<?= $lbl['warna'] ?>">
                                            Edit
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <a href="hapus_label.php?id=<?= $lbl['id'] ?>" class="btn btn-danger btn-sm px-2 py-0" style="font-size: 11px; background-color: #dc3545; border-color: #dc3545;" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            Hapus
                                        </a>
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

    <!-- MODAL TAMBAH LABEL -->
    <div class="modal fade" id="modalTambahLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="proses_tambah_label.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title fs-6 fw-bold">Tambah Kategori Label Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="font-size: 13px;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ID Label</label>
                            <input type="text" name="id_label" class="form-control form-control-sm" placeholder="Contoh: LBL004" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Label</label>
                            <input type="text" name="nama_label" class="form-control form-control-sm" placeholder="Contoh: Tertarik" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Warna Indikator</label>
                            <select name="warna" class="form-select form-select-sm" required>
                                <option value="success">Hijau (Success)</option>
                                <option value="warning">Kuning (Warning)</option>
                                <option value="danger">Merah (Danger)</option>
                                <option value="primary">Biru (Primary)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <textarea name="keterangan" class="form-control form-control-sm" rows="3" placeholder="Deskripsi singkat label..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: #2b436f; border-color: #2b436f;">Simpan Label</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT LABEL -->
    <div class="modal fade" id="modalEditLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="proses_edit_label.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title fs-6 fw-bold">Edit Kategori Label Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="font-size: 13px;">
                        <!-- Input tersembunyi untuk menyimpan ID yang akan diedit -->
                        <input type="hidden" name="id_label" id="edit-id">
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ID Label</label>
                            <input type="text" id="edit-id-show" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Label</label>
                            <input type="text" name="nama_label" id="edit-nama" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Warna Indikator</label>
                            <select name="warna" id="edit-warna" class="form-select form-select-sm" required>
                                <option value="success">Hijau (Success)</option>
                                <option value="warning">Kuning (Warning)</option>
                                <option value="danger">Merah (Danger)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <textarea name="keterangan" id="edit-keterangan" class="form-control form-control-sm" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: #0d6efd; border-color: #0d6efd;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap JS & Skrip JavaScript untuk Mengisi Data Modal Edit Otomatis -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalEditLabel = document.getElementById('modalEditLabel');
        modalEditLabel.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            
            // Ambil data dari atribut tombol Edit
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const keterangan = button.getAttribute('data-keterangan');
            const warna = button.getAttribute('data-warna');
            
            // Masukkan data ke dalam form modal
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-id-show').value = id;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-keterangan').value = keterangan;
            document.getElementById('edit-warna').value = warna;
        });
    </script>
</body>
</html>