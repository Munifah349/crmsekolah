<?php
// require_once '../config/database.php';
// checkLogin(); // Aktifkan jika ada sistem auth

// Simulasi data kartu tahapan CRM
$tahap_cards = [
    [
        'no' => '1', 
        'nama' => 'Kontak Baru (New Lead)', 
        'keterangan' => 'Calon siswa baru masuk dari brosur, sosmed, atau rekomendasi.', 
        'jumlah' => 18, 
        'warna' => 'primary'
    ],
    [
        'no' => '2', 
        'nama' => 'Follow Up / Konsultasi', 
        'keterangan' => 'Tahap komunikasi aktif minat calon siswa.', 
        'jumlah' => 29, 
        'warna' => 'warning'
    ],
    [
        'no' => '3', 
        'nama' => 'Deal / Registrasi', 
        'keterangan' => 'Calon siswa sudah melakukan pendaftaran / pembayaran.', 
        'jumlah' => 25, 
        'warna' => 'success'
    ]
];

// Simulasi data tabel siswa berdasarkan tahapan
// Catatan: Nomor HP bisa menggunakan format 08... atau 628...
$data_siswa = [
    [
        'id' => 'S001',
        'nama' => 'Budi Santoso',
        'kontak' => '081234567891',
        'asal_sekolah' => 'SMPN 1 Jakarta',
        'tahap' => '1 Kontak Baru',
        'tahap_val' => '1 Kontak Baru',
        'tahap_warna' => 'primary',
        'label' => 'Minat',
        'label_warna' => 'success',
        'agent' => 'Budi Prasetyo, S.Pd<br><span class="text-muted" style="font-size: 10.5px;">AGT001</span>',
        'tgl_masuk' => '30/08/2026'
    ],
    [
        'id' => 'S002',
        'nama' => 'Siti Aminah',
        'kontak' => '085798765432',
        'asal_sekolah' => 'SMPN 2 Bandung',
        'tahap' => '2 Follow Up / Konsultasi',
        'tahap_val' => '2 Follow Up / Konsultasi',
        'tahap_warna' => 'warning text-dark',
        'label' => 'Ragu',
        'label_warna' => 'danger',
        'agent' => 'Siti Rahmawati, S.E<br><span class="text-muted" style="font-size: 10.5px;">AGT002</span>',
        'tgl_masuk' => '29/08/2026'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tahap CRM - CRM System</title>
    
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
        
        /* CUSTOM STAGE CARD */
        .stage-card {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 15px;
            background-color: white;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        
        /* Gaya Tautan WhatsApp */
        .whatsapp-link {
            color: #198754;
            text-decoration: none;
            font-size: 11.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }
        .whatsapp-link:hover {
            color: #146c43;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- MENU CRM (Submenu Tahap Aktif) -->
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
                <a href="tahap.php" class="active" style="padding-left: 45px; border-left: none;">Tahap</a>
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
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Tahap CRM</h5>
                <span class="text-muted" style="font-size: 11.5px;">Dashboard / CRM / Tahap CRM</span>
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
            
            <!-- INFORMASI & TOMBOL TAMBAH TAHAP -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 15px;">Manajemen Tahapan CRM</h6>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">Kelola dan pantau pergerakan calon siswa pada setiap tahapan proses CRM.</p>
                </div>
                <button type="button" class="btn btn-primary btn-sm px-3 py-1.5 fw-semibold shadow-sm" style="font-size: 12px; background-color: #2b436f; border-color: #2b436f;" data-bs-toggle="modal" data-bs-target="#modalTambahTahap">
                    + Tambah Tahap
                </button>
            </div>

            <!-- 3 KOTAK KARTU TAHAPAN DI ATAS -->
            <div class="row g-3 mb-4">
                <?php foreach ($tahap_cards as $card): ?>
                <div class="col-md-4">
                    <div class="stage-card">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="rounded-circle bg-<?= $card['warna'] == 'warning' ? 'warning text-dark' : $card['warna'] ?> d-inline-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0" style="width: 20px; height: 20px; font-size: 11px; margin-top: 2px;">
                                <?= $card['no'] ?>
                            </span>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 13px; line-height: 1.2;">
                                    <?= $card['nama'] ?>
                                </div>
                                <p class="text-muted mb-0 mt-1" style="font-size: 11px; line-height: 1.3;"><?= $card['keterangan'] ?></p>
                            </div>
                        </div>
                        <div class="border-top pt-2 mt-3">
                            <span class="text-muted" style="font-size: 11px;">Total Siswa</span>
                            <div class="fw-bold text-dark" style="font-size: 15px;">
                                <?= $card['jumlah'] ?> <span class="fw-normal text-muted" style="font-size: 11px;">Siswa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- TABEL DATA SISWA BERDASARKAN TAHAP -->
            <div class="card border shadow-sm bg-white" style="border-radius: 8px;">
                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="font-size: 13px;">
                        <thead class="table-light text-secondary" style="font-size: 11.5px;">
                            <tr>
                                <th class="py-3 ps-4" width="5%">No</th>
                                <th class="py-3" width="20%">Nama Siswa</th>
                                <th class="py-3" width="18%">Asal Sekolah</th>
                                <th class="py-3" width="17%">Tahap Saat Ini</th>
                                <th class="py-3" width="10%">Label Status</th>
                                <th class="py-3" width="15%">Agent</th>
                                <th class="py-3" width="10%">Tgl Masuk</th>
                                <th class="py-3 pe-4 text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1; 
                            foreach ($data_siswa as $siswa): 
                                // Membersihkan nomor telepon untuk format internasional WhatsApp (ubah '0' di depan menjadi '62')
                                $clean_phone = preg_replace('/[^0-9]/', '', $siswa['kontak']);
                                if (substr($clean_phone, 0, 1) === '0') {
                                    $clean_phone = '62' . substr($clean_phone, 1);
                                }
                                
                                // Pesan otomatis saat chat WhatsApp dibuka
                                $wa_message = urlencode("Halo {$siswa['nama']}, kami dari Tim CRM Sekolah ingin mengonfirmasi perkembangan informasi pendaftaran Anda.");
                            ?>
                            <tr>
                                <td class="ps-4"><?= $no++ ?></td>
                                <td>
                                    <span class="fw-bold text-dark"><?= $siswa['nama'] ?></span><br>
                                    <!-- Nomor HP yang bisa diklik langsung mengarah ke WhatsApp -->
                                    <a href="https://wa.me/<?= $clean_phone ?>?text=<?= $wa_message ?>" target="_blank" class="whatsapp-link" title="Kirim Pesan WhatsApp">
                                        <i class="fab fa-whatsapp text-success"></i> <?= $siswa['kontak'] ?>
                                    </a>
                                </td>
                                <td class="text-muted"><?= $siswa['asal_sekolah'] ?></td>
                                <td>
                                    <span class="badge bg-<?= $siswa['tahap_warna'] ?> px-2 py-1 fw-normal" style="font-size: 11.5px;"><?= $siswa['tahap'] ?></span>
                                </td>
                                <td>
                                    <span class="text-<?= $siswa['label_warna'] ?> fw-bold" style="font-size: 12px;"><?= $siswa['label'] ?></span>
                                </td>
                                <td><?= $siswa['agent'] ?></td>
                                <td class="text-muted" style="font-size: 12px;"><?= $siswa['tgl_masuk'] ?></td>
                                <td class="pe-4 text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <!-- Tombol Edit Interaktif memanggil Modal -->
                                        <button type="button" class="btn btn-primary btn-sm px-2 py-0" style="font-size: 11px; background-color: #0d6efd; border-color: #0d6efd;" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEditSiswa" 
                                                data-id="<?= $siswa['id'] ?>"
                                                data-nama="<?= $siswa['nama'] ?>"
                                                data-sekolah="<?= $siswa['asal_sekolah'] ?>"
                                                data-tahap="<?= $siswa['tahap_val'] ?>">
                                            Edit
                                        </button>
                                        <!-- Tombol Hapus -->
                                        <a href="hapus_siswa.php?id=<?= $siswa['id'] ?>" class="btn btn-danger btn-sm px-2 py-0" style="font-size: 11px; background-color: #dc3545; border-color: #dc3545;" onclick="return confirm('Yakin ingin menghapus data ini?')">
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

    <!-- MODAL TAMBAH TAHAP -->
    <div class="modal fade" id="modalTambahTahap" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="proses_tambah_tahap.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title fs-6 fw-bold">Tambah Tahap CRM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="font-size: 13px;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Tahap</label>
                            <input type="text" name="nama_tahap" class="form-control form-control-sm" placeholder="Follow Up / Konsultasi" required>
                        </div>
                         <div class="mb-3">
                            <label class="form-label fw-semibold">Urutan Tahap</label>
                            <input type="text" name="nama_tahap" class="form-control form-control-sm" placeholder="1, 2, 3..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="keterangan" class="form-control form-control-sm" rows="3" placeholder="Tahap komunikasi aktif minat calon siswa" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: #2b436f; border-color: #2b436f;">Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT SISWA/TAHAP -->
    <div class="modal fade" id="modalEditSiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="proses_edit_siswa.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title fs-6 fw-bold">Edit Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="font-size: 13px;">
                        <input type="hidden" name="id_siswa" id="edit-id-siswa">
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Siswa</label>
                            <input type="text" id="edit-nama-siswa" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Asal Sekolah</label>
                            <input type="text" id="edit-sekolah-siswa" class="form-control form-control-sm" disabled>
                        </div>
                         <div class="mb-3">
                            <label class="form-label fw-semibold">No HP</label>
                            <input type="text" id="edit-no-siswa" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Tahap CRM Saat Ini</label>
                            <select name="tahap_crm" id="edit-tahap-siswa" class="form-select form-select-sm" required>
                                <option value="1 Kontak Baru">1 Kontak Baru (New Lead)</option>
                                <option value="2 Follow Up / Konsultasi">2 Follow Up / Konsultasi</option>
                                <option value="3 Deal / Registrasi">3 Deal / Registrasi</option>
                            </select>
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

    <!-- Script Bootstrap JS & Skrip JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalEditSiswa = document.getElementById('modalEditSiswa');
        modalEditSiswa.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const sekolah = button.getAttribute('data-sekolah');
            const tahap = button.getAttribute('data-tahap');
            
            document.getElementById('edit-id-siswa').value = id;
            document.getElementById('edit-nama-siswa').value = nama;
            document.getElementById('edit-sekolah-siswa').value = sekolah;
            document.getElementById('edit-tahap-siswa').value = tahap;
        });
    </script>
</body>
</html>