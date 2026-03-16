<?php
session_start();
include 'config.php';

    if (! isset($_SESSION["login"])) {
        header("location:login_user.php");
    }   
    
    $level_a = $_SESSION['level_user'] == 'Admin' ;
    $level_m = $_SESSION['level_user'] == 'Manajemen' ;
    $level_p = $_SESSION['level_user'] == 'Peminjam' ;
    
    date_default_timezone_set('Asia/Jakarta');
    $tanggalan = date("Y/m/d");
    $tempo = date("Y/m/d", strtotime("+5 days", strtotime($tanggalan)));
    $popup = date("d F Y", strtotime("+5 days", strtotime($tanggalan)));



    $sql = mysqli_query($conn,"SELECT id_barang,nama_barang FROM barang");
    if (isset($_POST['submit'])) {
        $nama	 	    = $_POST['nama_peminjam'];
        $tgl_masuk      = $_POST['tanggal_masuk'];
        $nama_barang    = $_POST['nama_barang'];
        $jumlah         = $_POST['jumlah_barang'];
        $tgl_kembali    = $_POST['tanggal_kembali'];
        $kondisi        = $_POST['kondisi'];
    


        $hasil = "INSERT INTO pinjam_barang(peminjam, tgl_pinjam,nama_barang,jml_barang,tgl_kembali,kondisi) values('$nama','$tgl_masuk','$nama_barang','$jumlah','$tgl_kembali','$kondisi')";
        $hasil2 = "INSERT INTO barang_keluar(nama_barang, tgl_keluar,jml_keluar,penerima) values('$nama_barang','$tgl_masuk','$jumlah','$nama')";
    
        mysqli_query($conn,$hasil);
        mysqli_query($conn,$hasil2);

    }
    if (isset($_POST['submit'])) {
        $nama_barang    = $_POST['nama_barang'];
        $jumlah         = $_POST['jumlah_barang'];


        $pinjam_id = mysqli_query($conn,"SELECT * FROM `barang` ORDER BY `barang`.`id_barang` DESC");
        $check = mysqli_fetch_array($pinjam_id);
        $id_b = $check['id_barang'];
        $lok  = $check['lokasi'];
        
        $update_pinjam = "UPDATE pinjam_barang SET id_barang='$id_b' WHERE nama_barang ='$nama_barang' ";
        $update_barangklr = "UPDATE barang_keluar SET id_barang='$id_b' WHERE nama_barang = '$nama_barang'";
        $update_lok_barangklr = "UPDATE barang_keluar SET lokasi='$lok' WHERE nama_barang = '$nama_barang' ";
        $update_jmlkeluar_stok = "UPDATE stok SET jml_keluar='$jumlah' WHERE nama_barang = '$nama_barang'";
        $update_total = "UPDATE stok SET total_barang = jml_masuk - jml_keluar WHERE nama_barang='$nama_barang'";



        mysqli_query($conn,$update_pinjam);
        mysqli_query($conn,$update_barangklr);
        mysqli_query($conn,$update_lok_barangklr);
        mysqli_query($conn,$update_jmlkeluar_stok);
        mysqli_query($conn,$update_total);

    }

    $buat = "SELECT nama_barang FROM barang";
    $lihat_barang = mysqli_query($conn,$buat);



?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Peminjaman Barang</title>
    
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

    <!-- Content Side Nav -->
    <li><a href="index.php"><i class="material-icons">dashboard</i>Dashboard</a></li>
    <li><a href="user.php"><i class="material-icons">account_circle</i>User</a></li>

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
        
            <li><a href="peminjaman.php"><i class="material-icons">style</i>Pinjam Barang</a></li>

            <!-- MENU BAWAH SINI -->

    <?php } else if ($level_m){ ?>   
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
        <li><a href="laporan.php"><i class="material-icons">input</i>Generate Laporan</a></li>

    <?php } else if($level_p){ ?>

        <li><a href="peminjaman.php"><i class="material-icons">style</i>Pinjam Barang</a></li>

    <?php } ?>

        <li><a href="logout.php"><i class="material-icons">exit_to_app</i>Logout</a></li>
</ul><br>

        <!-- Tambah Barang -->
        
<form action="" method="POST">
	<div class="row">
	  <div class="col s12 m4 offset-m4">

			<!-- Form daftar  -->
            
			<div class="input-field">
				<input type="text" readonly value="<?= $_SESSION['nama_user'] ?>" id="nama_peminjam" name="nama_peminjam" autocomplete="off">
				<label for="nama_peminjam">Nama peminjam</label>
			</div>
			<div class="input-field">
				<input type="text" readonly id="tanggal_masuk" value="<?= $tanggalan ?>" name="tanggal_masuk">
				<label for="tanggal_masuk">Tanggal Pinjam</label>
			</div>
            <div class="input-field">
                <select name="nama_barang">
                <option value="" disabled selected>-Pilih salah satu-</option>
                <?php while ($barang = mysqli_fetch_array($lihat_barang)) { ?>
                <option><?= $barang['nama_barang']; } ?></option>
                </select>
                <label>Nama Barang</label>
            </div>
            <div class="input-field">
				<input type="number" min="1" max="100" id="jumlah_barang" name="jumlah_barang">
				<label for="jumlah_barang">Jumlah Pinjam</label>
			</div>
            <div class="input-field">
				<input type="text" id="tanggal_kembali" readonly value="<?= $tempo ?>" name="tanggal_kembali">
				<label for="tanggal_kembali">Tanggal Maximal barang Kembali </label>
			</div>
            <div class="input-field">
                <select name="kondisi">
                    <option value="" disabled selected>-Pilih kondisi barang-</option>
                    <option>Baik</option>
                    <option>Cukup baik</option>
                    <option>Rusak</option>
                </select>
                <label>Kondisi Barang</label>
            </div>

			<!-- Button -->
			<div class="input-field">
				<button  data-target="modal1"  class="btn-large waves-effect waves-light red modal-trigger " style="width: 100%;">Pinjam</button>
			</div>

	 	</div>
    </div>



<!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Ketentuan Peminjaman</h4>
    <h6><b>Note : Baca secara perlahan dan pahami</b></h6><br>
    <p>Barang Siapa yang meminjam sesuatu barang milik sekolah maka jaga dan hati-hati dalam <b><i>Menggunakan dan taruh barang jangan disembarang tempat.</i></b>Mohon barang dikembalikan sesuai tanggal yang tertera pada dibawah ini!. Jika melebihi batas peminjaman maka akan dikenakan denda sebesar Rp.50.000/hari. Jika barang tersebut hilang maka akan dikenakan sanksi sesuai apa yang diperintahkan oleh petugas kami dan ingat harap ini menjadi <b><i>bukti kalian meminjam barang milik sekolah maka harap diphoto atau di Screenshoot context ini dan serahkan kepada petugas kami bahwa kalian meminjam barang ini </b></i></p><br>
    <h6><b>Mohon kembalikan barang ini sebelum Tanggal <?=$popup ?></b></h6>
  </div>
  <div class="modal-footer">
    <button type="submit" name="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Setuju</button>
  </div>
</div>
</form>


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

const select = document.querySelectorAll('select');
    M.FormSelect.init(select);

const modals = document.querySelectorAll('.modal');
    M.Modal.init(modals);



</script>