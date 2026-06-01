<?php

session_start();

require_once __DIR__ . '/../config/koneksi.php';

if (!isset($conn) && isset($koneksi)) {
    $conn = $koneksi;
}

if (!isset($conn)) {
    die('Database connection not available.');
}

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM lapangan
        WHERE id_lapangan='$id'"
    )
);

if (isset($_POST['update'])) {

    $nama = $_POST['nama_lapangan'];
    $jenis = $_POST['jenis_olahraga'];
    $harga = $_POST['harga_per_jam'];
    $status = $_POST['status'];

    mysqli_query(
        $conn,
        "UPDATE lapangan
        SET
            nama_lapangan='$nama',
            jenis_olahraga='$jenis',
            harga_per_jam='$harga',
            status='$status'
        WHERE id_lapangan='$id'"
    );

    header("Location: lapangan.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Lapangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">

        <h2>Edit Lapangan</h2>

        <form method="POST">

            <div class="mb-3">

                <label>Nama Lapangan</label>

                <input
                    type="text"
                    name="nama_lapangan"
                    class="form-control"
                    value="<?= $data['nama_lapangan']; ?>"
                    required>

            </div>

            <div class="mb-3">

                <label>Jenis Olahraga</label>

                <input
                    type="text"
                    name="jenis_olahraga"
                    class="form-control"
                    value="<?= $data['jenis_olahraga']; ?>"
                    required>

            </div>

            <div class="mb-3">

                <label>Harga Per Jam</label>

                <input
                    type="number"
                    name="harga_per_jam"
                    class="form-control"
                    value="<?= $data['harga_per_jam']; ?>"
                    required>

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select
                    name="status"
                    class="form-control">

                    <option
                        <?= $data['status'] == "Aktif" ? "selected" : ""; ?>>
                        Aktif
                    </option>

                    <option
                        <?= $data['status'] == "Nonaktif" ? "selected" : ""; ?>>
                        Nonaktif
                    </option>

                </select>

            </div>

            <button
                name="update"
                class="btn btn-success">

                Update

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