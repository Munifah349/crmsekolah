<?php require_once '../config/database.php'; checkLogin(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>CRM Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CRM Sistem</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="../dashboard/index.php">Dashboard</a></li>
                <?php if($_SESSION['id_role'] == 1): // Role Management Sederhana ?>
                <li class="nav-item"><a class="nav-link" href="../users/index.php">Data Users</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link text-danger" href="../auth/logout.php">Logout (<?= $_SESSION['nama'] ?>)</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">