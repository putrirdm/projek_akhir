<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_jakabaring";

$koneksi = mysqli_connect(
    $host,
    $user,
    $pass,
    $db
);

if(!$koneksi){
    die("MYSQL ERROR: " . mysqli_connect_error());
}
$conn = $koneksi;