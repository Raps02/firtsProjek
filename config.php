<?php

    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $db     = "barangsmk";

    $conn = mysqli_connect("$server","$user","$pass","$db");
    mysqli_select_db($conn,$db);

    // if ($conn) {
    //     Echo "berhasil";
    // } else {
    //     echo "gagal";
    // }
    