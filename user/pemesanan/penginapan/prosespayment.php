<?php 
    session_start();
$id_user = $_SESSION['id_user'];
$koneksi = mysqli_connect("localhost", "root", "", "tripbuddy");

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $harga_penginapan = $_POST['harga_penginapan'];
    $nama_penginapan = $_POST['nama_penginapan'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $bank = $_POST['bank'];
    $no_rek = $_POST['no_rek'];
    $tgl_pergi = $_POST['tgl_pergi'];
    $tgl_pulang = $_POST['tgl_pulang'];
    $total_harga = $jumlah_orang * $harga_penginapan * (strtotime($tgl_pulang) - strtotime($tgl_pergi)) / (60 * 60 * 24);

    //mengambil data dari tabel tbl_penginapan
    $query_penginapan = "SELECT * FROM tbl_penginapan WHERE nama_penginapan = '$nama_penginapan'";
    $hasil_penginapan = mysqli_query($koneksi, $query_penginapan);
    $data_penginapan = mysqli_fetch_assoc($hasil_penginapan);

    //mengurangi sisa tiket saat ada pemesanan
    $jumlah_pesan = $jumlah_orang;
    if ($data_penginapan['sisa_penginapan'] >= $jumlah_pesan) {
        $sisa_penginapan = $data_penginapan['sisa_penginapan'] - $jumlah_pesan;
        $query_update = "UPDATE tbl_penginapan SET sisa_penginapan = '$sisa_penginapan' WHERE nama_penginapan = '$nama_penginapan'";
        mysqli_query($koneksi, $query_update);

            //insert data pemesanan ke tabel tbl_pesandes
        $query = "INSERT INTO tbl_pespenginapan (id_pesnip, id_user, nama, email, alamat, no_telepon, harganip, nama_penginapan, jumlah_orang, bank, no_rek, tgl_pergi, tgl_pulang, total_harga) 
                  VALUES ('', '$id_user', '$nama', '$email', '$alamat', '$no_telepon', '$harga_penginapan', '$nama_penginapan', '$jumlah_orang', '$bank', '$no_rek', '$tgl_pergi', '$tgl_pulang', '$total_harga')";

        $result = mysqli_query($koneksi, $query);
        // periksa query apakah ada error
        if(!$result){
          die ("Query gagal dijalankan: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
        } else {
            //tampil alert dan akan redirect ke halaman index.php
            //silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil ditambah');window.location='../../penginapan.php';</script>";
        }     

    }else{
        echo "<script>alert('tiket sudah tidak mencukupi');window.location='../../penginapan.php';</script>";
    }
    
    
}

?>

