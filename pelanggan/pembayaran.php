<?php

session_start();

require_once __DIR__ . '/../config/koneksi.php';

if (!isset($conn) && isset($koneksi)) {
    $conn = $koneksi;
}

if (!isset($conn)) {
    die('Database connection not found.');
}

$id_booking = $_GET['id'];

if(isset($_POST['upload'])){

    $namaFile = $_FILES['bukti']['name'];
    $tmpFile  = $_FILES['bukti']['tmp_name'];

    $folder = "../uploads/bukti/";

    move_uploaded_file(
        $tmpFile,
        $folder . $namaFile
    );

    mysqli_query(
        $conn,
        "INSERT INTO pembayaran
        (
            id_booking,
            tanggal_bayar,
            bukti_bayar,
            status_verifikasi
        )
        VALUES
        (
            '$id_booking',
            NOW(),
            '$namaFile',
            'Pending'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE booking
        SET status='Dibayar'
        WHERE id_booking='$id_booking'"
    );

    echo "
    <script>
    alert('Bukti pembayaran berhasil dikirim');
    window.location='riwayat.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Upload Pembayaran</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Upload Bukti Pembayaran</h2>

<form method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Bukti Transfer</label>

<input
type="file"
name="bukti"
class="form-control"
required>

</div>

<button
type="submit"
name="upload"
class="btn btn-primary">

Upload

</button>

<a
href="riwayat.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</body>
</html>