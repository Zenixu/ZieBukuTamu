<?php
// require_once untuk memanggil file koneksi
require_once('koneksi.php');

// untuk membuat query dari database 
function query($query) {
  global $koneksi;
  $result = mysqli_query($koneksi,$query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
?>