<!-- user_orders.php -->
<?php
$koneksi1 = mysqli_connect("localhost", "root", "", "tripbuddy");
session_start();

if(!isset($_SESSION['id_user'])){
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$name="SELECT username FROM tbl_login WHERE id_user = $id_user";
$hasilname = mysqli_query($koneksi1,$name);
$username = mysqli_fetch_array($hasilname);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../image/1.png" type="image/x-icon" />
    <title>Trip Buddy</title>
    <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="../css/pesanan.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   <link rel="stylesheet"  type="text/css" href="style.css">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet">
   <script>
    function konfirmasiLogout() {
      var konfirmasi = confirm("Apakah Anda ingin keluar?");
      if (konfirmasi) {
        // Tambahkan kode logout di sini
        window.location.href = "logout.php"; // atau URL logout yang sesuai
      }
    }
    </script>
</head>
<body>
    <section class="header">

       <a href="home.html" class="logo">Trip Buddy</a>

       <nav class="navbar">
          <a href="halaman.php">Beranda</a>
          <a href="userwisata.php">Wisata</a>
          <a href="penginapan.php">Penginapan</a>
          <a href="paket.php">Paket</a>
          <a href="pemesanan.php">My Booking</a>
       </nav>
        <div class="dropdown">
          <div id="dropdown" class="dropdown-select">
            <span class="username"><?php echo $username['username']; ?></span>
            <span class="dropdown-selected"><i class="fa-solid fa-circle-chevron-down"></i></span>
            <ul class="dropdown-options">
              <li><a href="profil/profil.php?id_user=<?php echo $id_user;?>">Settings</a></li>
              <li><a href="#" onclick="konfirmasiLogout()">Logout</a></li>
            </ul>
          </div>

          <script>
            // Toggle dropdown options
            document.getElementById("dropdown").addEventListener("click", function() {
              this.classList.toggle("active");
            });

            // Redirect when an option is clicked
            var options = document.querySelectorAll("#dropdown .dropdown-options a");
            options.forEach(function(option) {
              option.addEventListener("click", function(event) {
                event.preventDefault();
                var url = this.getAttribute("href");
                if (url) {
                  window.location.href = url;
                }
              });
            });
          </script>
        </div>
       <div id="menu-btn" class="fas fa-bars"></div>

    </section>


    <section class="home">

   <div class="pemesanan">
       <div class="profil">
          <a href="pemesanan.php"><i class="fa-sharp fa-solid fa-person-walking-luggage" style="padding-right: 30px; color: #000;"></i>Wisata</a>
       </div>

       <div class="kanan" onclick="">
          <a href="pesanpaket.php"><i class="fa-brands fa-usps" style="padding-right: 15px; color: #000;"></i>Paket Wisata</a>
       </div>

       <div class="kanan1" onclick=" ">
          <a href="pesanpenginapan.php"><i class="fa-solid fa-hotel" style="padding-right: 30px; color: #000;"></i>Hotel</a>
       </div>
   </div>

    <div class="pesanaja">
        <div class="kanan_pesan">
          <h1>Riwayat Pesanan Paket</h1>
          <?php 

          $query = "SELECT * FROM tbl_pespaket WHERE id_user=$id_user";
          $count = 0;
          $no=1;
          $result = mysqli_query($koneksi1, $query);
          if (!$result) {
                die('Query Error: ' . mysqli_error($koneksi1));
            }

            while (($row = mysqli_fetch_array($result)) && $count < 1) {
                $tgl_pergi = new DateTime($row['tgl_pergi']);
                $now = new DateTime();

                // Menghitung selisih jam antara tanggal pemesanan dan tanggal saat ini
                $diffHours = $now->diff($tgl_pergi)->h;

                // Memeriksa jika selisih jam lebih dari atau sama dengan 24
                if ($diffHours >= 24) {
                    continue; // Mengabaikan pemesanan jika sudah melewati 24 jam
                }

                // Menghitung selisih hari antara tanggal pemesanan dan tanggal saat ini
                $diffDays = date_diff($now, $tgl_pergi)->format('%a');

                // Memeriksa jika selisih hari lebih dari 1
                if ($diffDays > 1) {
                    $buttonText = "Sudah Dipesan";
                    $buttonClass = "btn btn-default"; // Ganti kelas tombol jika sudah dipesan
                    $buttonOnClick = "return false;"; // Menghilangkan konfirmasi saat tombol diklik
                } else {
                    $buttonText = "Batal Pemesanan";
                    $buttonClass = "btn btn-danger";
                    $buttonOnClick = "return confirm('Anda yakin akan membatalkan pemesanan?')";
                }
                ?>
                  <div class="kotak1">
                      <div class="nomor">
                          <?php 
                            $nama = $row['namapaket'];
                            $pilihgambar = "SELECT gambar_paket FROM tbl_paket WHERE namapaket = '$nama'";
                            $hasilgambar = mysqli_query($koneksi1, $pilihgambar);
                            $gambar = mysqli_fetch_array($hasilgambar);
                            ?>
                            <img style="text-align: center; font-size: 60px; max-width: 200px" src="../admin1/gambar/<?php echo $gambar['gambar_paket']; ?>">
                      </div>
                      <div class="desk">
                              <p>Nama :<?php echo $row['nama']; ?></p>
                              <p>Email  : <?php echo $row['email']; ?></p>
                              <p>Alamat : <?php echo $row['alamat']; ?></p>
                              <p>Nama Paket : <?php echo $row['namapaket']; ?></p>
                              <p>Jumlah Orang : <?php echo $row['jumlah_orang']; ?></p>
                              <p>Tanggal pergi : <?php echo $row['tgl_pergi']; ?></p>
                              <p>Tanggal Pulang : <?php echo $row['tgl_pulang']; ?></p>
                              <p>Total Harga : <?php echo $row['total_harga']; ?></p>
                              <form  action="proseshapuspemesanan/proseshapuspaket.php?id_pesket=<?php echo $row['id_pesket']; ?>" method="post">
                                  <input type="hidden" name="delete_id" value="" >
                                  <?php if ($diffHours < 24) { ?>
                                        <button type="submit" name="delete_btn" class="<?php echo $buttonClass; ?>" onclick="<?php echo $buttonOnClick; ?>"><?php echo $buttonText; ?></button>
                                    <?php } ?>
                                </form>
                      </div>
                  </div>
          <?php
               }
               mysqli_close($koneksi1);
               $count++; 
          ?>
         </div>
    </div>

    <div class="kunjungi">
        <hr class="baris">
        <button class="travel-button" onclick="location.href='pemesanan.php#wisata'; ">Wisata</button>
        <button class="travel-button" onclick="location.href='pesanpaket.php#paketdestinasi'; ">Paket</button>
        <button class="travel-button" onclick="location.href='pesanpenginapan.php#penginapan'; ">Penginapan</button>

        <div class="container">
          <div class="tempatdestinasi">
            <h2>Pemesanan Lainnya</h2>
            <div class="tempat">
              <?php
              // Establish database connection
                $koneksi = mysqli_connect("localhost", "root", "", "tripbuddy");

                // Check if the connection was successful
                if (!$koneksi) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                // Jalankan query untuk menampilkan data paket
                $query_paket = "SELECT * FROM tbl_paket";
                $result_paket = mysqli_query($koneksi, $query_paket);

                // Mengecek apakah ada error ketika menjalankan query
                if (!$result_paket) {
                  die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }

                // Jika data ditemukan, tampilkan paket
                if (mysqli_num_rows($result_paket) > 0) {
                  while ($row_paket = mysqli_fetch_assoc($result_paket)) {
              ?>
                    <div class="perdestinasi" id="paketdestinasi">
                      <img src="../admin1/gambar/<?php echo $row_paket['gambar_paket']; ?>">
                      <h3><?php echo $row_paket['namapaket']; ?></h3>
                      <div class="deskripsi">
                        <h2>Rp <?php echo number_format($row_paket['harga_paket'], 0, ',', '.'); ?></h2>
                        <p class="parasatu"><?php echo substr($row_paket['deskripsi_paket'], 0, 30); ?></p>
                        <p class="paradua">Sisa Paket yang tersedia: <?php echo $row_paket['sisa_paket']; ?></p>
                      </div>
                      <a class="tombol" href="detail/detailpaket.php?new_id_pakettour=<?php echo $row_paket['new_id_pakettour']; ?>">Detail</a>
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