<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../database/koneksi.php';

// membuat variabel untuk menampung data dari form
$id_penginapan = $_POST['id_penginapan'];
$kode_penginapan = $_POST['kode_penginapan'];
$nama_penginapan = $_POST['nama_penginapan'];
$deskripsi_penginapan = $_POST['deskripsi_penginapan'];
$sisa_penginapan = $_POST['sisa_penginapan'];
$harga_penginapan = $_POST['harga_penginapan'];
$gambar_penginapan = $_FILES['gambar_penginapan']['name'];

// cek dulu jika ada gambar produk jalankan coding ini
if ($gambar_penginapan != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); // ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_penginapan); // memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_penginapan']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar_penginapan; // menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../gambar/' . $nama_gambar_baru); // memindah file gambar ke folder gambar
        // jalankan query UPDATE untuk mengedit data di database
        $query = "UPDATE tbl_penginapan 
                  SET kode_penginapan = '$kode_penginapan', nama_penginapan = '$nama_penginapan', deskripsi_penginapan = '$deskripsi_penginapan', sisa_penginapan = '$sisa_penginapan', harga_penginapan = '$harga_penginapan', gambar_penginapan = '$nama_gambar_baru'
                  WHERE id_penginapan = '$id_penginapan'";
        $result = mysqli_query($konek, $query);
        // periksa query apakah ada error
        if (!$result) {
            die("<script>alert('kode penginapan sudah ada.');window.location='../adminpenginapan.php';</script>" . mysqli_errno($konek) . " - " . mysqli_error($konek));
        } else {
            // tampil alert dan akan redirect ke halaman index.php
            // silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil diubah.');window.location='../adminpenginapan.php';</script>";
        }
    } else {
        // jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../adminpenginapan.php';</script>";
    }
} else {
   // jalankan query UPDATE untuk mengedit data di database
   $query = "UPDATE tbl_penginapan 
             SET kode_penginapan = '$kode_penginapan', nama_penginapan = '$nama_penginapan', deskripsi_penginapan = '$deskripsi_penginapan', sisa_penginapan = '$sisa_penginapan', harga_penginapan = '$harga_penginapan'
             WHERE id_penginapan = '$id_penginapan'";
   $result = mysqli_query($konek, $query);
   // periksa query apakah ada error
   if(!$result){
       die ("<script>alert('kode penginapan sudah ada.');window.location='../adminpenginapan.php';</script>".mysqli_errno($konek).
            " - ".mysqli_error($konek));
   } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../adminpenginapan.php';</script>";
      }
    }
