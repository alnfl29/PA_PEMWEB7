<?php

require 'koneksi.php';
$search_query = $_POST['search_query'];
$hasil = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk LIKE '%$search_query%'");
?>