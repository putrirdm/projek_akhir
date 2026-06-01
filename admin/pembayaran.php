<?php

session_start();

require_once __DIR__ . '/../config/koneksi.php';

if (!isset($conn)) {
    die('Database connection failed');
}

$data = mysqli_query(
    $conn,
    "SELECT
        pembayaran.*,
        booking.id_booking,
        users.nama
    FROM pembayaran
    JOIN booking
        ON pembayaran.id_booking =
           booking.id_booking
    JOIN users
        ON booking.id_user =
           users.id_user
    ORDER BY pembayaran.id_pembayaran DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Verifikasi Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">

        <h2>Verifikasi Pembayaran</h2>

        <table class="table table-bordered">

            <tr>

                <th>No</th>
                <th>Pelanggan</th>
                <th>Booking</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            <?php

            $no = 1;

            while ($d = mysqli_fetch_assoc($data)) {

            ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $d['nama']; ?></td>

                    <td>#<?= $d['id_booking']; ?></td>

                    <td>

                        <a
                            href="../uploads/bukti/<?= $d['bukti_bayar']; ?>"
                            target="_blank">

                            Lihat Bukti

                        </a>

                    </td>

                    <td>

                        <?= $d['status_verifikasi']; ?>

                    </td>

                    <td>

                        <?php
                        if ($d['status_verifikasi'] == "Pending") {
                        ?>

                            <a
                                href="terima_pembayaran.php?id=<?= $d['id_pembayaran']; ?>"
                                class="btn btn-success btn-sm">

                                Terima

                            </a>

                            <a
                                href="tolak_pembayaran.php?id=<?= $d['id_pembayaran']; ?>"
                                class="btn btn-danger btn-sm">

                                Tolak

                            </a>

                        <?php
                        }
                        ?>

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