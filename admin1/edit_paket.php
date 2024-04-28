<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php');
// mengecek apakah di url ada nilai GET id
  if (isset($_GET['new_id_pakettour'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $new_id_pakettour = ($_GET["new_id_pakettour"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM tbl_paket WHERE new_id_pakettour='$new_id_pakettour'";
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
          echo "<script>alert('Data tidak ditemukan pada database');window.location='adminpaket.php.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='adminpaket.php';</script>";
  }
?>

<center>
    <h1>Edit Produk <?php echo $data['namapaket']; ?></h1>
</center>
<form action="crudpaket/proses_editpaket.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="new_id_pakettour" class="form-control" value="<?php echo $data['new_id_pakettour']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Paket</label>
        <input type="text" name="namapaket" class="form-control" value="<?php echo $data['namapaket']; ?>">
    </div>
     <div class="form-group">
        <label>Kode Paket</label>
        <input type="text" name="kode_paket" class="form-control" value="<?php echo $data['kode_paket']; ?>">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi_paket" class="form-control" value="<?php echo $data['deskripsi_paket']; ?>">
    </div>
     <div class="form-group">
        <label>Tiket Paket</label>
        <input type="text" name="sisa_paket" class="form-control" value="<?php echo $data['sisa_paket']; ?>">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" name="harga_paket" class="form-control" value="<?php echo $data['harga_paket']; ?>">
    </div>
    <div class="form-group">
        <img src="gambar/<?php echo $data['gambar_paket']; ?>" style="margin-left: 15px;width: 300px;float: left;margin-bottom: 5px;">
        <input type="file" name="gambar_paket" class="form-control" />
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