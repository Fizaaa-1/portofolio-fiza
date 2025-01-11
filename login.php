<?php
session_start(); // Memulai sesi untuk melacak status login

// Konfigurasi koneksi database MySQL
$host = 'localhost';  // Nama host MySQL (misal localhost)
$user = 'root';       // Username MySQL (default untuk XAMPP adalah root)
$password = '';       // Password MySQL (default untuk XAMPP adalah kosong)
$dbname = 'mahasiswa'; // Nama database (sesuaikan dengan database Anda)

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $dbname);

// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

// Daftar NIM yang sah dan password yang sesuai
$valid_usernames = array("241091700493", "233242425242");
$passwords = array("700493", "700492"); // Password yang sesuai dengan NIM pada indeks yang sama

$error = "";

if (isset($_POST['login'])) {
    // Ambil data dari form login
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_input = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Mencari indeks username yang valid
    $index = array_search($username, $valid_usernames);

    // Jika username ditemukan, cek apakah password cocok
    if ($index !== false && $password_input == $passwords[$index]) {
        // Jika username dan password cocok, set sesi dan redirect ke halaman data mahasiswa
        $_SESSION['username'] = $username;

        // Menambahkan script alert dan suara notifikasi untuk login berhasil
        echo "<script>
                var audio = new Audio('notif.mp3'); // Tentukan file audio (notif.mp3)
                audio.play(); // Mainkan suara
                audio.oncanplaythrough = function() {
                    alert('Login berhasil!'); // Tampilkan alert setelah suara siap diputar
                    window.location.href = 'index.php'; // Redirect ke halaman index.php setelah alert
                };
              </script>";
        exit();
    } else {
        // Jika login gagal, tampilkan pesan error
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Parallax Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* General Reset */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            font-family: 'Poppins', Arial, sans-serif;
        }

        p {
    margin-top: 0;
    margin-bottom: 1rem;
    text-align: center;
}

        /* Parallax Container */
        .parallax {
            position: relative;
            height: 100vh;
            perspective: 1px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Video Background */
        .parallax-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: translateZ(-1px) scale(2); /* Layer moves slower */
            z-index: -2;
        }

        .parallax-layer video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Memastikan video mengisi seluruh elemen */
    z-index: -2; /* Video tetap berada di belakang */
}


        /* Parallax Overlay */
        .parallax-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
            z-index: -1;
        }

        /* Main Content (Login Card) */
        .container {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: rgba(20, 20, 50, 0.85);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 0, 150, 0.5);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 30px rgba(255, 0, 150, 0.6), 0 -5px 30px rgba(0, 200, 255, 0.6);
            width: 100%;
            max-width: 400px;
        }

        .card-header {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(to right, #ff00d4, #00dbff);
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .form-label {
            color: white;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            padding: 10px 20px;
            color: white;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: rgba(0, 200, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 200, 255, 0.8);
        }

        .btn-primary {
            background: linear-gradient(to right, #ff00d4, #00dbff);
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            color: white;
            width: 100%;
            transition: background 0.3s ease, transform 0.3s ease;
            box-shadow: 0 5px 20px rgba(255, 0, 150, 0.6);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #00dbff, #ff00d4);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(255, 0, 150, 0.8);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        .footer a {
            color: #00dbff;
            text-decoration: none;
        }

        .footer a:hover {
            color: #ff00d4;
        }
    </style>
</head>
<body>
<div class="parallax">
    <!-- Video Background -->
    <div class="parallax-layer">
        <video autoplay muted loop>
            <source src="vidioo.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <!-- Overlay -->
    <div class="parallax-overlay"></div>
    <!-- Login Form -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                Silahkan Login  
            </div>
            <div class="card-body">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (6 angka terkhir NIM)</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                        <label class="form-check-label" for="remember_me">Ingat Saya</label>
                    </div>
                    <button type="submit" class="btn-primary" name="login">Login</button>
                </form>
            </div>
            <div class="footer">
                <span>Developed by Muhammad Fikri Fahreza</span>
                <span>Kembali ke <a href="indexx.html">Home</a></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
