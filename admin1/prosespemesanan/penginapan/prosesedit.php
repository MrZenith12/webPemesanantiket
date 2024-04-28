<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../../database/koneksi.php';

// membuat variabel untuk menampung data dari form
$id_pesnip = $_POST['id_pesnip'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$harganip = $_POST['harganip'];
$nama_penginapan = $_POST['nama_penginapan'];
$jumlah_orang = $_POST['jumlah_orang'];
$tgl_pergi = $_POST['tgl_pergi'];
$tgl_pulang = $_POST['tgl_pulang'];
$bank = $_POST['bank'];
$no_rek = $_POST['no_rek'];
$total_harga = $_POST['total_harga'];

// jalankan query UPDATE untuk mengedit data di database
$query = "UPDATE tbl_pespenginapan 
          SET nama = '$nama', email = '$email', alamat = '$alamat', no_telepon = '$no_telepon', harganip = '$harganip', nama_penginapan = '$nama_penginapan', jumlah_orang = '$jumlah_orang', tgl_pergi = '$tgl_pergi', tgl_pulang = '$tgl_pulang', bank = '$bank', no_rek = '$no_rek', total_harga = '$total_harga'
          WHERE id_pesnip = '$id_pesnip'";
$result = mysqli_query($konek, $query);

// periksa query apakah ada error
if (!$result) {
    die("<script>alert('data sudah ada.');window.location='../../pemesananpenginapan.php';</script>" . mysqli_errno($konek) . " - " . mysqli_error($konek));
} else {
    // tampil alert dan akan redirect ke halaman index.php
    // silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah.');window.location='../../pemesananpenginapan.php';</script>";
}
