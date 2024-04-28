<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php')
?>

<!-- Tabel penambahan admin Trip Buddy -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Destinasi </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="crudpaket/proses_tambahpaket.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

            <div class="form-group">
                <label> Kode Paket </label>
                <input type="text" name="kode_paket" class="form-control" placeholder="Enter Nama">
            </div>
            <div class="form-group">
                <label> Nama Paket </label>
                <input type="text" name="namapaket" class="form-control" placeholder="Enter Nama">
            </div>
            <div class="form-group">
                <label> Nama Destinasi </label>
                <select name="id_destinasi" class="form-control">
                  <?php
                  // query to fetch all destinations from tbl_destinasi
                  $query_destinations = "SELECT * FROM tbl_destinasi";
                  $result_destinations = mysqli_query($konek, $query_destinations);
                  
                  // loop through the results and create an option for each destination
                  while ($row_destination = mysqli_fetch_assoc($result_destinations)) {
                      echo '<option value="' . $row_destination['id_destinasi'] . '">' . $row_destination['kode_destinasi'] . '</option>';
                  }
                  ?>
              </select>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <input type="text" name="deskripsi_paket" class="form-control" placeholder="Enter Deskripsi">
            </div>
            <div class="form-group">
                <label>Tiket Paket</label>
                <input type="text" name="sisa_paket" class="form-control" placeholder="Enter Tiket Destinasi">
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga_paket" class="form-control" placeholder="Enter Harga">
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar_paket" class="form-control">
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
    <h6 class="m-0 font-weight-bold text-primary">Paket Wisata
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Tambah Paket 
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> No </th>
            <th> Kode Paket </th>
            <th> Nama Paket </th>
            <th> Kode Destinasi </th>
            <th> Nama Destinasi</th>
            <th> Deskripsi </th>
            <th> Tiket Paket </th>
            <th> Harga</th>
            <th> Gambar </th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
          <?php
            // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
            $query = "SELECT * FROM tbl_paket
                JOIN tbl_destinasi ON tbl_paket.id_destinasi = tbl_destinasi.id_destinasi";

            if (isset($_POST['search'])) {
                  $keyword = $_POST['search'];
                  $query .= " WHERE namapaket LIKE '%$keyword%'";
              }
            $result = mysqli_query($konek, $query);
            //mengecek apakah ada error ketika menjalankan query
            if(!$result){
              die ("Query Error: ".mysqli_errno($konek).
                 " - ".mysqli_error($konek));
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
          <td><?php echo $row['kode_paket']; ?></td>
          <td><?php echo $row['namapaket']; ?></td>
          <td><?php echo $row['kode_destinasi']; ?></td>
          <td><?php echo $row['nama_destinasi']; ?></td>
          <td><?php echo $row['deskripsi_paket']; ?></td>
          <td><?php echo $row['sisa_paket']; ?></td>
          <td>Rp <?php echo number_format($row['harga_paket'],0,',','.'); ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_paket']; ?>" style="width: 120px;"></td>
          <td>
                <form action="edit_paket.php?new_id_pakettour=<?php echo $row['new_id_pakettour']; ?>" method="post">
                    <input type="hidden" name="edit_id" value="" >
                    <button type="submit" name="edit_btn" class="btn btn-success">Edit</button>
                </form>
          </td>
          <td>
                <form action="crudpaket/proses_hapus.php?new_id_pakettour=<?php echo $row['new_id_pakettour']; ?>" method="post">
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