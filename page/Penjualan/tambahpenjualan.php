<?php 
include('../../koneksi.php');
if (isset($_POST['tambahpenjualan'])) {
    $tanggal = $_POST['tanggal'];
    $kode_barang = $_POST['kode_barang'];
    $jumlah = $_POST['jumlah'];

    // Membuat query untuk menyimpan data ke tabel 'penjualan'
    $query = "INSERT INTO penjualan (tanggal, kode_barang, jumlah) VALUES (?, ?, ?)";

    // Mempersiapkan statement
    if ($stmt = $koneksi->prepare($query)) {
        // Mengikat parameter
        $stmt->bind_param("ssi", $tanggal, $kode_barang, $jumlah);

        // Menjalankan statement
        if ($stmt->execute()) {
            // Menghasilkan kode JavaScript untuk alert dan pengalihan
            echo "<script>
                alert('Tambah data berhasil');
                window.location.href = '../../index?page=penjualan';
                </script>";
        } else {
            // Menampilkan pesan error jika terjadi kesalahan
            echo "Error: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    } else {
        // Menampilkan pesan error jika statement gagal dipersiapkan
        echo "Error: " . $koneksi->error;
    }
}


?>