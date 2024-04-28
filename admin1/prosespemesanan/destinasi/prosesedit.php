<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../../database/koneksi.php';

// membuat variabel untuk menampung data dari form
$id_pesdes = $_POST['id_pesdes'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$hargades = $_POST['hargades'];
$nama_destinasi = $_POST['nama_destinasi'];
$jumlah_orang = $_POST['jumlah_orang'];
$tgl_pergi = $_POST['tgl_pergi'];
$tgl_pulang = $_POST['tgl_pulang'];
$bank = $_POST['bank'];
$no_rek = $_POST['no_rek'];
$total_harga = $_POST['total_harga'];

// jalankan query UPDATE untuk mengedit data di database
$query = "UPDATE tbl_pesandes 
          SET nama = '$nama', email = '$email', alamat = '$alamat', no_telepon = '$no_telepon', hargades = '$hargades', nama_destinasi = '$nama_destinasi', jumlah_orang = '$jumlah_orang', tgl_pergi = '$tgl_pergi', tgl_pulang = '$tgl_pulang', bank = '$bank', no_rek = '$no_rek', total_harga = '$total_harga'
          WHERE id_pesdes = '$id_pesdes'";
$result = mysqli_query($konek, $query);

// periksa query apakah ada error
if (!$result) {
    die("<script>alert('data sudah ada.');window.location='../../pemesanandestinasi.php';</script>" . mysqli_errno($konek) . " - " . mysqli_error($konek));
} else {
    // tampil alert dan akan redirect ke halaman index.php
    // silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah.');window.location='../../pemesanandestinasi.php';</script>";
}
