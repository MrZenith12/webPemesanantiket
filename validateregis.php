<?php
    include ('database/koneksi.php');


    $gambarawal = "person.png";
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $no_telepon = $_POST['no_telepon'];
        $email = $_POST['email'];

        $sql = "INSERT INTO tbl_login (username, password, no_telepon, email, gambarprofil, role)
                VALUES ('$username', '$password', '$no_telepon', '$email', '$gambarawal', 'user')";

        $query = mysqli_query($konek, $sql) or die (mysqli_error($konek));

        if($query){
            echo "<script>alert('data berhasil ditambah');window.location='register.php';</script>";
            header("Location:register.php");
        }
    }
?>