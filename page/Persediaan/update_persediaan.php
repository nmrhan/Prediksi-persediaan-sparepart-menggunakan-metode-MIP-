<?php
include('../../koneksi.php');

// Mendapatkan data dari permintaan POST
$id_persediaan = $_POST['id_persediaan'];
$kode_barang = $_POST['kode_barang'];
$nama_barang = $_POST['nama_barang'];
$tipe = $_POST['tipe'];

// Query untuk mengupdate data persediaan menggunakan prepared statement
$query = $koneksi->prepare("UPDATE persediaan SET kode_barang=?, nama_barang=?, tipe=? WHERE id_persediaan=?");
$query->bind_param("sssi", $kode_barang, $nama_barang, $tipe, $id_persediaan);

if ($query->execute()) {
    // Jika berhasil, berikan pesan sukses
    echo '<script>alert("Data berhasil diupdate.");</script>';
    echo '<script>window.location.href = "../../index?page=persediaan";</script>';
} else {
    // Jika gagal, berikan pesan error
    echo "Error: " . $query->error;
    echo '<script>window.location.href = "../../index?page=persediaan";</script>';
}

$query->close();
$koneksi->close();
?>
