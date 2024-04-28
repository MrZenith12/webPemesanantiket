<?php
include '../../database/koneksi.php';
// mengaktifkan session pada php
session_start();

// cek apakah session username dan role sudah ada atau belum
if(!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] != "user"){
   // jika belum ada atau role bukan user, redirect ke halaman login
   header("Location: login.php");
   exit();
}

$id_user = $_SESSION['id_user'];

// mengambil nama pengguna dari session
$name="SELECT username FROM tbl_login WHERE id_user = $id_user";
$hasilname = mysqli_query($konek,$name);
$username = mysqli_fetch_array($hasilname);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../image/1.png" type="image/x-icon" />
    <title>Trip Buddy</title>
    <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="detailcss/stylepaket.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   <link rel="stylesheet"  type="text/css" href="style.css">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <section class="header">

       <a href="home.html" class="logo">Trip Buddy</a>

       <nav class="navbar">
          <a href="../halaman.php">Beranda</a>
          <a href="../userwisata.php">Wisata</a>
          <a href="../penginapan.php">Penginapan</a>
          <a href="../paket.php">Paket</a>
          <a href="../pemesanan.php">My Booking</a>
       </nav>
        <a href="login.php" class="tbl-biru"><i class="fa-solid fa-user" style="padding: 10px; "></i><?php echo $username['username']; ?></a>
       <div id="menu-btn" class="fas fa-bars"></div>

    </section>

        <!-- Mulai home   -->

<section class="home">
   <div class="kotak">
      <?php
       $new_id_pakettour= $_GET['new_id_pakettour'];

     // jalankan query untuk mengambil data destinasi berdasarkan new_id_pakettour
    $query = "SELECT * FROM tbl_paket
          JOIN tbl_destinasi ON tbl_paket.id_destinasi = tbl_destinasi.id_destinasi
          WHERE tbl_paket.new_id_pakettour = '$new_id_pakettour'";
      $result = mysqli_query($konek, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($konek).
           " - ".mysqli_error($konek));
      }
      $count = 0;
      while(($row = mysqli_fetch_assoc($result)) && $count < 1)
   {
      $count++;
      ?>
      <h1>Wisata Destinasi <?php echo $row['namapaket']; ?></h1>
      <div class="gambar">
         <img src="../../admin1/gambar/<?php echo $row['gambar_paket']; ?>">
      </div>
   </div>

   <div class="kotakdua">
      <div>
        
         <div class="detail">
            <h1><i class="fa-solid fa-book" style="padding: 10px;"></i>Detail Produk</h1>
            <h2 class="awal">Pengalaman yang Menanti Anda</h2>
            <p class="dessatu"><?php echo $row['deskripsi_paket']; ?></p>
         </div>

         <div class="kotakempat">
            <h1><i class="fa-solid fa-memo-circle-info"></i>Info tambahan</h1>
            <div class="hargapenginapan">
               <h1><?php echo $row['nama_destinasi']; ?></h1>
            </div>
            <div class="gambarpenginapan"> 
               <img src="../../admin1/gambar/<?php echo $row['gambar_produk']; ?>">
            </div>
            <p><?php echo $row['deskripsi']; ?></p>
         </div>
      </div>

      <div class="pesan">
         <div class="isi1">
            <h1>Harga Paket</h1>
            <div class="kotak1">
               <h1>Rp<?php echo number_format($row['harga_paket'],0,',','.'); ?></h1>
            </div>
            <div class="kotak4">
               <a href=""><i class="fa-brands fa-whatsapp" style="padding:5px;"></i>Tanya Cs</a>
            </div>
            <div class="kotak5">
               <a href="../pemesanan/paket/pesan.php?new_id_pakettour=<?php echo $row['new_id_pakettour']; ?>"><i class="fa-solid fa-boxes-packing" style="padding:5px;"></i>Pesan Sekarang</a>
            </div>
         </div>
      </div> 
      <?php
}
   ?> 
   </div>
 
   

</section>



<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>Link Utama</h3>
         <a href="beranda.php"> <i class="fas fa-angle-right"></i> Main</a>
                  <a href="wisata.php"> <i class="fas fa-angle-right"></i> Wisata</a>

         <a href="about.html"> <i class="fas fa-angle-right"></i> Perjalanan</a>
         <a href="package.html"> <i class="fas fa-angle-right"></i> Paket</a>
         <a href="book.html"> <i class="fas fa-angle-right"></i> Pesan</a>
      </div>

      <div class="box">
         <h3>Link Tambahan</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> Semua Pertanyaan</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>Untuk info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +628111111222</a>
         <a href="#"> <i class="fas fa-phone"></i> +6285111122225 </a>
         <a href="#"> <i class="fas fa-envelope"></i> Trip_Buddy@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> Aceh, Indonesia </a>
      </div>

      <div class="box">
         <h3>Follow Semua</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <div class="credit"> Copyright <span> Trip Buddy </span>2023 </div>

</section>



    <!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
</body>
</html>