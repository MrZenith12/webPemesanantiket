<?php 
    session_start();
$id_user = $_SESSION['id_user'];
$koneksi = mysqli_connect("localhost", "root", "", "tripbuddy");

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $harga_paket = $_POST['harga_paket'];
    $namapaket = $_POST['namapaket'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $bank = $_POST['bank'];
    $no_rek = $_POST['no_rek'];
    $tgl_pergi = $_POST['tgl_pergi'];
    $tgl_pulang = $_POST['tgl_pulang'];
    $total_harga = $jumlah_orang * $harga_paket * (strtotime($tgl_pulang) - strtotime($tgl_pergi)) / (60 * 60 * 24);

    //mengambil data dari tabel tbl_paket
    $query_paket = "SELECT * FROM tbl_paket WHERE namapaket = '$namapaket'";
    $hasil_paket = mysqli_query($koneksi, $query_paket);
    $data_paket = mysqli_fetch_assoc($hasil_paket);

    //mengurangi sisa tiket saat ada pemesanan
    $jumlah_pesan = $jumlah_orang;
    if ($data_paket['sisa_paket'] >= $jumlah_pesan) {
        $sisa_paket = $data_paket['sisa_paket'] - $jumlah_pesan;
        $query_update = "UPDATE tbl_paket SET sisa_paket = '$sisa_paket' WHERE namapaket = '$namapaket'";
        mysqli_query($koneksi, $query_update);

            //insert data pemesanan ke tabel tbl_pespaket
        $query = "INSERT INTO tbl_pespaket (id_pesket, id_user, nama, email, alamat, no_telepon, harga_perket, namapaket, jumlah_orang, bank, no_rek, tgl_pergi, tgl_pulang, total_harga) 
                  VALUES ('', '$id_user', '$nama', '$email', '$alamat', '$no_telepon', '$harga_paket', '$namapaket', '$jumlah_orang', '$bank', '$no_rek', '$tgl_pergi', '$tgl_pulang', '$total_harga')";

        $result = mysqli_query($koneksi, $query);
        // periksa query apakah ada error
        if(!$result){
          die ("Query gagal dijalankan: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
        } else {
            //tampil alert dan akan redirect ke halaman index.php
            //silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil ditambah');window.location='../../paket.php';</script>";
        }     

    }else{
        echo "<script>alert('tiket sudah tidak mencukupi');window.location='../../paket.php';</script>";
    }
    
    
}

?>

