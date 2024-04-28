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
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="crudprofil/prosestambah.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label> Password </label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>No.telepon</label>
                <input type="no_telepon" name="no_telepon" class="form-control" placeholder="Enter No.Telp">
            </div>
            <div class="form-group">
                <label> Role </label>
                <select name="role" class="form-control">
                  <option value="">-- Pilih --</option>
                  <option >admin</option>
                  <option >user</option>
              </select>
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
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Tambah Admin 
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> No </th>
            <th> Username </th>
            <th> Password </th>
            <th> Email</th>
            <th> No.Telp </th>
            <th> Role</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        
         <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan 
      $query = "SELECT * FROM tbl_login";

      if (isset($_POST['search'])) {
          $keyword = $_POST['search'];
          $query .= " WHERE username LIKE '%$keyword%' OR email LIKE '%$keyword%' OR no_telepon LIKE '%$keyword%'";
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
        <tbody>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['username']; ?></td>
          <td><?php echo $row['password']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['no_telepon']; ?></td>
          <td><?php echo $row['role']; ?></td>
          <td>
                <form action="editprofil.php?id_user=<?php echo $row['id_user']; ?>" method="post">
                    <input type="hidden" name="edit_id" value="" >
                    <button type="submit" name="edit_btn" class="btn btn-success">Edit</button>
                </form>
          </td>
          <td>
                <form action="crudprofil/proseshapus.php?id_user=<?php echo $row['id_user']; ?>" method="post">
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