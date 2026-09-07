<?php
// Memanggil file koneksi database jika ada
// require_once '../config/database.php';

// Cek apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form modal edit
    $id_label   = $_POST['id_label'];
    $nama_label = $_POST['nama_label'];
    $warna      = $_POST['warna'];
    $keterangan = $_POST['keterangan'];

    // TODO: Masukkan logika update database di sini
    // Contoh query SQL:
    // $sql = "UPDATE label_status SET nama_label = '$nama_label', warna = '$warna', keterangan = '$keterangan' WHERE id_label = '$id_label'";
    // mysqli_query($conn, $sql);

    // Setelah berhasil disimpan, arahkan kembali ke halaman label status
    header("Location: label_status.php?pesan=sukses_edit");
    exit();
} else {
    // Jika diakses secara langsung tanpa form, kembalikan ke halaman utama
    header("Location: label_status.php");
    exit();
}
?>