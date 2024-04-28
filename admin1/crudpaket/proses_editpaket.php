<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../database/koneksi.php';

// membuat variabel untuk menampung data dari form
$new_id_pakettour = $_POST['new_id_pakettour'];
$kode_paket = $_POST['kode_paket'];
$namapaket = $_POST['namapaket'];
$deskripsi_paket = $_POST['deskripsi_paket'];
$sisa_paket   = $_POST['sisa_paket'];
$harga_paket = $_POST['harga_paket'];
$gambar_paket = $_FILES['gambar_paket']['name'];

// cek dulu jika ada gambar produk jalankan coding ini
if ($gambar_paket != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); // ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_paket); // memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_paket']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar_paket; // menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../gambar/' . $nama_gambar_baru); // memindah file gambar ke folder gambar
        // jalankan query UPDATE untuk mengedit data di database
        $query = "UPDATE tbl_paket 
                  SET namapaket = '$namapaket', kode_paket = '$kode_paket', deskripsi_paket = '$deskripsi_paket', sisa_paket = '$sisa_paket', harga_paket = '$harga_paket', gambar_paket = '$nama_gambar_baru'
                  WHERE new_id_pakettour = '$new_id_pakettour'";
        $result = mysqli_query($konek, $query);
        // periksa query apakah ada error
        if (!$result) {
            die("<script>alert('kode paket sudah ada.');window.location='../adminpaket.php';</script>" . mysqli_errno($konek) . " - " . mysqli_error($konek));
        } else {
            // tampil alert dan akan redirect ke halaman index.php
            // silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil diubah.');window.location='../adminpaket.php';</script>";
        }
    } else {
        // jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../adminpaket.php';</script>";
    }
} else {
   // jalankan query UPDATE untuk mengedit data di database
   $query = "UPDATE tbl_paket 
             SET namapaket = '$namapaket', kode_paket = '$kode_paket', deskripsi_paket = '$deskripsi_paket', sisa_paket = '$sisa_paket', harga_paket = '$harga_paket'
             WHERE new_id_pakettour = '$new_id_pakettour'";
   $result = mysqli_query($konek, $query);
   // periksa query apakah ada error
   if(!$result){
       die ("<script>alert('kode paket sudah ada.');window.location='../adminpaket.php';</script>".mysqli_errno($konek).
            " - ".mysqli_error($konek));
   } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../adminpaket.php';</script>";
      }
    }
