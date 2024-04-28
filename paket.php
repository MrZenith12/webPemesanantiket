<?php
include 'database/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="image/1.png" type="image/x-icon" />
    <title>Paket</title>
    <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="css/stylepaket.css">
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

         <div class="swiper-slide slide" style="background:url(image/indonesia.jpg) no-repeat">
            <div class="content">
               <span>Keindahan Wisata di Indonesia</span>
               <h3>MARI JELAJAHI BERSAMA-SAMA</h3>
            </div>
         </div>

      </div>

   </div>

   <!-- menu cari -->
   <div class="cari">
        <form method="post">
           <div class="search-container">
             <input class="search" type="text" name="search" autocomplete="off" placeholder="Cari Destinasi">
             <button type="submit" class="button"><i class="fa-solid fa-magnifying-glass"></i></button>
           </div>
         </form>
   </div>

   <!-- Info Destinasi -->
   <div class="container">
      <div class="kotakkiri">
            <form method="POST" action="">
              <label for="price_range">Kisaran Harga:</label>
              <input type="range" name="price_range" id="price_range" min="0" max="100" step="1" oninput="price_output.value = 'Rp ' + formatNumber(price_range.value * 1000000)">

              <label for="price_output">Harga:</label>
              <output name="price_output" id="price_output">Rp 0</output>

              <input type="submit" name="submit" value="Filter">
            </form>
      </div>
      <div class="tempatdestinasi">
         <h2>Paket Destinasi</h2>
           <div class="tempat">
               <?php
                 // jalankan query untuk menampilkan data
                 $query = "SELECT * FROM tbl_paket";

                 // cek apakah user telah melakukan pencarian
                 if(isset($_POST['search'])){
                   $keyword = $_POST['search'];
                   // tambahkan kondisi WHERE pada query untuk mencari data yang sesuai dengan input user
                   $query .= " WHERE namapaket LIKE '%$keyword%'";
                 }

                 // Tambahkan kondisi WHERE pada query untuk mencari data yang berada dalam kisaran harga_paket
                 if(isset($_POST['price_range'])){
                   $min_price = $_POST['price_range'] * 1000000 - 500000;
                   $max_price = $_POST['price_range'] * 1000000 + 500000;
                   $query .= " WHERE harga_paket BETWEEN $min_price AND $max_price";
                 }

                 $result = mysqli_query($konek, $query);

                 //mengecek apakah ada error ketika menjalankan query
                 if(!$result){
                   die ("Query Error: ".mysqli_errno($konek)." - ".mysqli_error($konek));
                 }

                 // jika data ditemukan, tampilkan
                 if(mysqli_num_rows($result) > 0){
                   while($row = mysqli_fetch_assoc($result)){
               ?>
                   <div class="perdestinasi">
                     <img src="admin1/gambar/<?php echo $row['gambar_paket']; ?>">
                     <h3><?php echo $row['namapaket']; ?></h3>
                     <div class="deskripsi">
                       <h2>Rp <?php echo number_format($row['harga_paket'],0,',','.'); ?></h2>
                       <p class="parasatu"><?php echo substr($row['deskripsi_paket'], 0, 30); ?></p>
                       <p class="paradua">Sisa Kamar yang tersedia: <?php echo $row['sisa_paket']; ?></p>
                     </div>
                     <a class="tombol" href="detailberanda/detailpaket.php?new_id_pakettour=<?php echo $row['new_id_pakettour']; ?>">Detail</a>
                   </div>
               <?php
                   }
                 } else {
                   // jika data tidak ditemukan
                   echo "<p>Data tidak ditemukan</p>";
                 }
               ?>
               <script>
                 function formatNumber(num) {
                   var numStr = num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                   return numStr;
                 }
               </script>
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