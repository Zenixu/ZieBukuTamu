<?php
require_once('function.php');
include_once('templates/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data Users</h1>
  <?php
    if(isset($_POST['simpan'])){
      if(tambah_user($_POST) > 0){
  ?>
  <div class="alert alert-success" role="alert">
    Data berhasil disimpan!
  </div>
  <?php
      } else {
  ?>
  <div class="alert alert-danger" role="alert">
    Data gagal disimpan!
  </div>
  <?php
      }
    }
  ?>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
      <span class="icon text-while-50">
        <i class="fas fa-plus"></i>
      </span>
      <span class="text">Data user</span>
    </button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cel]lspacing="0">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Username</th>
            <th class="text-center">User Role</th>
            <th colspan="2" class="text-center">Aksi</th>
          </tr>
        </thead>
        <!-- <tfoot>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Nama user</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">No HP</th>
            <th class="text-center">Bertemu</th>
            <th class="text-center">Kepentingan</th>
            
          </tr>
        </tfoot> -->
        <tbody>
          <?php
            $no = 1;
            $users = query("SELECT * FROM users");
            foreach($users as $user) : 
          ?>
          <tr>
            <td class="text-center"><?= $no++?></td>
            <td><?= $user['username']?></td>
            <td><?= $user['user_role']?></td>
            <td class="text-center">
              <a class="btn btn-success" href="edit-user.php?id=<?= $user['id_user']?>">Ubah</a>
            </td>
            <td class="text-center">
              <a href="hapus-user.php?id=<?= $user['id_user']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
            </td>
          </tr>
          <?php endforeach?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Membuat id otomatis -->
<?php
// mengambil data barang dari tabel dengan kode terbesar
$query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM users");
$data = mysqli_fetch_array($query);
$kodeuser = $data['kodeTerbesar'];
// mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeuser, 3, 2);

//nomor yang diambil akan ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

//membuat kode barang baru
$huruf = "usr";
$kodeuser = $huruf . sprintf("%02s", $urutan);
?>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="tambahModalLabel">Tambah user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" name="id_user" id="id_user" value="<?= $kodeuser?>">
          <div class="form-group row">
            <label for="nama_user" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="username" name="username">
            </div>
          </div>
          <div class="form-group row">
            <label for="nama_user" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="password" name="password">
            </div>
          </div>
          <div class="form-group row">
            <label for="nama_user" class="col-sm-3 col-form-label">User Role</label>
            <div class="col-sm-8">
              <select name="user_role" id="user_role" class="form-control">
                <option value="admin">Administrator</option>
                <option value="operator">Operator</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
<?php include('templates/footer.php')?>