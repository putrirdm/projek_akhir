<?php
require_once __DIR__ . '/../config/koneksi.php';

/** @var mysqli $koneksi */
if (!isset($koneksi)) {
    die('Database connection not established.');
}

$pesan = "";

if (isset($_POST['daftar'])) {

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama']
    );

    $email = mysqli_real_escape_string(
        $koneksi,
        $_POST['email']
    );

    $no_hp = mysqli_real_escape_string(
        $koneksi,
        $_POST['no_hp']
    );

    $password = md5($_POST['password']);

    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM users
        WHERE email='$email'"
    );

    if (mysqli_num_rows($cek) > 0) {

        $pesan = "Email sudah digunakan!";
    } else {

        mysqli_query(
            $koneksi,
            "INSERT INTO users(
                nama,
                email,
                no_hp,
                password,
                role
            )
            VALUES(
                '$nama',
                '$email',
                '$no_hp',
                '$password',
                'pelanggan'
            )"
        );

        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f4f6f9;">

    <div class="container">

        <div class="row justify-content-center mt-5">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-header bg-primary text-white">

                        <h3>Registrasi Pelanggan</h3>

                    </div>

                    <div class="card-body">

                        <?php if ($pesan != "") { ?>

                            <div class="alert alert-danger">

                                <?= $pesan; ?>

                            </div>

                        <?php } ?>

                        <form method="POST">

                            <div class="mb-3">

                                <label>Nama</label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>Email</label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>No HP</label>

                                <input
                                    type="text"
                                    name="no_hp"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>Password</label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    required>

                            </div>

                            <button
                                type="submit"
                                name="daftar"
                                class="btn btn-primary">

                                Daftar

                            </button>

                            <a
                                href="login.php"
                                class="btn btn-secondary">

                                Kembali

                            </a>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>