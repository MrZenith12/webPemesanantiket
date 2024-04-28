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

if (isset($_GET['id_user'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id_user = ($_GET["id_user"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM tbl_login WHERE id_user='$id_user'";
    $result = mysqli_query($konek, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if(!$result){
      die ("Query Error: ".mysqli_errno($konek).
         " - ".mysqli_error($konek));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
      // apabila data tidak ada pada database maka akan dijalankan perintah ini
       if (!count($data)) {
          echo "<script>alert('Data tidak ditemukan pada database');window.location='profil.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='profil.php';</script>";
  }
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
   <link rel="stylesheet" type="text/css" href="styleprofil/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
   <link rel="stylesheet"  type="text/css" href="style.css">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet">
   <script>
    function konfirmasiLogout() {
      var konfirmasi = confirm("Apakah Anda ingin keluar?");
      if (konfirmasi) {
        // Tambahkan kode logout di sini
        window.location.href = "../logout.php"; // atau URL logout yang sesuai
      }
    }
    </script>
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
       <div class="tbl-biru"><a href="#" onclick="konfirmasiLogout()">Logout</a></div>

    </section>

    <section class="home">
    	<div class="filter">
    		
    	</div>

    	<div class="profil">

			  <h1>Profil</h1>

			  <center>
                <h1>Edit Produk <?php echo $data['username']; ?></h1>
            </center>
            <form action="proses_editprofil.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="id_user" class="form-control" value="<?php echo $data['id_user']; ?>">
                </div>
                <div class="form-group">
                    <img src="../../image/<?php echo $data['gambarprofil']; ?>" style="margin-left: 15px;width: 300px;float: left;margin-bottom: 5px;">
                    <input type="file" name="gambarprofil" class="form-control" />
                    <i style="float: left;font-size: 11px;color: red">Setting Gambar</i>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>">
                </div>
                <div class="form-group">
                    <label>No telepon</label>
                    <input type="text" name="no_telepon" class="form-control" value="<?php echo $data['no_telepon']; ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" name="update_btn" class="btn btn-primary">Update Data</button>
                </div>
            </form>
    	</div>
    </section>

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
<script src="../../js/index.js"></script>
<script src="../../js/script.js" defer></script>
</body>
</html>