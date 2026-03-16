<?php
session_start();
include 'config.php';


$user = $_POST['nama'];
$pass = $_POST['psw'];

$sql = "SELECT * FROM user where username='$user' and password='$pass' limit 0,1";

$query = mysqli_query($conn,$sql);
$result = mysqli_num_rows($query);
if ($user == "" && $pass == "") {
    header("location:login_user.php?hasil=kosong");
    die;
};

if ($result == 1) {
    $row = mysqli_fetch_assoc($query);
    // set session 
    $_SESSION['login'] = true;
    header("location:index.php");
    
    // session index.php
    $_SESSION['nama_user'] = $row['nama'];
    $_SESSION['level_user'] = $row['level'];
} elseif($result == 0) {
    header("location:login_user.php?hasil=salah");
};





