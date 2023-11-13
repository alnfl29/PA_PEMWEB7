<?php

$server = "localhost";
$user = "root";
$password = "";
$name = "tokocoklat";

$koneksi = mysqli_connect($server, $user, $password, $name);

if (!$koneksi) {
    die("gagal konek : " . mysqli_connect_error());
}

?>