<?php
session_start();
include '../config/koneksi.php';

if (!isset($koneksi)) {
    die("Database connection failed");
}

if (isset($_SESSION['id_user'])) {

    if ($_SESSION['role'] == 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../pelanggan/dashboard.php");
    }

    exit;
}

$error = "";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string(
        $koneksi,
        $_POST['email']
    );

    $password = md5($_POST['password']);

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM users
        WHERE email='$email'
        AND password='$password'"
    );

    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../pelanggan/dashboard.php");
        }

        exit;
    } else {
        $error = "Email atau Password Salah!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Jakabaring Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f4f6f9;">

    <div class="container">

        <div class="row justify-content-center mt-5">

            <div class="col-md-5">

                <div class="card shadow">

                    <div class="card-header bg-success text-white text-center">

                        <h3>Jakabaring Sport Center</h3>

                    </div>

                    <div class="card-body">

                        <?php if ($error != "") { ?>

                            <div class="alert alert-danger">

                                <?= $error; ?>

                            </div>

                        <?php } ?>

                        <form method="POST">

                            <div class="mb-3">

                                <label>Email</label>

                                <input
                                    type="email"
                                    name="email"
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

                            <div class="d-grid">

                                <button
                                    type="submit"
                                    name="login"
                                    class="btn btn-success">

                                    Login

                                </button>

                            </div>

                        </form>

                        <hr>

                        <div class="text-center">

                            Belum punya akun?

                            <a href="register.php">

                                Daftar Sekarang

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>