<?php 
    include 'database/koneksi.php';

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./image/1.png" type="image/x-icon" />
    <title>Trip Buddy</title>
    <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   <link rel="stylesheet"  type="text/css" href="style.css">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <section class="header">
    
       <a href="home.html" class="logo">Trip Buddy</a>

       <nav class="navbar">
          <a href="beranda.php">Beranda</a>
          <a href="wisata.php">Wisata</a>
          <a href="penginapan.php">Penginapan</a>
          <a href="paket.php">Paket</a>
          <a href="pemesanan.php">My Booking</a>
       </nav>
        <a class="tbl-biru" href="login.php"><i class="fa-solid fa-user" style="padding: 10px; "></i>Login</a>
       <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <!-- Mulai home   -->

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(image/gambar\ 10.jpg) no-repeat">
            <div class="content">
               <span>Keindahan Kota Di Indonesia</span>
               <h3>SURABAYA, JAWA TIMUR</h3>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(image/gambar\ 11.jpg) no-repeat">
            <div class="content">
               <span>Keindahan Kota Di Indonesia</span>
               <h3>KOTA JAKARTA, INDONESIA</h3>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(image/gambar\ 12.jpg) no-repeat">
            <div class="content">
               <span>Keindahan Kota Di Indonesia</span>
               <h3>MANADO, SULAWESI UTARA</h3>
            </div>
         </div>
         <div class="swiper-slide slide" style="background:url(image/gambar\ 4.jpg) no-repeat">
            <div class="content">
               <span>Keindahan Kota Di Indonesia</span>
               <h3>PULAU NIAS, SUMATERA UTARA</h3>
            </div>
         </div>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>


   <div class="tempat">
    <div class="contan">
        <h2> Tersedia Pilihan Hotel Dan Destinasi</h2>
        <div class="boxhotel">
        <?php
            // jalankan query untuk menampilkan data hotel
            $queryHotel = "SELECT * FROM tbl_penginapan";
            $resultHotel = mysqli_query($konek, $queryHotel);

            // mengecek apakah ada error ketika menjalankan query hotel
            if (!$resultHotel) {
                die ("Query Error: " . mysqli_errno($konek) . " - " . mysqli_error($konek));
            }

            // jika data hotel ditemukan, tampilkan
            if (mysqli_num_rows($resultHotel) > 0) {
                $hitungHotel = 0; // inisialisasi variabel hitung hotel
                while ($rowHotel = mysqli_fetch_assoc($resultHotel)) {
                    $hitungHotel++; // tambahkan hitung hotel setiap kali loop
                    if ($hitungHotel > 4) break; // hentikan looping setelah 4 kali iterasi
        ?>
                    <div class="perhotel">
                        <img src="admin1/gambar/<?php echo $rowHotel['gambar_penginapan']; ?>">
                        <h3><?php echo $rowHotel['nama_penginapan']; ?></h3>
                        <a href="detailberanda/detailpenginapan.php?id_penginapan=<?php echo $rowHotel['id_penginapan']; ?>">Detail</a>
                    </div>
        <?php
                }
            }

            // jalankan query untuk menampilkan data destinasi
            $queryDestinasi = "SELECT * FROM tbl_destinasi";
            $resultDestinasi = mysqli_query($konek, $queryDestinasi);

            // mengecek apakah ada error ketika menjalankan query destinasi
            if (!$resultDestinasi) {
                die ("Query Error: " . mysqli_errno($konek) . " - " . mysqli_error($konek));
            }

            // jika data destinasi ditemukan, tampilkan
            if (mysqli_num_rows($resultDestinasi) > 0) {
                $hitungDestinasi = 0; // inisialisasi variabel hitung destinasi
                while ($rowDestinasi = mysqli_fetch_assoc($resultDestinasi)) {
                    $hitungDestinasi++; // tambahkan hitung destinasi setiap kali loop
                    if ($hitungDestinasi > 4) break; // hentikan looping setelah 4 kali iterasi
        ?>
                    <div class="perhotel">
                        <img src="admin1/gambar/<?php echo $rowDestinasi['gambar_produk']; ?>">
                        <h3><?php echo $rowDestinasi['nama_destinasi']; ?></h3>
                        <a href="detailberanda/detaildestinasi.php?id_destinasi=<?php echo $rowDestinasi['id_destinasi']; ?>">Detail</a>
                    </div>
        <?php
                }
            }
        ?>

        </div>
    </div>
</div>

     <!-- isi Home -->
    <div class="promosi">
        <div class="contaisi">
            <h2> Berlibur bersama keluarga dengan TRIP BUDDY</h2>
            <div class="boxpromosi">
                <div class="perpromosi">
                    <img src="image/promosi2.png">
                </div>
            </div>
        </div>
    </div>

    

    <!-- pelayanan -->
    <div class="partner">
        <div class="kiri">
            <h1>Partner Maskapai</h1>
            <p>Kami bekerja sama dengan berbagai<br> maskapai penerbangan di seluruh dunia<br> untuk menerbangkan Anda ke mana pun<br>Anda inginkan!</p>
        </div>
        
        <div class="wrapper">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carousel">
              <a href=""><img src="img/batik.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/bali.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/garuda.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/wings.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/lion.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/sriwi.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/merpati.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/citi.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/mandala.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/pelita.jpg" alt="img" draggable="false"></a>
              <a href=""><img src="img/air.jpg" alt="img" draggable="false"></a>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
    </div>

    <div class="keunggulan">
        <div class="antara">
            <h1>Keunggulan Memakai trip Buddy</h1>
            <div class="box">

                <div class="perunggulan">
                    <img src="image/icon9.png">
                     <div class="pertama">
                        <h2>Praktis, Tanpa Repot </h2>
                        <p>Bebas transaksi di mana saja dan kapan saja, mulai dari desktop, aplikasi mobile, atau situs web mobile.</p>
                    </div>
                </div>
               
                <div class="perunggulan">
                    <img src="image/icon8.png">
                    <div class="pertama">
                        <h2>Layanan Terpercaya</h2>
                        <p>Anda akan mendapat apa  yang Anda bayar – dijamin!</p>
                    </div>
                </div>
                <div class="perunggulan">
                    <img src="image/icon7.png">
                     <div class="pertama">
                        <h2>Berbagai Pilihan Pembayaran </h2>
                        <p>Pembayaran jadi semakin fleksibel dengan berbagi pilihan, mulai dari ATM, Transfer Bank, Kartu Kredit, Bayar Tunai di Konter, hingga Internet Banking. </p>
                    </div>   
                </div>
                <div class="perunggulan">
                    <img src="image/icon10.png">
                    <div class="pertama">
                       <h2>Jaminan Keamanan Transaksi</h2>
                       <p>Teknologi SSL dari RapidSSL dengan Sertifikat yang terotentikasi menjamin privasi dan keamanan transaksi online Anda. Konfirmasi instan dan e-tiket atau voucher dikirim langsung ke email Anda.</p>
                    </div>  
                </div>
                

            </div>
        </div>
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
<script src="js/index.js"></script>
<script src="js/script.js" defer></script>
</body>
</html>