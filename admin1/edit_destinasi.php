<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php');
// mengecek apakah di url ada nilai GET id
  if (isset($_GET['id_destinasi'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id_destinasi = ($_GET["id_destinasi"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM tbl_destinasi WHERE id_destinasi='$id_destinasi'";
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
          echo "<script>alert('Data tidak ditemukan pada database');window.location='admindestinasi.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='admindestinasi';</script>";
  }
?>

<center>
    <h1>Edit Produk <?php echo $data['nama_destinasi']; ?></h1>
</center>
<form action="proses_editdestinasi.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="id_destinasi" class="form-control" value="<?php echo $data['id_destinasi']; ?>">
    </div>
    <div class="form-group">
        <label>Kode Destinasi</label>
        <input type="text" name="kode_destinasi" class="form-control" value="<?php echo $data['kode_destinasi']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Destinasi</label>
        <input type="text" name="nama_destinasi" class="form-control" value="<?php echo $data['nama_destinasi']; ?>">
    </div>
    <div class="form-group">
        <label>Tiket Destinasi</label>
        <input type="text" name="sisa_destinasi" class="form-control" value="<?php echo $data['sisa_destinasi']; ?>">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" value="<?php echo $data['deskripsi']; ?>">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" name="harga" class="form-control" value="<?php echo $data['harga']; ?>">
    </div>
    <div class="form-group">
        <img src="gambar/<?php echo $data['gambar_produk']; ?>" style="margin-left: 15px;width: 300px;float: left;margin-bottom: 5px;">
        <input type="file" name="gambar_produk" class="form-control" />
        <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar produk</i>
    </div>
    <div class="form-group">
        <button type="submit" name="update_btn" class="btn btn-primary">Update Data</button>
    </div>
</form>


<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
?>