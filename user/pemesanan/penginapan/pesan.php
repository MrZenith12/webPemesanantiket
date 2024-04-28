<?php 
    session_start();
	$koneksi = mysqli_connect("localhost", "root", "", "tripbuddy");

	// Cek koneksi
	if (!$koneksi) {
	    die("Koneksi gagal: " . mysqli_connect_error());
	}

	// Ambil id_penginapan dari URL
	$id_penginapan = $_GET['id_penginapan'];

	$sql = "SELECT * FROM tbl_penginapan WHERE id_penginapan = $id_penginapan";
	$result = mysqli_query($koneksi, $sql);

	if ($result) {
	  if (mysqli_num_rows($result) > 0) {
	    $row = mysqli_fetch_array($result);
	    // display the data
	  } else {
	    echo "No data found.";
	  }
	} else {
	  echo "Error executing SQL query: " . mysqli_error($koneksi);
	}

	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://kit.fontawesome.com/674cafd30b.js" crossorigin="anonymous"></script>
	<title>Pesan</title>
</head>
<body>
	<div class="header">
		<h1>Trip Buddy</h1>
		<div class="detail">
			<p class="p1">1. Order<i class="fa-solid fa-chevron-right" style="margin-left:15px;"></i></p>
			<p>2. Payment<i class="fa-solid fa-chevron-right" style="margin-left:15px;"></i></p>
		</div>
	</div>
	<div class="content">
		<div class="kiri">
			<div class="kotak1">
				<h1><?php echo $row['nama_penginapan']; ?></h1>
			</div>
			<div class="kotak2">
				<h1>Form Pemesanan</h1>
				<div class="form">
					<form method="post" action="Payment.php">
						  <input type="hidden" id="id_penginapan" name="id_penginapan" value="<?php echo $row['id_penginapan']; ?>">
						  <input type="hidden" id="harga_penginapan" name="harga_penginapan" value="<?php echo $row['harga_penginapan']; ?>">
						  <input type="hidden" id="sisa_penginapan" name="sisa_penginapan" value="<?php echo $row['sisa_penginapan']; ?>">
						  <input type="hidden" id="nama_penginapan" name="nama_penginapan" value="<?php echo $row['nama_penginapan']; ?>">

						  <label for="nama">Nama:</label>
						  <input type="text" id="nama" name="nama" placeholder="Nama Lengkap">

						  <label for="email">Email:</label>
						  <input type="email" id="email" name="email" placeholder="Email">

						  <label for="alamat">Alamat:</label>
						  <input type="alamat" id="alamat" name="alamat" placeholder="alamat">

						  <label for="no_telepon">No Telepon:</label>
						  <input type="number" id="no_telepon" name="no_telepon" placeholder="No Hp">
						  
						  <a href="../../penginapan.php" class="tombol">Kembali</a>
						  <input type="submit" name="submit" value="Lanjut">
					</form>
				</div>
			</div>
		</div>
		<div class="kanan">
			<h1>Detail Paket</h1>

			<div class="kotakpaket">
				<div class="isi1"><img src="../../../admin1/gambar/<?php echo $row['gambar_penginapan']; ?>"></div>
				<div class="isi2">
					<h3><?php echo $row['nama_penginapan'];  ?></h3>
					<p>Ketersediaan Penginapan <?php echo $row['sisa_penginapan']; ?></p>
				</div>
			</div>

			<div class="kotakpaket1">
				<p>Harga</p>
				<h1>Rp<?php echo number_format($row['harga_penginapan'],0,',','.'); ?></h1>
			</div>
		</div>
	</div>
</body>
</html>