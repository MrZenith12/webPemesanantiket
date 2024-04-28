<?php
include '../../../database/koneksi.php';
$id_pesket = $_GET["id_pesket"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM tbl_pespaket WHERE id_pesket='$id_pesket' ";
    $hasil_query = mysqli_query($konek, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($konek).
       " - ".mysqli_error($konek));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='../../pemesananpaket.php';</script>";
    }