<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "tripbuddy";
    
    $konek = mysqli_connect($host, $user, $pass, $database);
    
    if (!$konek) {
        die("<script>alert('Gagal tersambung dengan database.')</script>");
    }
?>