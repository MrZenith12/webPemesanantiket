<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php')
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Export To
            <button type="button" class="btn btn-primary" onclick="location.href='Export/prosesexcelpenginapan.php';">
              Excel
            </button>

    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> No </th>
            <th> Kode User </th>
            <th> Nama </th>
            <th> Email </th>
            <th> Alamat </th>
            <th> No Telepon </th>
            <th> Harga Paket </th>
            <th> Nama Paket </th>
            <th> Jumlah Orang </th>
            <th> Tanggal Pergi </th>
            <th> Tanggal Pulang </th>
            <th> Bank </th>
            <th> Nomor Rekening </th>
            <th> Total Harga </th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>


         <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan 
      $query = "SELECT * FROM tbl_pespenginapan ";

      if (isset($_POST['search'])) {
          $keyword = $_POST['search'];
          $query .= " WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR no_telepon LIKE '%$keyword%' OR nama_penginapan LIKE '%$keyword%'";
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
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
        <tbody>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['id_user']; ?></td>
          <td><?php echo $row['nama']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['alamat']; ?></td>
          <td><?php echo $row['no_telepon']; ?></td>
          <td>Rp <?php echo number_format($row['harganip'],0,',','.'); ?></td>
          <td><?php echo $row['nama_penginapan']; ?></td>
          <td><?php echo $row['jumlah_orang']; ?></td>
          <td><?php echo $row['tgl_pergi']; ?></td>
          <td><?php echo $row['tgl_pulang']; ?></td>
          <td><?php echo $row['bank']; ?></td>
          <td><?php echo $row['no_rek']; ?></td>
          <td>Rp <?php echo number_format($row['total_harga'],0,',','.'); ?></td>
          <td>
                <form action="editpemesananpenginapan.php?id_pesnip=<?php echo $row['id_pesnip']; ?>" method="post">
                    <input type="hidden" name="edit_id" value="" >
                    <button type="submit" name="edit_btn" class="btn btn-success">Edit</button>
                </form>
          </td>
          <td>
                <form action="prosespemesanan/penginapan/proseshapus.php?id_pesnip=<?php echo $row['id_pesnip']; ?>" method="post">
                  <input type="hidden" name="delete_id" value="" >
                  <button type="submit" name="delete_btn" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</button>
                </form>
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
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