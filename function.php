<?php
require_once('koneksi.php');

function query($query) {
  global $koneksi;
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
}

// Awal fungsi tamu
function tambah_tamu($data) {
  global $koneksi;
  
  $id = htmlspecialchars($data["id_tamu"]);
  $tanggal = date("Y-m-d");
  $nama_tamu = htmlspecialchars($data["nama_tamu"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $bertemu = htmlspecialchars($data["bertemu"]);
  $kepentingan = htmlspecialchars($data["kepentingan"]);

  // upload gambar
  // $gambar = uploadGambar();
  // if(!$gambar) {
  //   return false;
  // }

  $query = "INSERT INTO buku_tamu VALUES ('$id', '$tanggal', '$nama_tamu', '$alamat', '$no_hp', '$bertemu', '$kepentingan')";
  mysqli_query($koneksi, $query);
  
  return mysqli_affected_rows($koneksi);
}

// function ubah data tamu
function ubah_tamu($data){
  global $koneksi;
  $id = htmlspecialchars($data['id_tamu']);
  $nama_tamu = htmlspecialchars($data['nama_tamu']);
  $alamat = htmlspecialchars($data['alamat']);
  $no_hp = htmlspecialchars($data['no_hp']);
  $bertemu = htmlspecialchars($data['bertemu']);
  $kepentingan = htmlspecialchars($data['kepentingan']);
  $gambarLama = htmlspecialchars($data['gambarLama']);

  // cek apakah user pilih gambar baru atau tidak
  // if($_FILES['gambar']['error'] === 4) {
  //   $gambar = $gambarLama;
  // } else {
  //   $gambar = uploadGambar();
  // }

  $query = "UPDATE buku_tamu SET
            nama_tamu = '$nama_tamu',
            alamat = '$alamat',
            no_hp = '$no_hp',
            bertemu = '$bertemu',
            kepentingan = '$kepentingan'
            WHERE id_tamu = '$id'";
  mysqli_query($koneksi, $query);
  
  return mysqli_affected_rows($koneksi);
};

// hapus tamu 
function hapus_tamu($id) {
  global $koneksi;
  $query = "DELETE FROM buku_tamu WHERE id_tamu = '$id'";
  mysqli_query($koneksi, $query);
  return mysqli_affected_rows($koneksi);
}
?>