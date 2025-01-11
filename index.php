<?php
session_start(); // Memulai sesi untuk melacak status login

// Cek apakah pengguna sudah login, jika belum arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$host = 'localhost';  // atau '127.0.0.1' untuk server lokal
$user = 'root';       // nama pengguna MySQL
$password = '';       // password pengguna MySQL, biasanya kosong untuk XAMPP
$dbname = 'mahasiswa'; // nama database yang ingin Anda hubungkan

$koneksi = mysqli_connect($host, $user, $password, $dbname);

if (!$koneksi) {
    die("Connection failed");
}
$nim      = "";
$nama     = "";
$alamat   = "";
$fakultas = "";
$sukses   = "";
$error    = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sqli = "DELETE FROM mahasiswa WHERE id = $id";
    $q1 = mysqli_query($koneksi, $sqli);
    if ($q1) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
if ($op == 'edit') {
    $id = $_GET['id'];

    if (empty($id) || !is_numeric($id)) {
        $error = "ID tidak valid.";
    } else {
        $sqli = "SELECT * FROM mahasiswa WHERE id = $id";
        $q1 = mysqli_query($koneksi, $sqli);

        if ($q1) {
            $r1 = mysqli_fetch_array($q1);
            if ($r1) {
                $nim = $r1['nim'];
                $nama = $r1['nama'];
                $alamat = $r1['alamat'];
                $fakultas = $r1['fakultas'];
            } else {
                $error = "Data tidak ditemukan";
            }
        } else {
            $error = "Query gagal: " . mysqli_error($koneksi);
        }
    }
}

if (isset($_POST['simpan'])) {
    $nim      = $_POST['nim'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $fakultas = $_POST['fakultas'];

    if ($nim && $nama && $alamat && $fakultas) {
        if ($op == 'edit') {
            $sql_check = "SELECT * FROM mahasiswa WHERE nim = '$nim' AND id != $id";
            $result = mysqli_query($koneksi, $sql_check);
            if (mysqli_num_rows($result) > 0) {
                $error = "Nim $nim sudah terdaftar!";
            } else {
                $sqli = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', alamat = '$alamat', fakultas = '$fakultas' WHERE id = $id";
                $q1 = mysqli_query($koneksi, $sqli);
                if ($q1) {
                    $sukses = "Data berhasil diupdate";
                } else {
                    $error = "Data gagal diupdate: " . mysqli_error($koneksi);
                }
            }
        } else {
            $sql_check = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
            $result = mysqli_query($koneksi, $sql_check);
            if (mysqli_num_rows($result) > 0) {
                $error = "Nim $nim sudah terdaftar!";
            } else {
                $sql1 = "INSERT INTO mahasiswa (nim, nama, alamat, fakultas) VALUES ('$nim', '$nama', '$alamat', '$fakultas')";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1) {
                    $sukses = "Data berhasil disimpan";
                } else {
                    $error = "Data gagal disimpan: " . mysqli_error($koneksi);
                }
            }
        }
    } else {
        $error = "Semua data harus diisi bro";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background gradient */
        body {
            background: linear-gradient(120deg, #6a11cb, #2575fc);
            color: white;
            font-family: Arial, sans-serif;
        }

        .h2,
        h2 {
            font-size: calc(1.325rem + .9vw);
            text-align: center;
        }

        /* Card container */
        .mx-auto {
            width: 900px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Card styling */
        .card {
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(8, 117, 234, 0.74);
        }

        .card-header {
            background: linear-gradient(to right, #ff512f, #dd2476);
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            border-radius: 15px 15px 0 0;
        }

        .btn-primary {
            background: linear-gradient(to right, #6a11cb, rgb(37, 123, 252));
            border: none;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:active {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transform: translateY(0);
        }

        .btn-warning {
            background: linear-gradient(to right, #ff9a8b, #ff6a88);
            border: none;
            color: white;
        }

        .btn-danger {
            background: linear-gradient(to right, #ff512f, #dd2476);
            border: none;
            color: white;
            margin-top: -90px;
        }

        .btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            text-align: center;
        }

        td {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            text-align: center;
            border-radius: 10px;
        }

        td .btn {
            margin: 2px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- Link Logout -->
        <div class="container mb-3 text-end">
            <h2>REG B 003</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Form Input Data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php endif; ?>
                <?php if ($sukses): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label text-white">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label text-white">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label text-white">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fakultas" class="col-sm-2 col-form-label text-white">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="fakultas" id="fakultas">
                                <option value="">- Pilih Kelas -</option>
                                <option value="REG B 001" <?php if ($fakultas == "REG B 001") echo "selected" ?>>REG B 001</option>
                                <option value="REG B 002" <?php if ($fakultas == "REG B 002") echo "selected" ?>>REG B 002</option>
                                <option value="REG B 003" <?php if ($fakultas == "REG B 003") echo "selected" ?>>REG B 003</option>
                                <option value="REG B 004" <?php if ($fakultas == "REG B 004") echo "selected" ?>>REG B 004</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Mahasiswa -->
        <div class="card">
            <div class="card-header">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Fakultas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM mahasiswa ORDER BY id DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $nim = $r2['nim'];
                            $nama = $r2['nama'];
                            $alamat = $r2['alamat'];
                            $fakultas = $r2['fakultas'];
                        ?>
                            <tr>
                                <td><?php echo $urut++ ?></td>
                                <td><?php echo $nim ?></td>
                                <td><?php echo $nama ?></td>
                                <td><?php echo $alamat ?></td>
                                <td><?php echo $fakultas ?></td>
                                <td>
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <button class="btn btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>