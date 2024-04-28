<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../database/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id_destinasi = $_POST['id_destinasi'];
  $kode_destinasi = $_POST['kode_destinasi'];
  $nama_destinasi   = $_POST['nama_destinasi'];
  $sisa_destinasi   = $_POST['sisa_destinasi'];
  $deskripsi     = $_POST['deskripsi'];
  $harga    = $_POST['harga'];
  $gambar_produk = $_FILES['gambar_produk']['name'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($gambar_produk != "") {
    $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_produk']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE tbl_destinasi SET kode_destinasi = '$kode_destinasi', nama_destinasi = '$nama_destinasi', sisa_destinasi = '$sisa_destinasi', deskripsi = '$deskripsi', harga = '$harga', gambar_produk = '$nama_gambar_baru' WHERE id_destinasi = '$id_destinasi' ";
                    $result = mysqli_query($konek, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("<script>alert('Kode Destinasi sudah ada yang digunakan.');window.location='admindestinasi.php';</script> ".mysqli_errno($konek).
                             " - ".mysqli_error($konek));
                    } else {
                      //tampil alert dan akan redirect ke halaman index.php
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='admindestinasi.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='edit_destinasi.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE tbl_destinasi SET kode_destinasi = '$kode_destinasi', nama_destinasi = '$nama_destinasi', sisa_destinasi = '$sisa_destinasi', deskripsi = '$deskripsi', harga = '$harga' WHERE id_destinasi = '$id_destinasi'";
      $result = mysqli_query($konek, $query);
      // periska query apakah ada error
      if(!$result){
            die ("<script>alert('Kode Destinasi sudah ada yang digunakan.');window.location='admindestinasi.php';</script> ".mysqli_errno($konek).
                             " - ".mysqli_error($konek));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='admindestinasi.php';</script>";
      }
    }

 

