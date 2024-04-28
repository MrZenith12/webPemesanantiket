<?php 
  
  include '../../database/koneksi.php';

  $username   = $_POST['username'];
  $password     = $_POST['password'];
  $no_telepon    = $_POST['no_telepon'];
  $email    = $_POST['email'];
  $role    = $_POST['role'];

//cek dulu jika ada gambar produk jalankan coding ini
   $query = "INSERT INTO tbl_login (username, password, no_telepon, email, role) VALUES ('$username','$password', '$no_telepon', '$email', '$role')";
                  $result = mysqli_query($konek, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($konek).
                           " - ".mysqli_error($konek));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='../register.php';</script>";
                  }
?>