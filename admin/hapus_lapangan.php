<?php

session_start();

$conn = null;
require_once __DIR__ . '/../config/koneksi.php';

if (!$conn) {
    die('Database connection not available.');
}

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM lapangan
    WHERE id_lapangan='$id'"
);

header("Location: lapangan.php");
exit;
