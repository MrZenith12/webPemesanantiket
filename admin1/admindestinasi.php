<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php')
?>

<!-- Tabel penambahan destinasi Trip Buddy -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Destinasi </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="proses_tambahdestinasi.php" id="form"  method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label> Kode Destinasi </label>
                <input type="text" name="kode_destinasi" class="form-control" placeholder="A - **9">
            </div>
            <div class="form-group">
                <label> Nama Destinasi </label>
                <input type="text" name="nama_destinasi" class="form-control" placeholder="Enter Nama">
            </div>
            <div class="form-group">
                <label> Kode Penginapan </label>
                <select name="id_penginapan" class="form-control">
                  <option value="">-- Pilih --</option>
                  <?php
                  // query to fetch all destinations from tbl_destinasi
                  $query_destinations = "SELECT * FROM tbl_penginapan";
                  $result_destinations = mysqli_query($konek, $query_destinations);
                  
                  // loop through the results and create an option for each destination
                  while ($row_destination = mysqli_fetch_assoc($result_destinations)) {
                      echo '<option value="' . $row_destination['id_penginapan'] . '">' . $row_destination['kode_penginapan'] . '</option>';
                  }
                  ?>
              </select>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" placeholder="Enter Deskripsi">
            </div>
            <div class="form-group">
                <label>Tiket Destinasi</label>
                <input type="text" name="sisa_destinasi" class="form-control" placeholder="Enter Tiket Destinasi">
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" placeholder="Rp. 000">
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar_produk" class="form-control">
                <p> Ekstensi png, jpg dan jpeg</p>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Destinasi Wisata
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Tambah Destinasi 
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th> No </th>
          <th> Kode Destinasi</th>
          <th> Nama Destinasi </th>
          <th> Kode Penginapan </th>
          <th> Nama Penginapan </th>
          <th> Tiket Destinasi </th>
          <th> Deskripsi </th>
          <th> Harga</th>
          <th> Gambar </th>
          <th>EDIT </th>
          <th>DELETE </th>
        </tr>
      </thead>
      <tbody>
        <?php
        // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
           $query = "SELECT * FROM tbl_destinasi JOIN tbl_penginapan ON tbl_destinasi.id_penginapan = tbl_penginapan.id_penginapan"; 

        if (isset($_POST['search'])) {
            $keyword = $_POST['search'];
            $query .= " WHERE nama_destinasi LIKE '%$keyword%'";
        }
        //mengecek apakah ada error ketika menjalankan query
        $result = mysqli_query($konek, $query);
        if(!$result){
          die ("Query Error: ".mysqli_errno($konek)." - ".mysqli_error($konek));
        }

        //buat perulangan untuk element tabel dari data mahasiswa
        $no = 1; //variabel untuk membuat nomor urut

        // hasil query akan disimpan dalam variabel $data dalam bentuk array
        // kemudian dicetak dengan perulangan while
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) 
        {
        ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['kode_destinasi']; ?></td>
          <td><?php echo $row['nama_destinasi']; ?></td>
          <td><?php echo $row['kode_penginapan']; ?></td>
          <td><?php echo $row['nama_penginapan']; ?></td>
          <td><?php echo $row['sisa_destinasi']; ?></td>
          <td><?php echo $row['deskripsi']; ?></td>
          <td>Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>
          <td>
                <form action="edit_destinasi.php?id_destinasi=<?php echo $row['id_destinasi']; ?>" method="post">
                    <input type="hidden" name="edit_id" value="" >
                    <button type="submit" name="edit_btn" class="btn btn-success">Edit</button>
                </form>
          </td>
          <td>
                <form action="proses_hapus.php?id_destinasi=<?php echo $row['id_destinasi']; ?>" method="post">
                  <input type="hidden" name="delete_id" value="" >
                  <button type="submit" name="delete_btn" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</button>
                </form>
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
        }
       } else {
                   // jika data tidak ditemukan
                   echo "<p>Data tidak ditemukan</p>";
                 }
      ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>