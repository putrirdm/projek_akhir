<?php

require_once __DIR__ . '/../config/koneksi.php';
if (!isset($conn) && isset($koneksi)) {
    $conn = $koneksi;
}
if (!isset($conn)) {
    die('Database connection not established.');
}

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
        FROM pembayaran
        WHERE id_pembayaran='$id'"
    )
);

$id_booking = $data['id_booking'];

mysqli_query(
    $conn,
    "UPDATE pembayaran
    SET status_verifikasi='Diterima'
    WHERE id_pembayaran='$id'"
);

mysqli_query(
    $conn,
    "UPDATE booking
    SET status='Lunas'
    WHERE id_booking='$id_booking'"
);

header("Location: pembayaran.php");