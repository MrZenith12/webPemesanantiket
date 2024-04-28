<?php
include '../../database/koneksi.php';
$id_penginapan = $_GET["id_penginapan"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM tbl_penginapan WHERE id_penginapan='$id_penginapan' ";
    $hasil_query = mysqli_query($konek, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($konek).
       " - ".mysqli_error($konek));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='../adminpenginapan.php';</script>";
    }