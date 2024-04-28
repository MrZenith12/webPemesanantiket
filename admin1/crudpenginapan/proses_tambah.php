<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../database/koneksi.php';
// membuat variabel untuk menampung data dari form
  $kode_penginapan = $_POST['kode_penginapan'];
  $nama_penginapan   = $_POST['nama_penginapan'];
  $deskripsi_penginapan     = $_POST['deskripsi_penginapan'];
  $sisa_penginapan = $_POST['sisa_penginapan'];
  $harga_penginapan    = $_POST['harga_penginapan'];
  $fasilitas_penginapan    = $_POST['fasilitas_penginapan'];
  $gambar_penginapan = $_FILES['gambar_penginapan']['name'];


//cek dulu jika ada gambar produk jalankan coding ini
if($gambar_penginapan != "") {
  $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $gambar_penginapan); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_penginapan']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar_penginapan; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, '../gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "INSERT INTO tbl_penginapan (kode_penginapan, nama_penginapan, deskripsi_penginapan, sisa_penginapan, harga_penginapan, gambar_penginapan, fasilitas_penginapan) VALUES ( '$kode_penginapan', '$nama_penginapan', '$deskripsi_penginapan', '$sisa_penginapan', '$harga_penginapan', '$nama_gambar_baru', '$fasilitas_penginapan')";
                  $result = mysqli_query($konek, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("<script>alert('Kode Destinasi sudah digunakan.');window.location='../adminpenginapan.php';</script>".mysqli_errno($konek).
                           " - ".mysqli_error($konek));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='../adminpenginapan.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../adminpenginapan.php';</script>";
            }
} else {
   $query = "INSERT INTO tbl_penginapan (kode_penginapan, nama_penginapan, deskripsi_penginapan, sisa_penginapan, harga_penginapan, gambar_penginapan, fasilitas_penginapan) VALUES ( '$kode_penginapan', '$nama_penginapan', '$deskripsi_penginapan', '$sisa_penginapan', '$harga_penginapan', null, '$fasilitas_penginapan')";
                  $result = mysqli_query($konek, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("<script>alert('Kode Destinasi sudah digunakan.');window.location='../adminpenginapan.php';</script>".mysqli_errno($konek).
                           " - ".mysqli_error($konek));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='../adminpenginapan.php';</script>";
                  }
}
?>