<?php
    include 'config.php';

    $file = mysqli_query($conn,"SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Dokumen</title>

     <link rel="stylesheet" href="css/index10.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="iconfont/material-icons.css">
    <link rel="stylesheet" href="alert/css/sweetalert.css">
    <script src="alert/js/sweetalert.min.js"></script>
    <script src="js/materialize.min.js"></script>

</head>
<body>
<table class="responsive-table border centered ">
<thead>
            <tr>
                <th>No </th>
                <th>Id User</th>
                <th>Nama </th>
                <th>Username</th>
                <th>Password</th>
                <th>Akses</th>
            </tr>  
        </thead>
        <tbody>
            <?php
                $no = 1;
                    while ($user = mysqli_fetch_array($file)) {
                        
                        echo "<tr>";
                            echo "<td>".$no ++. "</td>";
                            echo "<td>".$user['id_user']."</td>";
                            echo "<td>".$user['nama']."</td>";
                            echo "<td>".$user['username']."</td>";
                            echo "<td>".$user['password']."</td>";
                            echo "<td>".$user['level']."</td>";
                }
            ?>
        </tbody>
    
    </table>

</body>
</html>
<script>
    window.load = print_d();
        function print_d(){
        window.print();
        }   
</script>
