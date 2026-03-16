<?php

include 'config.php';

$id_user= $_GET['id_user'];

mysqli_query($conn,"DELETE FROM user  WHERE id_user='$id_user'");
header("location:user.php");