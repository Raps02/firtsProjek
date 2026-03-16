  <?php
session_start();
include 'config.php';

    if (! isset($_SESSION["login"])) {
        header("location:login_user.php");
    }   
    
    $level_a = $_SESSION['level_user'] == 'Admin' ;
    $level_m = $_SESSION['level_user'] == 'Manajemen' ;
    $level_p = $_SESSION['level_user'] == 'Peminjam' ;

    $hasil = mysqli_query($conn,"SELECT * FROM barang_masuk");

    $lihat = "SELECT * FROM barang";
    $melihat_hasil = mysqli_query($conn,$lihat);

    if (isset($_POST['submit'])) {
        $nama         = $_POST['nama_user'];
        $user_name    = $_POST['user_name'];
        $pass_word    = $_POST['password'];
        $akses        = $_POST['level'];
       
        include 'config.php';

        $hasil = "INSERT INTO user(nama,username, password, level) VALUES ('$nama','$user_name','$pass_word','$akses')";

        mysqli_query($conn, $hasil);
    }




?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    
    <!-- JS CSS -->
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
            <img src="images/smk.png" width="500px" height="60px" class="brand-logo">

            <ul id="nav-mobile" class="right">
            <?php if ($level_a) {?>
                <li><a href="tambah_user.php" class="tooltipped" data-position="bottom" data-tooltip="tambah user"><i class="material-icons">person_add</i></a></li>   
            <?php } ?>
                
                <li><a class="tooltipped" data-position="bottom" data-tooltip="<?= $_SESSION['nama_user'] ?>"><i class="material-icons">account_circle</i></a></li>   
            </ul>
        </div>
    </nav>
  <!-- Tambah Barang -->
        
  <form action="" method="POST">
	<div class="row">
	  <div class="col s12 m4 offset-m4">

			<!-- Form daftar  -->
			<div class="input-field">
				<input type="text" id="nama_user" name="nama_user" required autocomplete="off">
				<label for="nama_user">Nama</label>
			</div>
            <div class="input-field">
				<input type="text" id="username" required name="user_name">
				<label for="username">Username</label>
			</div>
            <div class="input-field">
				<input type="text" id="password" maxlength="13" name="password" required autocomplete="off">
				<label for="password">Password</label>
            </div>
            <div class="input-field">
                <select name="level">
                    <option value="" disabled selected>-Pilih akses pengguna-</option>
                    <option>Admin</option>
                    <option>Manajemen</option>
                    <option>Peminjam</option>
                </select>
                <label>Akses Pengguna</label>
            </div>
			<!-- Button -->
            <div class="input-field">
				<button type="submit" name="submit" class="btn-large waves-effect waves-light red" onclick="sbmFunction()" style="width: 40%;">Tambahkan</button>
			</div>
        	<div class="input-field">
				<button class="btn-large waves-effect waves-light right green" style="width: 40%; margin-top:-68px;"><a href="index.php" style="text-decoration:none; color:white;">Kembali</button></a>
			</div>

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


</script>