<?php

session_start();

require_once __DIR__ . '/../config/koneksi.php';

if (!isset($conn) || !$conn) {
    die('Koneksi database gagal. Silakan periksa konfigurasi.');
}

$dataLapangan = mysqli_query(
    $conn,
    "SELECT *
    FROM lapangan
    WHERE status='Aktif'"
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Booking Lapangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">

        <h2>Booking Lapangan</h2>

        <form
            action="simpan_booking.php"
            method="POST">

            <div class="mb-3">

                <label>Lapangan</label>

                <select
                    name="id_lapangan"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Lapangan --
                    </option>

                    <?php
                    while ($lap = mysqli_fetch_assoc($dataLapangan)) {
                    ?>

                        <option
                            value="<?= $lap['id_lapangan']; ?>">

                            <?= $lap['nama_lapangan']; ?>
                            - Rp <?= number_format($lap['harga_per_jam']); ?>/Jam

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="mb-3">

                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Jam Mulai</label>

                <input
                    type="time"
                    name="jam_mulai"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Jam Selesai</label>

                <input
                    type="time"
                    name="jam_selesai"
                    class="form-control"
                    required>

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Booking

            </button>

            <a
                href="dashboard.php"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</body>

</html>