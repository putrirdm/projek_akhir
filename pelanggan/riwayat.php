<?php

session_start();

$conn = null;
include '../config/koneksi.php';

$id_user = $_SESSION['id_user'];

// Ensure a mysqli connection variable named $conn is available.
// Some koneksi.php files use $koneksi as the connection variable.
if ($conn === null && isset($koneksi)) {
    $conn = $koneksi;
}

if ($conn === null) {
    die('Database connection not established.');
}

$data = mysqli_query(
    $conn,
    "SELECT
        booking.*,
        lapangan.nama_lapangan
    FROM booking
    JOIN lapangan
    ON booking.id_lapangan =
       lapangan.id_lapangan
    WHERE booking.id_user='$id_user'
    ORDER BY booking.id_booking DESC"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Riwayat Booking</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Riwayat Booking</h2>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Lapangan</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Total</th>
<th>Status</th>

</tr>

<?php

$no=1;

while($d=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama_lapangan']; ?></td>

<td><?= $d['tanggal']; ?></td>

<td>

<?= $d['jam_mulai']; ?>

-

<?= $d['jam_selesai']; ?>

</td>

<td>

Rp <?= number_format($d['total_harga']); ?>

</td>

<td>

<?= $d['status']; ?>

</td>

</tr>

<?php } ?>

</table>

<a
href="dashboard.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</body>
</html>