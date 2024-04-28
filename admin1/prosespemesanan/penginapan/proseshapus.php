<?php
include '../../../database/koneksi.php';
$id_pesnip = $_GET["id_pesnip"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM tbl_pespenginapan WHERE id_pesnip='$id_pesnip' ";
    $hasil_query = mysqli_query($konek, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($konek).
       " - ".mysqli_error($konek));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='../../pemesanandestinasi.php';</script>";
    }