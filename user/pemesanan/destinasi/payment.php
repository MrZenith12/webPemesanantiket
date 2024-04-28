<?php 

	session_start();
	$koneksi = mysqli_connect("localhost", "root", "", "tripbuddy");

	// Cek koneksi
	if (!$koneksi) {
	    die("Koneksi gagal: " . mysqli_connect_error());
	}

	if (isset($_POST['submit'])) {
		$id_destinasi = $_POST['id_destinasi'];

		$sql = "SELECT * FROM tbl_destinasi WHERE id_destinasi = $id_destinasi";
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

		$nama_destinasi = $_POST['nama_destinasi'];
		$nama   = $_POST['nama'];
		$email   = $_POST['email'];
		$alamat   = $_POST['alamat'];
		$no_telepon   = $_POST['no_telepon'];
		$harga   = $_POST['harga'];
	

	}
	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<script src="https://kit.fontawesome.com/674cafd30b.js" crossorigin="anonymous"></script>
	<title>Pesan</title>
</head>
<body>
	<div class="header">
		<h1>Trip Buddy</h1>
		<div class="detail">
			<p>1. Order<i class="fa-solid fa-chevron-right" style="margin-left:15px;"></i></p>
			<p class="p2">2. Payment</p>
		</div>
	</div>
	<div class="content">
		<div class="kiri">
			<div class="kotak1">
				<h1><?php echo $row['nama_destinasi']; ?></h1>
			</div>
			<div class="kotak2">
				<h1>Form Pemesanan</h1>
				<div class="form">
					<form method="post" action="konfirmasi.php">
						<input type="hidden" id="id_destinasi" name="id_destinasi" value="<?php echo $row['id_destinasi']; ?>">
						  <input type="hidden" id="harga" name="harga" value="<?php echo $harga; ?>" readonly>
						  <input type="hidden" id="nama_destinasi" name="nama_destinasi" value="<?php echo $nama_destinasi; ?>" readonly>
						  
						  <label for="nama">Nama:</label>
						  <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" readonly>
						  
						  <label for="email">Email:</label>
						  <input type="email" id="email" name="email"  value="<?php echo $email; ?>" readonly>
						  
						  <label for="alamat">Alamat:</label>
						  <input type="alamat" id="alamat" name="alamat"  value="<?php echo $alamat; ?>" readonly>
						  
						  <label for="no_telepon">No Telepon:</label>
						  <input type="number" id="no_telepon" name="no_telepon" value="<?php echo $no_telepon;?>" readonly>
						  
						  <label>Jumlah Orang</label>
						  <input type="number" id="jumlah_orang" name="jumlah_orang" placeholder="Masukkan Jumlah orang" >

						  <label>Keberangkaatan</label>
						  <input type="date" id="tgl_pergi" name="tgl_pergi" placeholder="Masukkan Tanggal Pergi" >

						  <label>Kepulangan</label>
						  <input type="date" id="tgl_pulang" name="tgl_pulang" placeholder="Masukkan Tanggal Pulang" >

						  <label>Bank</label>
						  <select  id="bank" name="bank" class="form-input">
					              	<option class="form-input">BSI</option>
					              	<option class="form-input">BNI</option>
					              	<option class="form-input">BRI </option>
					       </select><br>

					      <label>No Rekening</label>
						  <input type="number" id="no_rek" name="no_rek" placeholder="Masukkan Nomor Rekening" >
						  
						  
						  <a href="pesan.php?id_destinasi=<?php echo $row['id_destinasi']; ?>" class="tombol">Kembali</a>
						  <input type="submit" name="submit" value="Bayar">
					</form>
				</div>
			</div>
		</div>
		<div class="kanan">
			<h1>Detail Paket</h1>

			<div class="kotakpaket">
				<div class="isi1"><img src="../../../admin1/gambar/<?php echo $row['gambar_produk']; ?>"></div>
				<div class="isi2">
					<h3><?php echo $row['nama_destinasi'];  ?></h3>
					<p>px</p>
				</div>
			</div>

			<div class="kotakpaket1">
				<p>Harga</p>
				<h1>Rp<?php echo number_format($row['harga'],0,',','.'); ?></h1>
			</div>
		</div>
	</div>
</body>
</html>