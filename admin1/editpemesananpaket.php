<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php');
// mengecek apakah di url ada nilai GET id
  if (isset($_GET['id_pesket'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id_pesket = ($_GET["id_pesket"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM tbl_pespaket WHERE id_pesket='$id_pesket'";
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
          echo "<script>alert('Data tidak ditemukan pada database');window.location='pemesanandestinasi.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='pemesanandestinasi.php';</script>";
  }
?>

<center>
    <h1>Edit Produk <?php echo $data['nama']; ?></h1>
</center>
<form action="prosespemesanan/paket/prosesedit.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="id_pesket" class="form-control" value="<?php echo $data['id_pesket']; ?>">
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?>">
    </div>
    <div class="form-group">
        <label>No Telepon</label>
        <input type="text" name="no_telepon" class="form-control" value="<?php echo $data['no_telepon']; ?>">
    </div>
    <div class="form-group">
        <label>Harga Paket</label>
        <input type="text" name="harga_perket" class="form-control" value="<?php echo $data['harga_perket']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Paket</label>
        <input type="text" name="namapaket" class="form-control" value="<?php echo $data['namapaket']; ?>">
    </div>
    <div class="form-group">
        <label>Jumlah Orang</label>
        <input type="text" name="jumlah_orang" class="form-control" value="<?php echo $data['jumlah_orang']; ?>">
    </div>
    <div class="form-group">
        <label>Tanggal Pergi</label>
        <input type="date" name="tgl_pergi" class="form-control" value="<?php echo $data['tgl_pergi']; ?>">
    </div>
    <div class="form-group">
        <label>Tanggal Pulang</label>
        <input type="text" name="tgl_pulang" class="form-control" value="<?php echo $data['tgl_pulang']; ?>">
    </div>
    <div class="form-group">
        <label>Bank</label>
        <input type="text" name="bank" class="form-control" value="<?php echo $data['bank']; ?>">
    </div>
    <div class="form-group">
        <label>No Rekening</label>
        <input type="text" name="no_rek" class="form-control" value="<?php echo $data['no_rek']; ?>">
    </div>
    <div class="form-group">
        <label>Total Harga</label>
        <input type="text" name="total_harga" class="form-control" value="<?php echo $data['total_harga']; ?>">
    </div>
    <div class="form-group">
        <button type="submit" name="update_btn" class="btn btn-primary">Update Data</button>
    </div>
</form>


<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
?>