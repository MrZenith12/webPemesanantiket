<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../database/koneksi.php');
// mengecek apakah di url ada nilai GET id
  if (isset($_GET['id_user'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id_user = ($_GET["id_user"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM tbl_login WHERE id_user='$id_user'";
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
          echo "<script>alert('Data tidak ditemukan pada database');window.location='register.php.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='register.php';</script>";
  }
?>

<center>
    <h1>Edit Produk <?php echo $data['username']; ?></h1>
</center>
<form action="crudprofil/prosesedit.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="id_user" class="form-control" value="<?php echo $data['id_user']; ?>">
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" name="password" class="form-control" value="<?php echo $data['password']; ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>">
    </div>
    <div class="form-group">
        <label>No.Telepon</label>
        <input type="text" name="no_telepon" class="form-control" value="<?php echo $data['no_telepon']; ?>">
    </div>
    <div class="form-group">
        <label> Role </label>
        <select name="role" class="form-control" value="<?php echo $data['role']; ?>">
          <option >admin</option>
          <option >user</option>
      </select>
    </div>
        
    <div class="form-group">
        <button type="submit" name="update_btn" class="btn btn-primary">Update Data</button>
    </div>
</form>


<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
?>