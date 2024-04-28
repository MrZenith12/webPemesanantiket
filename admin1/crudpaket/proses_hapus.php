<?php
include '../../database/koneksi.php';
$new_id_pakettour = $_GET["new_id_pakettour"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM tbl_paket WHERE new_id_pakettour='$new_id_pakettour' ";
    $hasil_query = mysqli_query($konek, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($konek).
       " - ".mysqli_error($konek));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='../adminpaket.php';</script>";
    }