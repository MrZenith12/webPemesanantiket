<?php
include '../database/koneksi.php';
$id_destinasi = $_GET["id_destinasi"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM tbl_destinasi WHERE id_destinasi='$id_destinasi' ";
    $hasil_query = mysqli_query($konek, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($konek).
       " - ".mysqli_error($konek));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='admindestinasi.php';</script>";
    }