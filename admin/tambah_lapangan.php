<?php

session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

if (isset($koneksi)) {
    $conn = $koneksi;
} else {
    die('Database connection not established.');
}

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama_lapangan'];
    $jenis = $_POST['jenis_olahraga'];
    $harga = $_POST['harga_per_jam'];
    $status = $_POST['status'];

    mysqli_query(
        $conn,
        "INSERT INTO lapangan
        (
            nama_lapangan,
            jenis_olahraga,
            harga_per_jam,
            status
        )
        VALUES
        (
            '$nama',
            '$jenis',
            '$harga',
            '$status'
        )"
    );

    header("Location: lapangan.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Lapangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">

        <h2>Tambah Lapangan</h2>

        <form method="POST">

            <div class="mb-3">
                <label>Nama Lapangan</label>
                <input type="text"
                    name="nama_lapangan"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label>Jenis Olahraga</label>

                <select
                    name="jenis_olahraga"
                    class="form-control">

                    <option>Futsal</option>
                    <option>Badminton</option>
                    <option>Basket</option>
                    <option>Tennis</option>
                    <option>Voli</option>

                </select>

            </div>

            <div class="mb-3">
                <label>Harga Per Jam</label>

                <input
                    type="number"
                    name="harga_per_jam"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select
                    name="status"
                    class="form-control">

                    <option value="Aktif">
                        Aktif
                    </option>

                    <option value="Nonaktif">
                        Nonaktif
                    </option>

                </select>

            </div>

            <button
                type="submit"
                name="simpan"
                class="btn btn-primary">

                Simpan

            </button>

            <a
                href="lapangan.php"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</body>

</html>