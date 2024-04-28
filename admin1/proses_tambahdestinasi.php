<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../database/koneksi.php';
$konek = mysqli_connect('localhost','root','','tripbuddy');

   $kode_destinasi = $_POST['kode_destinasi'];
   $nama_destinasi = $_POST['nama_destinasi'];
   $sisa_destinasi = $_POST['sisa_destinasi'];
   $id_penginapan = $_POST['id_penginapan'];
   $deskripsi = $_POST['deskripsi'];
   $harga = $_POST['harga'];
   $gambar_produk = $_FILES['gambar_produk']['name'];
   $query_cek_kodedestinasi = mysqli_query($konek, "SELECT * FROM tbl_destinasi WHERE kode_destinasi='$kode_destinasi'");
   $query_cek_kodepenginapan = mysqli_query($konek, "SELECT * FROM tbl_destinasi WHERE id_penginapan='$id_penginapan'");
   $row_destinasi = mysqli_num_rows($query_cek_kodedestinasi);
   $row_penginapan = mysqli_num_rows($query_cek_kodepenginapan);

if ($gambar_produk != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); // ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_produk); // memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_produk']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar_produk; // menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); // memindah file gambar ke folder gambar
        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            if ($row_destinasi > 0 && $row_penginapan > 0) {
             echo "<script>alert('kode destinasi dan kode penginapan sudah ada');window.location='admindestinasi.php';</script>";
            return false;
           }elseif ($row_destinasi > 0) {
            echo "<script>alert('kode destinasi sudah ada');window.location='admindestinasi.php';</script>";
            return false;
           }elseif ($row_penginapan > 0) {
             echo "<script>alert('kode penginapan sudah ada');window.location='admindestinasi.php';</script>";
            return false;
           }else {
           
            $query = "INSERT INTO tbl_destinasi ( kode_destinasi, nama_destinasi, id_penginapan, sisa_destinasi, deskripsi, harga, gambar_produk) 
                      SELECT  '$kode_destinasi', '$nama_destinasi', '$id_penginapan', '$sisa_destinasi', '$deskripsi', '$harga', '$nama_gambar_baru' 
                      FROM tbl_penginapan 
                      WHERE tbl_penginapan.id_penginapan = '$id_penginapan'";
            $result = mysqli_query($konek, $query);
              if ($result=true) {
                echo "<script>alert('data berhasil ditambah');window.location='admindestinasi.php';</script>";
              }else{
                echo "gagal";
              }
            }
        } else {
        // jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='admindestinasi.php';</script>";
    }

   
}
 else {
    if ($row_destinasi > 0 && $row_penginapan > 0) {
       echo "<script>alert('kode destinasi dan kode penginapan sudah ada');window.location='admindestinasi.php';</script>";
      return false;
     }elseif ($row_destinasi > 0) {
      echo "<script>alert('kode destinasi sudah ada');window.location='admindestinasi.php';</script>";
      return false;
     }elseif ($row_penginapan > 0) {
       echo "<script>alert('kode penginapan sudah ada');window.location='admindestinasi.php';</script>";
      return false;
     }else {
        $query = "INSERT INTO tbl_destinasi ( kode_destinasi, nama_destinasi, id_penginapan, sisa_destinasi, deskripsi, harga, gambar_produk) 
            SELECT   '$kode_destinasi', '$nama_destinasi', '$id_penginapan', '$sisa_destinasi', '$deskripsi', '$harga', null 
            FROM tbl_penginapan 
            WHERE tbl_penginapan.id_penginapan = '$id_penginapan'";
            $result = mysqli_query($konek, $query);
              if ($result=true) {
                echo "<script>alert('data berhasil ditambah');window.location='admindestinasi.php';</script>";
              }else{
                echo "gagal";
              }
            }
   
}
?>