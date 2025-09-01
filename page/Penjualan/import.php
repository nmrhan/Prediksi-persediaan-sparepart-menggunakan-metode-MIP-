<?php 
include('../../koneksi.php');

require '../../vendor/autoload.php';

// Fungsi untuk mengimpor data dari Excel ke database
function importDataFromExcel($koneksi, $file)
{
    // Load berkas Excel
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

    // Ambil sheet pertama
    $sheet = $spreadsheet->getActiveSheet();

    // Mendapatkan jumlah baris dan kolom
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // Mulai dari baris kedua untuk mengabaikan header
    for ($row = 9; $row <= $highestRow; ++$row) {
        // Ambil nilai dari setiap kolom
        $tanggalExcel = $sheet->getCellByColumnAndRow(2, $row)->getValue();
        $jumlah = $sheet->getCellByColumnAndRow(20, $row)->getValue();
        $kode_barang = $sheet->getCellByColumnAndRow(15, $row)->getValue();

        // Konversi tanggal dari Excel ke format SQL
        if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($sheet->getCellByColumnAndRow(1, $row))) {
            $tanggalObj = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggalExcel);
            $tanggal = $tanggalObj->format('Y-m-d');
        } else {
            $tanggal = date('Y-m-d', strtotime($tanggalExcel)); // Backup untuk format teks
        }

        // Query untuk memasukkan data ke dalam tabel
        $query = "INSERT INTO penjualan (tanggal, jumlah, kode_barang) VALUES ('$tanggal', $jumlah, '$kode_barang')";

        // Jalankan query
        mysqli_query($koneksi, $query);
    }
}

// Check apakah tombol import ditekan
if (isset($_POST['import'])) {
    // Path untuk menyimpan file yang diunggah
    $target_dir = "../../excel_penjualan/";
    $target_file = $target_dir . basename($_FILES["import_excel"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check jika file sudah ada
    if (file_exists($target_file)) {

        echo '<script>alert("File already exists.");</script>';
        echo '<script>window.location.href = "../../index?page=penjualan";</script>';
        $uploadOk = 0;
    }

    // Check ekstensi file
    if ($fileType != "xlsx" && $fileType != "xls") {

        echo '<script>alert("Only Excel files are allowed.");</script>';
        echo '<script>window.location.href = "../../index?page=penjualan";</script>';
        $uploadOk = 0;
    }

    // Upload file
    if ($uploadOk == 0) {
        echo "File upload failed.";
    } else {
        if (move_uploaded_file($_FILES["import_excel"]["tmp_name"], $target_file)) {

            echo '<script>alert("File uploaded successfully.");</script>';
            echo '<script>window.location.href = "../../index?page=penjualan";</script>';
            // Panggil fungsi import
            importDataFromExcel($koneksi, $target_file);
        } else {
            echo '<script>alert("File upload failed.");</script>';
            echo '<script>window.location.href = "../../index?page=penjualan";</script>';
        }
    }
}


?>