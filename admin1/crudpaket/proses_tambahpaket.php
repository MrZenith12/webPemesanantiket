<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../database/koneksi.php';
$konek = mysqli_connect('localhost','root','','tripbuddy');

   $kode_paket = $_POST['kode_paket'];
   $namapaket = $_POST['namapaket'];
   $id_destinasi = $_POST['id_destinasi'];
   $deskripsi_paket = $_POST['deskripsi_paket'];
   $sisa_paket = $_POST['sisa_paket'];
   $harga_paket = $_POST['harga_paket'];
   $gambar_paket = $_FILES['gambar_paket']['name'];
   $query_cek_kodepaket = mysqli_query($konek, "SELECT * FROM tbl_paket WHERE kode_paket='$kode_paket'");
   $query_cek_kodedestinasi = mysqli_query($konek, "SELECT * FROM tbl_paket WHERE id_destinasi='$id_destinasi'");
   $row_paket = mysqli_num_rows($query_cek_kodepaket);
   $row_destinasi = mysqli_num_rows($query_cek_kodedestinasi);

if ($gambar_paket != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); // ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_paket); // memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_paket']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar_paket; // menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../gambar/' . $nama_gambar_baru); // memindah file gambar ke folder gambar
        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            if ($row_paket > 0 && $row_destinasi > 0) {
             echo "<script>alert('kode paket dan kode destinasi sudah ada');window.location='../adminpaket.php';</script>";
            return false;
           }elseif ($row_paket > 0) {
            echo "<script>alert('kode paket sudah ada');window.location='../adminpaket.php';</script>";
            return false;
           }elseif ($row_destinasi > 0) {
             echo "<script>alert('kode destinasi sudah ada');window.location='../adminpaket.php';</script>";
            return false;
           }else {
           
            $query = "INSERT INTO tbl_paket ( kode_paket, namapaket, id_destinasi, deskripsi_paket, sisa_paket, harga_paket, gambar_paket) 
                      SELECT  '$kode_paket', '$namapaket', '$id_destinasi', '$deskripsi_paket', '$sisa_paket', '$harga_paket', '$nama_gambar_baru' 
                      FROM tbl_destinasi 
                      WHERE tbl_destinasi.id_destinasi = '$id_destinasi'";
            $result = mysqli_query($konek, $query);
              if ($result=true) {
                echo "<script>alert('data berhasil ditambah');window.location='../adminpaket.php';</script>";
              }else{
                echo "gagal";
              }
            }
        } else {
        // jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../adminpaket.php';</script>";
    }

   
}
 else {
    if ($row_paket > 0 && $row_destinasi > 0) {
        echo "<script>alert('kode paket dan kode destinasi sudah ada');window.location='../adminpaket.php';</script>";
        return false;
    }elseif ($row_paket > 0) {
        echo "<script>alert('kode paket sudah ada');window.location='../adminpaket.php';</script>";
        return false;
    }elseif ($row_destinasi > 0) {
        echo "<script>alert('kode destinasi sudah ada');window.location='../adminpaket.php';</script>";
        return false;
    }else {
        $query = "INSERT INTO tbl_paket ( kode_paket, namapaket, id_destinasi, deskripsi_paket, sisa_destinasi, harga_paket, gambar_paket) 
            SELECT   '$kode_paket', '$namapaket', '$id_destinasi', '$deskripsi_paket', '$sisa_destinasi', '$harga_paket', null 
            FROM tbl_destinasi 
            WHERE tbl_destinasi.id_destinasi = '$id_destinasi'";
            $result = mysqli_query($konek, $query);
              if ($result=true) {
                echo "<script>alert('data berhasil ditambah');window.location='../adminpaket.php';</script>";
              }else{
                echo "gagal";
              }
            }
   
}
?>