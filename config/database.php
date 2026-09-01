<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crm_sekolah";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi Database Gagal: " . $conn->connect_error);
}

function checkLogin() {
    if (!isset($_SESSION['id_user'])) {
        header("Location: ../auth/login.php");
        exit;
    }
}
?>