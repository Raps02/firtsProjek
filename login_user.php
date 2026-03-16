<?php
session_start();

if (isset($_SESSION['login'])) {
    header("location:index.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Barang</title>

    <!-- JS CSS -->
    <link rel="stylesheet" href="css/login_kasir1.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
    <link rel="stylesheet" href="alert/css/sweetalert.css">
    <script src="alert/js/sweetalert.min.js"></script>
    <script src="js/materialize.min.js"></script>

</head>
<body>

<nav>
    <div class="nav-wrapper blue">
        <img src="images/smk.png" width="500px" height="60px" class="brand-logo">

        <ul id="nav-mobile" class="right">
        <li><a class="tooltipped" data-position="bottom" data-tooltip="<?= $_SESSION['nama_user'] ?>"><i class="material-icons">account_circle</i></a></li>
        </ul>
    </div>
</nav>


    <!-- form Login -->
<div class="container login">
    <div class="row center-align">

    <div class="col s2 m1 l2 push-l4 push-m5 push-s4">
            <img src="images/IC.jpeg" width="150px" height="150px" class="admin">
    </div>

        <div class="col s5 m5 l6 push-l1 push-s3 push-m3">
            <div class="card z-depth-3 kartu">  
                <form action="check.php" method="POST">
                    <div class="card-content"><br><br><br>
                    
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" name="nama" id="NP" autocomplete="off">
                            <label for="NP">Username</label>
                        </div><br>

                        <div class="input-field">
                            <i class="material-icons prefix">vpn_key</i>
                            <input type="password" name="psw" id="pass">
                            <label for="pass">Password</label>
                        </div>

                        <label class="checkbox">
                            <input type="checkbox" name="chck" id="chck" onclick="kunciFunction()">
                            <span>Show Password</span>
                        </label>

                        <div class="input-field">
                            <button type="submit" name="login" class="btn-large waves-effect waves-light cyan accent-4" onclick="sweetFunction()">login</button>
                        </div>                    
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

if (isset($_GET['hasil'])){

    if ($_GET['hasil'] == "kosong") {
    ?> <script>
        swal("Username dan Password silahkan diisi!!!","","warning");
    </script>
    <?php
    }elseif($_GET['hasil'] == "salah"){
    ?>  <script>
        swal("Username atau Password anda Salah","Harap lebih teliti lagi","error");
    </script>
    <?php
    };
};
?>






<script>

// checkbox

    function kunciFunction() {
        
        var x =
        document.getElementById('pass');
        if (x.type === "password") {
                x.type = "text";            
        } else {
                x.type = "password";
        }        
    }




</script>