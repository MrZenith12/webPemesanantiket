<?php 
    session_start();
$id_user = $_SESSION['id_user'];
$koneksi = mysqli_connect("localhost", "root", "", "tripbuddy");

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $harga = $_POST['harga'];
    $nama_destinasi = $_POST['nama_destinasi'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $bank = $_POST['bank'];
    $no_rek = $_POST['no_rek'];
    $tgl_pergi = $_POST['tgl_pergi'];
    $tgl_pulang = $_POST['tgl_pulang'];
    $total_harga = $jumlah_orang * $harga * (strtotime($tgl_pulang) - strtotime($tgl_pergi)) / (60 * 60 * 24);

    //mengambil data dari tabel tbl_destinasi
    $query_destinasi = "SELECT * FROM tbl_destinasi WHERE nama_destinasi = '$nama_destinasi'";
    $hasil_destinasi = mysqli_query($koneksi, $query_destinasi);
    $data_destinasi = mysqli_fetch_assoc($hasil_destinasi);

    //mengurangi sisa tiket saat ada pemesanan
    $jumlah_pesan = $jumlah_orang;
    if ($data_destinasi['sisa_destinasi'] >= $jumlah_pesan) {
        $sisa_destinasi = $data_destinasi['sisa_destinasi'] - $jumlah_pesan;
        $query_update = "UPDATE tbl_destinasi SET sisa_destinasi = '$sisa_destinasi' WHERE nama_destinasi = '$nama_destinasi'";
        mysqli_query($koneksi, $query_update);

            //insert data pemesanan ke tabel tbl_pesandes
        $query = "INSERT INTO tbl_pesandes (id_pesdes, id_user, nama, email, alamat, no_telepon, hargades, nama_destinasi, jumlah_orang, bank, no_rek, tgl_pergi, tgl_pulang, total_harga) 
                  VALUES ('', '$id_user', '$nama', '$email', '$alamat', '$no_telepon', '$harga', '$nama_destinasi', '$jumlah_orang', '$bank', '$no_rek', '$tgl_pergi', '$tgl_pulang', '$total_harga')";

        $result = mysqli_query($koneksi, $query);
        // periksa query apakah ada error
        if(!$result){
          die ("Query gagal dijalankan: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
        } else {
            //tampil alert dan akan redirect ke halaman index.php
            //silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil ditambah');window.location='../../userwisata.php';</script>";
        }     

    }else{
        echo "<script>alert('tiket sudah tidak mencukupi');window.location='../../userwisata.php';</script>";
    }
    
    
}

?>
