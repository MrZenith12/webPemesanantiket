<?php
include 'database/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="image/1.png" type="image/x-icon" />
    <title>Trip Buddy</title>
    <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="css/pesananlogin.css">
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


    <section class="home">

   <div class="pemesanan">
       <div class="profil">
          <a href=""><i class="fa-sharp fa-solid fa-person-walking-luggage" style="padding-right: 30px; color: #000;"></i>Wisata</a>
       </div>

       <div class="kanan" onclick="">
          <a href=""><i class="fa-brands fa-usps" style="padding-right: 15px; color: #000;"></i>Paket Wisata</a>
       </div>

       <div class="kanan1" onclick="location.href ='Penginapan.php'; ">
          <a href=""><i class="fa-solid fa-hotel" style="padding-right: 30px; color: #000;"></i>Hotel</a>
       </div>
   </div>

   <div class="pesan">
      <div class="order">
         <button class="login-button" onclick="location.href='login.php';">Login</button>
         <p>belum ada pemesanan silakan login terlebih dahulu</p>
      </div>
   </div>

   <div class="kunjungi">
        <hr class="baris">
        <button class="travel-button" onclick="location.href='pemesanan.php#wisata'; ">Wisata</button>
        <button class="travel-button" onclick="location.href='pemesananpaket.php#paketdestinasi'; ">Paket</button>
        <button class="travel-button" onclick="location.href='pemesananpenginapan.php#penginapan'; ">Penginapan</button>

        <div class="container">
          <div class="tempatdestinasi">
            <h2>Pemesanan Lainnya</h2>
            <div class="tempat">
              <?php
                // Jalankan query untuk menampilkan data penginapan
                $query_penginapan = "SELECT * FROM tbl_penginapan";
                $result_penginapan = mysqli_query($konek, $query_penginapan);

                // Mengecek apakah ada error ketika menjalankan query
                if (!$result_penginapan) {
                  die("Query Error: " . mysqli_errno($konek) . " - " . mysqli_error($konek));
                }

                // Jika data ditemukan, tampilkan penginapan
                if (mysqli_num_rows($result_penginapan) > 0) {
                  while ($row_penginapan = mysqli_fetch_assoc($result_penginapan)) {
              ?>
                    <div class="perdestinasi" id="penginapan">
                      <img src="admin1/gambar/<?php echo $row_penginapan['gambar_penginapan']; ?>">
                      <h3><?php echo $row_penginapan['nama_penginapan']; ?></h3>
                      <div class="deskripsi">
                        <h2>Rp <?php echo number_format($row_penginapan['harga_penginapan'], 0, ',', '.'); ?></h2>
                        <p class="parasatu"><?php echo substr($row_penginapan['deskripsi_penginapan'], 0, 30); ?></p>
                        <p class="paradua">Sisa Kamar yang tersedia: <?php echo $row_penginapan['sisa_penginapan']; ?></p>
                      </div>
                      <a class="tombol" href="detailberanda/detailpenginapan.php?id_penginapan=<?php echo $row_penginapan['id_penginapan']; ?>">Detail</a>
                    </div>
              <?php
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>

      <script>
        var buttons = document.getElementsByClassName("travel-button");
        var destinations = document.getElementsByClassName("perdestinasi");

        for (var i = 0; i < buttons.length; i++) {
          buttons[i].addEventListener("click", function() {
            var filterValue = this.getAttribute("data-filter");

            // Tampilkan semua destinasi jika filterValue kosong atau null
            if (!filterValue) {
              for (var j = 0; j < destinations.length; j++) {
                destinations[j].style.display = "block";
              }
            } else {
              for (var j = 0; j < destinations.length; j++) {
                var category = destinations[j].getAttribute("data-category");

                // Tampilkan destinasi yang sesuai dengan filterValue
                if (category === filterValue) {
                  destinations[j].style.display = "block";
                } else {
                  destinations[j].style.display = "none";
                }
              }
            }
          });
        }
      </script>



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
<script src="../js/script.js" defer></script>
</body>
</html>