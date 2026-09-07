<?php
// Data dummy untuk mensimulasikan tabel Agent
$data_agent = [
    [
        'id' => 'AGT001',
        'nama' => 'Budi Prasetyo, S.Pd',
        'email' => 'budi.agent@sekolah.sch.id',
        'hp' => '081234567891',
        'leads' => 12
    ],
    [
        'id' => 'AGT002',
        'nama' => 'Siti Rahmawati, S.E',
        'email' => 'siti.agent@sekolah.sch.id',
        'hp' => '085798765433',
        'leads' => 9
    ],
    [
        'id' => 'AGT003',
        'nama' => 'Ahmad Hidayat, M.Pd',
        'email' => 'ahmad.agent@sekolah.sch.id',
        'hp' => '081399887755',
        'leads' => 14
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Agent - CRM System</title>
    
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk Icon WhatsApp -->
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

        /* WHATSAPP LINK */
        .wa-link { color: #198754; text-decoration: none; font-weight: 500; transition: 0.2s; }
        .wa-link:hover { color: #146c43; text-decoration: underline; }
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
                <a href="riwayat_interaksi.php" style="padding-left: 45px;">Riwayat Interaksi</a>
                <a href="tahap.php" style="padding-left: 45px;">Tahap</a>
                <a href="agent.php" class="active" style="padding-left: 45px; border-left: none;">Agent</a>
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
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Agent</h5>
                <span class="text-muted" style="font-size: 11.5px;">Dashboard / CRM / Agent</span>
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
            
            <!-- JUDUL & TOMBOL TAMBAH AGENT (Memicu Modal) -->
            <div class="d-flex justify-content-between align-items-end mb-3">
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 16px;">Manajemen Agent / Petugas</h6>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">Daftar agent penanggung jawab interaksi calon siswa</p>
                </div>
                <button type="button" class="btn btn-primary btn-sm px-3 py-1.5 fw-semibold shadow-sm" style="font-size: 12px; background-color: #2b436f; border-color: #2b436f;" data-bs-toggle="modal" data-bs-target="#modalTambahAgent">
                    + Tambah Agent
                </button>
            </div>

            <!-- TABEL DATA AGENT -->
            <div class="card border bg-white" style="border-radius: 4px;">
                <div class="table-responsive">
                    <table class="table table-custom table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="py-2 px-3 text-center" style="width: 80px;">ID Agent</th>
                                <th class="py-2 px-3">Nama Agent</th>
                                <th class="py-2 px-3">email</th>
                                <th class="py-2 px-3">No HP / Whatsapp</th>
                                <th class="py-2 px-3 text-center">Jumlah Leads / Siswa</th>
                                <th class="py-2 px-3 text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_agent as $row): 
                                // Format Nomor WA: Hapus spasi/karakter non-angka, ubah 0 di depan jadi 62
                                $clean_phone = preg_replace('/[^0-9]/', '', $row['hp']);
                                if (substr($clean_phone, 0, 1) === '0') {
                                    $clean_phone = '62' . substr($clean_phone, 1);
                                }
                                $wa_link = "https://wa.me/" . $clean_phone;
                            ?>
                            <tr>
                                <td class="px-3 text-center text-dark"><?= $row['id'] ?></td>
                                <td class="px-3 text-dark"><?= $row['nama'] ?></td>
                                <td class="px-3 text-dark"><?= $row['email'] ?></td>
                                
                                <!-- Link WhatsApp -->
                                <td class="px-3 text-dark">
                                    <a href="<?= $wa_link ?>" target="_blank" class="wa-link" title="Chat via WhatsApp">
                                        <i class="fab fa-whatsapp"></i> <?= $row['hp'] ?>
                                    </a>
                                </td>
                                
                                <td class="px-3 text-center">
                                    <span class="badge bg-primary px-3 py-1 fw-normal" style="font-size: 11.5px; border-radius: 12px; background-color: #3b82f6 !important;">
                                        <?= $row['leads'] ?> Siswa
                                    </span>
                                </td>
                                <td class="px-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        
                                        <!-- TOMBOL EDIT: Memicu Modal Edit dan Membawa Data -->
                                        <button type="button" class="btn btn-outline-primary btn-sm px-2 py-0 text-decoration-none" style="font-size: 11px;" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditAgent"
                                            data-id="<?= $row['id'] ?>"
                                            data-nama="<?= $row['nama'] ?>"
                                            data-email="<?= $row['email'] ?>"
                                            data-hp="<?= $row['hp'] ?>">
                                            Edit
                                        </button>
                                        
                                        <!-- Tombol Hapus -->
                                        <a href="proses_hapus_agent.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm px-2 py-0 text-decoration-none" style="font-size: 11px;" onclick="return confirm('Apakah Anda yakin ingin menghapus agent ini?');">Hapus</a>
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

    <!-- MODAL TAMBAH AGENT BARU -->
    <div class="modal fade" id="modalTambahAgent" tabindex="-1" aria-labelledby="modalTambahAgentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
            <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div class="modal-header border-bottom-0 pb-0">
                    <h6 class="modal-title fw-bold" id="modalTambahAgentLabel">Tambah Agent Baru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses_tambah_agent.php" method="POST">
                    <div class="modal-body pt-3 pb-2" style="font-size: 13px;">
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Nama Lengkap Agent</label>
                            <input type="text" name="nama" class="form-control form-control-sm" placeholder="Budi Prasetyo, S.Pd" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Agent@sekolah.sch.id" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-secondary mb-1">No HP / WhatsApp</label>
                            <input type="text" name="hp" class="form-control form-control-sm" placeholder="0823456178" required style="border-radius: 6px;">
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

    <!-- MODAL EDIT AGENT -->
    <div class="modal fade" id="modalEditAgent" tabindex="-1" aria-labelledby="modalEditAgentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
            <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div class="modal-header border-bottom-0 pb-0">
                    <h6 class="modal-title fw-bold" id="modalEditAgentLabel">Edit Data Agent</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses_edit_agent.php" method="POST">
                    <div class="modal-body pt-3 pb-2" style="font-size: 13px;">
                        
                        <!-- Input tersembunyi untuk ID Agent -->
                        <input type="hidden" name="id_agent" id="edit_id_agent">

                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Nama Lengkap Agent</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary mb-1">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control form-control-sm" required style="border-radius: 6px;">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-secondary mb-1">No HP / WhatsApp</label>
                            <input type="text" name="hp" id="edit_hp" class="form-control form-control-sm" required style="border-radius: 6px;">
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
            var modalEdit = document.getElementById('modalEditAgent');
            modalEdit.addEventListener('show.bs.modal', function (event) {
                // Tombol yang memicu modal
                var button = event.relatedTarget;
                
                // Ambil data dari atribut data-*
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var email = button.getAttribute('data-email');
                var hp = button.getAttribute('data-hp');
                
                // Masukkan data ke dalam input form di modal
                modalEdit.querySelector('#edit_id_agent').value = id;
                modalEdit.querySelector('#edit_nama').value = nama;
                modalEdit.querySelector('#edit_email').value = email;
                modalEdit.querySelector('#edit_hp').value = hp;
            });
        });
    </script>
</body>
</html>