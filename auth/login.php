<?php session_start(); include '../config/koneksi.php';
if(isset($_POST['login'])){
$e=$_POST['email']; $p=md5($_POST['password']);
$q=mysqli_query($conn,"SELECT * FROM users WHERE email='$e' AND password='$p'");
if($d=mysqli_fetch_assoc($q)){$_SESSION['user']=$d; header('Location: ../'.($d['role']=='admin'?'admin':'pelanggan').'/dashboard.php'); exit;}
$msg='Login gagal';
}
include '../templates/header.php'; ?>
<h3>Login</h3><?php if(isset($msg)) echo $msg; ?>
<form method='post'><input class='form-control mb-2' name='email'><input class='form-control mb-2' type='password' name='password'><button class='btn btn-primary' name='login'>Login</button></form>
<a href='register.php'>Register</a>
<?php include '../templates/footer.php'; ?>