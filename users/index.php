<?php
// Data dummy untuk mensimulasikan tabel Pengguna
$data_pengguna = [
    [
        'id' => 'USR001',
        'nama' => 'Admin Sekolah',
        'username' => 'admin_tu',
        'email' => 'admin@sekolah.sch.id',
        'role' => 'Administrator',
        'role_color' => 'danger',
        'status' => 'Aktif',
        'status_color' => 'success'
    ],
    [
        'id' => 'USR002',
        'nama' => 'Budi Prasetyo, S.Pd',
        'username' => 'budi_agent',
        'email' => 'budi.agent@sekolah.sch.id',
        'role' => 'Agent CRM',
        'role_color' => 'info',
        'status' => 'Aktif',
        'status_color' => 'success'
    ],
    [
        'id' => 'USR003',
        'nama' => 'Siti Rahmawati, S.E',
        'username' => 'siti_agent',
        'email' => 'siti.agent@sekolah.sch.id',
        'role' => 'Agent CRM',
        'role_color' => 'info',
        'status' => 'Aktif',
        'status_color' => 'success'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - CRM System</title>
    
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
        .content-area { padding: 30px; flex-grow: 1; }
        
        /* TABLE STYLING */
        .table-custom th { background-color: #f1f4f9; color: #555; font-weight: 600; font-size: 12px; }
        .table-custom td { font-size: 12px; vertical-align: middle; }
        
        /* BADGE KUSTOM UNTUK AGENT CRM AGAR WARNA TEKSNYA PUTIH */
        .badge-info-custom { background-color: #72aee6; color: white; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>📈 CRM System</h4>
        
        <a href="../dashboard/index.php" style="justify-content: flex-start; gap: 10px;">🏠 Dashboard</a>
        <a href="../kunjungan/index.php" style="justify-content: flex-start; gap: 10px;">👥 Kunjungan</a>
        
        <!-- MENU CRM (Tidak Aktif karena kita di halaman Pengguna) -->
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
        
        <!-- MENU PENGGUNA AKTIF -->
        <a href="index.php" class="active" style="justify-content: flex-start; gap: 10px; border-left: 4px solid white;">🧑 Pengguna</a>
        
        <a href="../pengaturan/index.php" style="justify-content: flex-start; gap: 10px;">⚙️ Pengaturan</a>
        
        <a href="../auth/logout.php" style="position: absolute; bottom: 20px; width: 100%; justify-content: flex-start; gap: 10px;">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER -->
        <div class="top-header">
            <div>
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Manajemen Pengguna</h5>
                <span class="text-muted" style="font-size: 11.5px;">Dashboard / Pengguna Sistem</span>
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
            
            <!-- JUDUL & TOMBOL TAMBAH PENGGUNA (Memicu Modal) -->
            <div class="d-flex justify-content-between align-items-end mb-3">
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 16px;">Daftar Akun Pengguna Sistem</h6>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">Pengaturan hak akses login admin, petugas, dan agent</p>
                </div>
                <button type="button" class="btn btn-primary btn-sm px-3 py-1.5 fw-semibold shadow-sm" style="font-size: 12px; background-color: #4a628a; border-color: #4a628a;" data-bs-toggle="modal" data-bs-target="#modalTambahPengguna">
                    + Tambah Pengguna
                </button>
            </div>

            <!-- TABEL DATA PENGGUNA -->
            <div class="card border bg-white" style="border-radius: 4px;">
                <div class="table-responsive">
                    <table class="table table-custom table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="py-2 px-3 text-center" style="width: 80px;">ID User</th>
                                <th class="py-2 px-3">Nama Lengkap</th>
                                <th class="py-2 px-3">Username</th>
                                <th class="py-2 px-3">Email</th>
                                <th class="py-2 px-3 text-center">Hak Akses (Role)</th>
                                <th class="py-2 px-3 text-center">Status Akun</th>
                                <th class="py-2 px-3 text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_pengguna as $row): 
                                $badge_role_class = ($row['role_color'] == 'info') ? 'badge-info-custom' : 'bg-'.$row['role_color'];
                            ?>
                            <tr>
                                <td class="px-3 text-center text-dark"><?= $row['id'] ?></td>
                                <td class="px-3 text-dark"><?= $row['nama'] ?></td>
                                <td class="px-3 text-dark"><?= $row['username'] ?></td>
                                <td class="px-3 text-dark"><?= $row['email'] ?></td>
                                
                                <td class="px-3 text-center">
                                    <span class="badge <?= $badge_role_class ?> px-3 py-1 fw-normal" style="font-size: 11px; border-radius: 12px;">
                                        <?= $row['role'] ?>
                                    </span>
                                </td>
                                
                                <td class="px-3 text-center">
                                    <span class="badge bg-<?= $row['status_color'] ?> px-3 py-1 fw-normal" style="font-size: 11px; border-radius: 12px;">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                
                                <td class="px-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- TOMBOL EDIT: Memicu Modal Edit dan Membawa Data -->
                                        <button type="button" class="btn btn-outline-primary btn-sm px-2 py-0 text-decoration-none" style="font-size: 11px;" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditPengguna"
                                            data-id="<?= $row['id'] ?>"
                                            data-nama="<?= $row['nama'] ?>"
                                            data-username="<?= $row['username'] ?>"
                                            data-email="<?= $row['email'] ?>"
                                            data-role="<?= $row['role'] ?>"
                                            data-status="<?= $row['status'] ?>">
                                            Edit
                                        </button>
                                        
                                        <!-- Tombol Hapus -->
                                        <a href="proses_hapus_pengguna.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm px-2 py-0 text-decoration-none" style="font-size: 11px;" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">Hapus</a>
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

    <!-- MODAL TAMBAH PENGGUNA BARU -->
    <div class="modal fade" id="modalTambahPengguna" tabindex="-1" aria-labelledby="modalTambahPenggunaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div class="modal-header border-bottom-0 pb-0">
                    <h6 class="modal-title fw-bold" id="modalTambahPenggunaLabel">Tambah Pengguna Baru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses_tambah_pengguna.php" method="POST">
                    <div class="modal-body pt-3 pb-2" style="font-size: 13px;">
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Username</label>
                            <input type="text" name="username" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary mb-1">Hak Akses (Role)</label>
                                <select name="role" class="form-select form-select-sm" required style="border-radius: 6px;">
                                    <option value="Administrator">Administrator</option>
                                    <option value="Agent CRM">Agent CRM</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary mb-1">Status Akun</label>
                                <select name="status" class="form-select form-select-sm" required style="border-radius: 6px;">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0 justify-content-end">
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal" style="border-radius: 6px; background-color: #6c757d; border: none;">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 6px; background-color: #4a628a; border: none;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PENGGUNA -->
    <div class="modal fade" id="modalEditPengguna" tabindex="-1" aria-labelledby="modalEditPenggunaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div class="modal-header border-bottom-0 pb-0">
                    <h6 class="modal-title fw-bold" id="modalEditPenggunaLabel">Edit Data Pengguna</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses_edit_pengguna.php" method="POST">
                    <div class="modal-body pt-3 pb-2" style="font-size: 13px;">
                        
                        <!-- Input tersembunyi untuk ID User -->
                        <input type="hidden" name="id_user" id="edit_id_user">

                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Username</label>
                            <input type="text" name="username" id="edit_username" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Password <span class="text-muted" style="font-size: 10px;">(Kosongkan jika tidak ingin diubah)</span></label>
                            <input type="password" name="password" class="form-control form-control-sm" placeholder="***" style="border-radius: 6px;">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary mb-1">Hak Akses (Role)</label>
                                <select name="role" id="edit_role" class="form-select form-select-sm" required style="border-radius: 6px;">
                                    <option value="Administrator">Administrator</option>
                                    <option value="Agent CRM">Agent CRM</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary mb-1">Status Akun</label>
                                <select name="status" id="edit_status" class="form-select form-select-sm" required style="border-radius: 6px;">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0 justify-content-end">
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal" style="border-radius: 6px; background-color: #6c757d; border: none;">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm px-4" style="border-radius: 6px; border: none;">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SCRIPT UNTUK MENGISI DATA KE DALAM MODAL EDIT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalEdit = document.getElementById('modalEditPengguna');
            modalEdit.addEventListener('show.bs.modal', function (event) {
                // Tombol yang memicu modal
                var button = event.relatedTarget;
                
                // Ambil data dari atribut data-*
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var username = button.getAttribute('data-username');
                var email = button.getAttribute('data-email');
                var role = button.getAttribute('data-role');
                var status = button.getAttribute('data-status');
                
                // Masukkan data ke dalam input form di modal
                modalEdit.querySelector('#edit_id_user').value = id;
                modalEdit.querySelector('#edit_nama').value = nama;
                modalEdit.querySelector('#edit_username').value = username;
                modalEdit.querySelector('#edit_email').value = email;
                
                // Set nilai select option untuk Role dan Status
                modalEdit.querySelector('#edit_role').value = role;
                modalEdit.querySelector('#edit_status').value = status;
            });
        });
    </script>
</body>
</html>