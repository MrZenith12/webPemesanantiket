<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php');
// mengecek apakah di url ada nilai GET id
  if (isset($_GET['id_penginapan'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id_penginapan = ($_GET["id_penginapan"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM tbl_penginapan WHERE id_penginapan='$id_penginapan'";
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
          echo "<script>alert('Data tidak ditemukan pada database');window.location='adminpenginapan.php.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='adminpenginapan.php';</script>";
  }
?>

<center>
    <h1>Edit Produk <?php echo $data['nama_penginapan']; ?></h1>
</center>
<form action="crudpenginapan/proses_edit.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="id_penginapan" class="form-control" value="<?php echo $data['id_penginapan']; ?>">
    </div>
    <div class="form-group">
        <label>Kode Penginapan</label>
        <input type="text" name="kode_penginapan" class="form-control" value="<?php echo $data['kode_penginapan']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Penginapan</label>
        <input type="text" name="nama_penginapan" class="form-control" value="<?php echo $data['nama_penginapan']; ?>">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi_penginapan" class="form-control" value="<?php echo $data['deskripsi_penginapan']; ?>">
    </div>
    <div class="form-group">
        <label>Kamar</label>
        <input type="text" name="sisa_penginapan" class="form-control" value="<?php echo $data['sisa_penginapan']; ?>">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" name="harga_penginapan" class="form-control" value="<?php echo $data['harga_penginapan']; ?>">
    </div>
    <div class="form-group">
        <label>Fasilitas</label>
        <input type="text" name="fasilitas_penginapan" class="form-control" value="<?php echo $data['fasilitas_penginapan']; ?>">
    </div>
    <div class="form-group">
        <img src="gambar/<?php echo $data['gambar_penginapan']; ?>" style="margin-left: 15px;width: 300px;float: left;margin-bottom: 5px;">
        <input type="file" name="gambar_penginapan" class="form-control" />
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