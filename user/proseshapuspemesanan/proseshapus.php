<?php
include '../../database/koneksi.php';
$id_pesdes = $_GET["id_pesdes"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM tbl_pesandes WHERE id_pesdes='$id_pesdes' ";
    $hasil_query = mysqli_query($konek, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($konek).
       " - ".mysqli_error($konek));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='../pemesanan.php';</script>";
    }