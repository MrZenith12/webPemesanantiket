<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../database/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id_user = $_POST['id_user'];
  $username   = $_POST['username'];
  $no_telepon   = $_POST['no_telepon'];
  $email     = $_POST['email'];
  $gambarprofil = $_FILES['gambarprofil']['name'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($gambarprofil != "") {
    $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambarprofil); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambarprofil']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambarprofil; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE tbl_login SET username = '$username', no_telepon = '$no_telepon', email = '$email', gambarprofil = '$nama_gambar_baru' WHERE id_user = '$id_user' ";
                    $result = mysqli_query($konek, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("<script>alert('Kode Destinasi sudah ada yang digunakan.');window.location='profil.php';</script> ".mysqli_errno($konek).
                             " - ".mysqli_error($konek));
                    } else {
                      //tampil alert dan akan redirect ke halaman index.php
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location.href='profil.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='edit_destinasi.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE tbl_login SET username = '$username', no_telepon = '$no_telepon', email = '$email' WHERE id_user = '$id_user'";
      $result = mysqli_query($konek, $query);
      // periska query apakah ada error
      if(!$result){
            die ("<script>alert('Kode Destinasi sudah ada yang digunakan.');window.location='profil.php';</script> ".mysqli_errno($konek).
                             " - ".mysqli_error($konek));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='profil.php?id_user=$id_user';</script>";

      }
    }

 

