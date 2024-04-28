<?php
// memanggil file koneksi.php untuk melakukan koneksi database
  include '../../database/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id_user   = $_POST['id_user'];
  $username   = $_POST['username'];
  $password     = $_POST['password'];
  $no_telepon    = $_POST['no_telepon'];
  $email    = $_POST['email'];
  $role    = $_POST['role'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE tbl_login SET username = '$username', password = '$password', no_telepon = '$no_telepon', email = '$email', role = '$role' WHERE id_user = '$id_user'";
      $result = mysqli_query($konek, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($konek).
                             " - ".mysqli_error($konek));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../register.php';</script>";
      }


 
?>
