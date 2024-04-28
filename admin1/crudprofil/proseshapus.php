<?php
include '../../database/koneksi.php';
$id_user = $_GET["id_user"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM tbl_login WHERE id_user='$id_user' ";
    $hasil_query = mysqli_query($konek, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($konek).
       " - ".mysqli_error($konek));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='../register.php';</script>";
    }