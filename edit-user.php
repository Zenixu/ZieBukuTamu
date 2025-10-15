<?php
require_once('koneksi.php');
require_once('function.php');
include_once('templates/header.php');
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Edit Data user</h1>

  <?php
  // Cek jika tombol simpan ditekan
  if (isset($_POST['simpan'])) {
      if (ubah_user($_POST) > 0) {
          echo '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>';
          echo "<meta http-equiv='refresh' content='1; url=users.php'>";
      } else {
          echo '<div class="alert alert-danger" role="alert">Data gagal diubah!</div>';
      }
  }

  // Ambil data berdasarkan id dari URL
  if (isset($_GET['id'])) {
      $id_user = $_GET['id'];
      $result = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'") or die(mysqli_error($koneksi));
      $data = mysqli_fetch_assoc($result);
  } else {
      die("<div class='alert alert-danger'>ID tidak ditemukan!</div>");
  }
  ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6>Data user</h6>
    </div>
    <div class="card-body">
      <form method="post" action="">
        <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

        <div class="form-group row">
          <label for="user-role" class="col-sm-3 col-form-label">Username</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">User Role</label>
          <div class="col-sm-8">
            <select class="form-control" name="user_role"><?= $data['user_role'] ?>
            <option value="admin" <?= $data['user_role'] == 'admin' ? 'selected' : ''?>>Administrator</option>
            <option value="operator"<?= $data['user_role'] == 'operator' ? 'selected' : ''?>>Operator</option>
          </select>
          </div>
        </div>

        <div class="modal-footer">
          <a href="users.php" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('templates/footer.php'); ?>
