<?php
session_start();
include 'config.php';

    if (! isset($_SESSION["login"])) {
        header("location:login_user.php");
    }   
    
    $level_a = $_SESSION['level_user'] == 'Admin' ;
    $level_m = $_SESSION['level_user'] == 'Manajemen' ;
    $level_p = $_SESSION['level_user'] == 'Peminjam' ;

    $kueri = mysqli_query($conn, "SELECT * FROM barang");
 
    $data = array ();
    while (($row = mysqli_fetch_array($kueri)) != null){
      $data[] = $row;
    }
      $cont = count ($data);
      $jml = "".$cont;
  
    $kueri2 = mysqli_query($conn, "SELECT * FROM barang_masuk");
   
    $data2 = array ();
    while (($row = mysqli_fetch_array($kueri2)) != null){
      $data2[] = $row;
    }
      $cont2 = count ($data2);
      $jml2 = "".$cont2;
  
  
    $kueri3 = mysqli_query($conn, "SELECT * FROM pinjam_barang ");
   
    $data3 = array ();
    while (($row = mysqli_fetch_array($kueri3)) != null){
      $data3[] = $row;
    }
      $cont3 = count ($data3);
      $jml3 = "".$cont3;
  
    $kueri4 = mysqli_query($conn, "SELECT * FROM stok");
   
    $data4 = array ();
    while (($row = mysqli_fetch_array($kueri4)) != null){
      $data4[] = $row;
    }
      $cont4 = count ($data4);
      $jml4 = "".$cont4;
  




?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    
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
        <li><a href="user.php"><i class="material-icons">account_circle</i>User</a></li>
        
        <!-- MENU BAWAH SINI -->

    <?php
        if ($level_a) {
    ?>
        <ul class="collapsible">
            <li>
                <a class="collapsible-header">Persediaan atau Data Barang<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="dropdown/barang.php">Data Barang</a></li>
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
                <a class="collapsible-header">Data Barang<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="dropdown/barang.php">Data Barang</a></li>
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
</ul><br>


    <div class="row">
        <div class="col s8 m7 l4 push-l4 push-m3 push-s2 center">
            <img src="images/SMKN 12.png" width="270px" height="250px">
            <h5><b>Elektronik Inventory Manajemen Sistem</b></h5>
        </div>
    </div><br>
<?php 
    if($level_a || $level_m){ ?>

     <div class="row">
        <div class="col s12 m12 l12">
          <!--content data Barang-->
          <div class="col s12 m3 l3">
                    <div class="card green accent-3">
                        <div class="card-content white-text">
                          <span class="card-title">Data Barang
                              <i class="medium material-icons left">archive</i>
                              <p class="right"><?php echo $jml; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left white-text">visibility</i>
                          <a href="dropdown/barang.php" class="white-text">Lihat</a>
                        </div>
                    </div>
                  </div>

                  <!--content barang masuk-->
          <div class="col s12 m3 l3">
                    <div class="card amber darken-3">
                        <div class="card-content white-text">
                          <span class="card-title">Barang Masuk
                              <i class="medium material-icons left">archive</i>
                              <p class="right"><?php echo $jml2; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left white-text">visibility</i>
                          <a href="dropdown/barang_masuk.php" class="white-text">Lihat</a>
                        </div>
                    </div>
                  </div>

                  <!--content pinjam-->
          <div class="col s12 m3 l3">
                    <div class="card pink accent-3">
                        <div class="card-content white-text">
                          <span class="card-title">Peminjam Barang
                              <i class="medium material-icons left">school</i>
                              <p class="right"><?php echo $jml3; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left white-text">visibility</i>
                          <a href="dropdown/peminjam_barang.php" class="white-text">Lihat</a>
                        </div>
                    </div>
                  </div>

                  <!--content stok-->
          <div class="col s12 m3 l3">
                    <div class="card indigo accent-3">
                        <div class="card-content white-text">
                          <span class="card-title">Stok barang
                              <i class="medium material-icons left">dns</i>
                              <p class="right"><?php echo $jml4; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left white-text">visibility</i>
                          <a href="dropdown/stok.php" class="white-text">Lihat</a>
                        </div>
                    </div>
                  </div>

        </div>
      </div>
    <?php } ?>





        <!-- CONTENT WEBSITE -->




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


</script>   