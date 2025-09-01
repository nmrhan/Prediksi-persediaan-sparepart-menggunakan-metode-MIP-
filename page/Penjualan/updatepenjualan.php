<?php 
include('../../koneksi.php');
 


if (isset($_POST['updatepenjualan'])) {
    // Ambil data dari form
    $id_penjualan = $_POST['id_penjualan'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    // Buat query untuk memperbarui data di dalam tabel penjualan
    $query = "UPDATE penjualan SET id_penjualan = '$id_penjualan', tanggal = '$tanggal', jumlah = '$jumlah' WHERE id_penjualan = '$id_penjualan'";

    // Jalankan query
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        // Jika berhasil, berikan pesan sukses
        echo '<script>alert("Data berhasil diupdate.");</script>';
        echo '<script>window.location.href = "../../index?page=penjualan";</script>';
    } else {
        // Jika gagal, berikan pesan error
        echo "Error: " . mysqli_error($koneksi);
        echo '<script>window.location.href = "../../index?page=penjualan";</script>';
    }
}




?>