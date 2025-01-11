<?php
session_start();

// Jika pengguna tidak menekan konfirmasi logout, mencegah proses logout
if (!isset($_GET['confirm']) || $_GET['confirm'] != 'yes') {
    echo "<script>
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            window.location.href = 'logout.php?confirm=yes';
        } else {
            window.location.href = 'index.php';
        }
    </script>";
    exit();
}

session_destroy(); // Menghancurkan sesi
header('Location: login.php'); // Arahkan pengguna kembali ke halaman login
exit();
?>
