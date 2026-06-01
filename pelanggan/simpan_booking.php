<?php

session_start();

include '../config/koneksi.php';

if (!isset($conn)) {
    die('Database connection failed');
}

$id_user = $_SESSION['id_user'];

$id_lapangan = $_POST['id_lapangan'];
$tanggal = $_POST['tanggal'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];

$cek = mysqli_query(
    $conn,
    "SELECT *
    FROM booking
    WHERE id_lapangan='$id_lapangan'
    AND tanggal='$tanggal'
    AND (
        jam_mulai < '$jam_selesai'
        AND
        jam_selesai > '$jam_mulai'
    )"
);

if (mysqli_num_rows($cek) > 0) {

    echo "
    <script>
    alert('Jadwal sudah dibooking!');
    window.location='booking.php';
    </script>
    ";

    exit;
}

$mulai = strtotime($jam_mulai);
$selesai = strtotime($jam_selesai);

$durasi = ($selesai - $mulai) / 3600;

$dataLapangan = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
        FROM lapangan
        WHERE id_lapangan='$id_lapangan'"
    )
);

$harga = $dataLapangan['harga_per_jam'];

$total = $harga * $durasi;

mysqli_query(
    $conn,
    "INSERT INTO booking
    (
        id_user,
        id_lapangan,
        tanggal,
        jam_mulai,
        jam_selesai,
        durasi,
        total_harga,
        status
    )
    VALUES
    (
        '$id_user',
        '$id_lapangan',
        '$tanggal',
        '$jam_mulai',
        '$jam_selesai',
        '$durasi',
        '$total',
        'Pending'
    )"
);

echo "
<script>
alert('Booking Berhasil');
window.location='riwayat.php';
</script>
";
