<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$database = "db_sparepart"; //nama database

$koneksi = mysqli_connect($server, $user, $password, $database);

if (mysqli_connect_error()) {
     echo "Koneksi database gagal : ". mysqli_connect_error();
}
?>