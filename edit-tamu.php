<?php
require_once('koneksi.php');
require_once('function.php');
include_once('templates/header.php');
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Edit Data Tamu</h1>

  <?php
  // Cek jika tombol simpan ditekan
  if (isset($_POST['simpan'])) {
      if (ubah_tamu($_POST) > 0) {
          echo '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>';
          echo "<meta http-equiv='refresh' content='1; url=buku-tamu.php'>";
      } else {
          echo '<div class="alert alert-danger" role="alert">Data gagal diubah!</div>';
      }
  }

  // Ambil data berdasarkan id dari URL
  if (isset($_GET['id'])) {
      $id_tamu = $_GET['id'];
      $result = mysqli_query($koneksi, "SELECT * FROM buku_tamu WHERE id_tamu = '$id_tamu'") or die(mysqli_error($koneksi));
      $data = mysqli_fetch_assoc($result);
  } else {
      die("<div class='alert alert-danger'>ID tidak ditemukan!</div>");
  }
  ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6>Data Tamu</h6>
    </div>
    <div class="card-body">
      <form method="post" action="">
        <input type="hidden" name="id_tamu" value="<?= $data['id_tamu'] ?>">

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Tamu</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="nama_tamu" value="<?= $data['nama_tamu'] ?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Alamat</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="alamat"><?= $data['alamat'] ?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No. Telepon</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="no_hp" value="<?= $data['no_hp'] ?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Bertemu dg.</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="bertemu" value="<?= $data['bertemu'] ?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kepentingan</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="kepentingan" value="<?= $data['kepentingan'] ?>">
          </div>
        </div>

        <div class="modal-footer">
          <a href="buku-tamu.php" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('templates/footer.php'); ?>
