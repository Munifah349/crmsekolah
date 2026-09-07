<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CRM Siswa - CRM System</title>
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
        .form-card { background-color: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
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
                <h5 class="m-0 text-dark fw-bold" style="font-size: 18px;">Form CRM Siswa</h5>
                <span class="text-muted" style="font-size: 11.5px;">Dashboard / CRM / Form CRM</span>
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
            <div class="form-card">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h6 class="fw-bold text-dark m-0" style="font-size: 15px;">From Input Interaksi Calon Siswa</h6>
                    <a href="riwayat_interaksi.php" class="btn btn-outline-secondary btn-sm text-decoration-none" style="font-size: 11.5px;">
                        ← Kembali ke Riwayat
                    </a>
                </div>

                <form action="proses_tambah_interaksi.php" method="POST">
                    <div class="row g-3" style="font-size: 13px;">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">ID Calon Siswa</label>
                                <div class="col-sm-8">
                                    <input type="text" name="id_siswa" class="form-control form-control-sm" value="CRM001" readonly style="background-color: #e9ecef;">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Nama Calon Siswa</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama_siswa" class="form-control form-control-sm" placeholder="Budi Santoso" required>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Asal Sekolah</label>
                                <div class="col-sm-8">
                                    <input type="text" name="asal_sekolah" class="form-control form-control-sm" placeholder="Nama Sekolah">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Nama Orang Tua</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama_ortu" class="form-control form-control-sm" placeholder="Bpk. Santoso">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">NO HP / WA</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_hp" class="form-control form-control-sm" placeholder="0812345678" required>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" name="kota" class="form-control form-control-sm" placeholder="Jakarta">
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Jalur Daftar</label>
                                <div class="col-sm-8">
                                    <select name="jalur_daftar" class="form-select form-select-sm">
                                        <option value="Reguler / Prestasi">Reguler / Prestasi</option>
                                        <option value="Beasiswa">Beasiswa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Sumber Info</label>
                                <div class="col-sm-8">
                                    <select name="sumber_info" class="form-select form-select-sm">
                                        <option value="Brosur / Sosmed">Brosur / Sosmed</option>
                                        <option value="Rekomendasi">Rekomendasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Status</label>
                                <div class="col-sm-8">
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="Konsultasi Pendaftaran">Konsultasi Pendaftaran</option>
                                        <option value="Minat">Minat</option>
                                        <option value="Deal">Deal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Biaya / SPP (Rp)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="biaya_spp" class="form-control form-control-sm" placeholder="Nominal SPP">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold text-secondary">Tgl Follow Up</label>
                                <div class="col-sm-8">
                                    <input type="date" name="tgl_followup" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi Sesuai Desain (Reset, Update, Simpan Baru) -->
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="reset" class="btn btn-secondary btn-sm px-4 text-white" style="font-size: 12px; background-color: #6c757d;">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 text-white" style="font-size: 12px; background-color: #0d6efd; border-color: #0d6efd;">Simpan Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>