<?php
session_start();
include 'config.php';

    if (! isset($_SESSION["login"])) {
        header("location: login_user.php");
    }   
    
    $level_a = $_SESSION['level_user'] == 'Admin' ;
    $level_m = $_SESSION['level_user'] == 'Manajemen' ;
    $level_p = $_SESSION['level_user'] == 'Peminjam' ;

    $sql_user = mysqli_query($conn,"SELECT * FROM user");

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>User</title>
    
    <!-- JS CSS -->
    <link rel="stylesheet" href="css/index10.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
    <link rel="stylesheet" href="alert/css/sweetalert.css">
    <script src="alert/js/sweetalert.min.js"></script>
    <script src="js/materialize.min.js"></script>

    
</head>
<body bgcolor="#fafafa">
    <!-- Navbar -->
    <nav>
        <div class="nav-wrapper blue">
            <a href="#" data-target="slide-out" name="contoh" class="sidenav-trigger show-on-large"><li class="material-icons">menu</li></a>
            <img src="images/smk.png" width="500px" height="60px" class="brand-logo">

            <ul id="nav-mobile" class="right">
            <?php if ($level_a) {?>
                <li><a href="tambah_user.php" class="tooltipped" data-position="bottom" data-tooltip="tambah user"><i class="material-icons">person_add</i></a></li>   
            <?php } ?>
                
                <li><a class="tooltipped" data-position="bottom" data-tooltip="<?= $_SESSION['nama_user'] ?>"><i class="material-icons">account_circle</i></a></li>   
            </ul>
        </div>
    </nav>
    
    <!-- sidenav -->
    <ul id="slide-out" class="sidenav"> 
        <li>
            <div class="user-view center">

                <div class="background">
                    <img src="images/bgprofile.png" width="300px" height="200px">
                </div>

                <a href="#user"><img src="images/user.png" class="circle icon"></a>
                <a><span class="dark-text name "><?= $_SESSION['nama_user'] ?></span></a><br>
            </div>
        </li>

        <li><a href="index.php"><i class="material-icons">dashboard</i>Dashboard</a></li>
        
        <!-- MENU BAWAH SINI -->

    <?php
        if ($level_a) {
    ?>
        <ul class="collapsible">
            <li>
            <a class="collapsible-header">Persediaan atau Data Barang<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="dropdown/barang.php">Data barang</a></li>                    
                        <li><a href="dropdown/stok.php">Stok barang</a></li>
                        <li><a href="dropdown/barang_masuk.php">Barang masuk</a></li>
                        <li><a href="dropdown/barang_keluar.php">Barang keluar</a></li>
                        <li><a href="dropdown/peminjam_barang.php">Peminjam barang</a></li>
                        <li><a href="dropdown/supiler.php">Suplier barang</a></li>
                    </ul>
                </div>
            </li>
        </ul>

            <!-- SAMPAI DISINI -->
        
        <li><a href="peminjaman_barang.php"><i class="material-icons">style</i>Pinjam Barang</a></li>

            <!-- MENU BAWAH SINI -->

    <?php } else if ($level_m){ ?>   
        <ul class="collapsible">
            <li>
            <a class="collapsible-header">Persediaan atau Data Barang<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="dropdown/barang.php">Data barang</a></li>                    
                        <li><a href="dropdown/stok.php">Stok barang</a></li>
                        <li><a href="dropdown/barang_masuk.php">Barang masuk</a></li>
                        <li><a href="dropdown/barang_keluar.php">Barang keluar</a></li>
                        <li><a href="dropdown/peminjam_barang.php">Peminjam barang</a></li>
                        <li><a href="dropdown/supiler.php">Suplier barang</a></li>
                    </ul>
                </div>
            </li>
        </ul>
            <!-- SAMPAI DISINI -->
        

    <?php } else if($level_p){ ?>

        <li><a href="peminjaman_barang.php"><i class="material-icons">style</i>Pinjam Barang</a></li>

    <?php } ?>

        <li><a href="logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul>

 <?php if ($level_m) { ?>
        <button  class="btn waves-effect waves-light green" style="margin-top:20px;" onclick="print_d()"><i class="material-icons prefix">print</i></button>
    <?php } ?>

<br>
        <!-- Tabel -->
    <table class="responsive-table striped centered ">
        <thead>
            <tr>
                <th>No </th>
                <th>Id User</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Akses</th>
        <?php if ($level_a) { ?>
                <th>Edit</th>
        <?php } ?>
                
            </tr>  
        </thead>   
        <tbody>        
            <?php
    
                $no = 1;
                while ($user = mysqli_fetch_array($sql_user)) {
                    
                    echo "<tr>";
                        echo "<td>".$no ++. "</td>";
                        echo "<td>".$user['id_user']."</td>";
                        echo "<td>".$user['nama']."</td>";
                        echo "<td>".$user['username']."</td>";
                        echo "<td>".$user['password']."</td>";
                        echo "<td>".$user['level']."</td>";
                if ($level_a) {
                        echo "
                        <td><a class='tooltipped material-icons' data-position='bottom' data-tooltip='delete' href='delete_user.php?id_user=$user[id_user]'>delete</a> <a href='edit_user.php?id_user=$user[id_user]'class='tooltipped material-icons' data-position='bottom' data-tooltip='edit'>edit</a> </td>";
                    echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
   
    
    







</body>
</html>

<script type="text/javascript">

const sideNav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(sideNav,{
        preventScrolling:true,
        edge: 'left', // Choose the horizontal origin
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true // Choose whether you can drag to open on touch screens
    });

const tooltips = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(tooltips);

const dropdown = document.querySelectorAll('.collapsible');
    M.Collapsible.init(dropdown);

    function print_d(){
        window.open("print_user.php","_blank");
    }


</script>