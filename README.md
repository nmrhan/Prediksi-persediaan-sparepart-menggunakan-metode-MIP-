# Sistem Informasi Prediksi Persediaan Sparepart

Aplikasi ini adalah sistem informasi berbasis web yang digunakan untuk memprediksi persediaan sparepart menggunakan metode **Maximum Inventory Position (MIP)**.  
Dibangun menggunakan **PHP** dengan database **MySQL**.

## 🚀 Fitur Utama
- **Kelola User**
  - **Service Manager** → bertugas melakukan persetujuan pembelian.
  - **Divisi Sparepart** → mengelola data persediaan & penjualan.
- **Kelola Persediaan (Sparepart)**
  -  data sparepart.
  - Monitoring jumlah stok.
- **Kelola Penjualan**
  - Import data penjualan dari file.
  - Tambah data penjualan manual.
- **Prediksi Persediaan**
  - Menghitung prediksi kebutuhan sparepart berdasarkan metode **MIP (Maximum Inventory Position)**.
  - Menampilkan hasil prediksi dalam bentuk tabel.
- **Laporan Persetujuan Pembelian**
  - Menyediakan laporan hasil prediksi untuk persetujuan pembelian oleh Service Manager.

## 🛠️ Teknologi yang Digunakan
- PHP 7.4+
- MySQL
- Bootstrap / CSS
- Chart.js (untuk visualisasi prediksi, jika digunakan)


## ⚙️ Instalasi
Clone repository:
   ```bash
   git clone https://github.com/USERNAME/sistem-prediksi-persediaan-sparepart.git
   cd sistem-prediksi-persediaan-sparepart
