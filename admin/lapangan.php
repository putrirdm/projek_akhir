<?php

session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

if (!isset($conn)) {
    die("Database connection failed");
}

$data = mysqli_query(
    $conn,
    "SELECT * FROM lapangan
     ORDER BY id_lapangan DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Data Lapangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">

        <h2>Data Lapangan</h2>

        <a
            href="dashboard.php"
            class="btn btn-secondary mb-3">

            Kembali

        </a>

        <a
            href="tambah_lapangan.php"
            class="btn btn-primary mb-3">

            Tambah Lapangan

        </a>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Nama Lapangan</th>
                    <th>Jenis</th>
                    <th>Harga/Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php

                $no = 1;

                while ($d = mysqli_fetch_assoc($data)) {

                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $d['nama_lapangan']; ?></td>

                        <td><?= $d['jenis_olahraga']; ?></td>

                        <td>
                            Rp <?= number_format($d['harga_per_jam']); ?>
                        </td>

                        <td><?= $d['status']; ?></td>

                        <td>

                            <a
                                href="edit_lapangan.php?id=<?= $d['id_lapangan']; ?>"
                                class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a
                                href="hapus_lapangan.php?id=<?= $d['id_lapangan']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus Data?')">

                                Hapus

                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</body>

</html>