<?php include '../config/koneksi.php';
if(isset($_POST['simpan'])){
$n=$_POST['nama'];$e=$_POST['email'];$p=md5($_POST['password']);
mysqli_query($conn,"INSERT INTO users(nama,email,password,role) VALUES('$n','$e','$p','pelanggan')");
header('Location: login.php'); exit;
} include '../templates/header.php'; ?>
<form method='post'><input class='form-control mb-2' name='nama'><input class='form-control mb-2' name='email'><input class='form-control mb-2' type='password' name='password'><button name='simpan'>Daftar</button></form>
<?php include '../templates/footer.php'; ?>