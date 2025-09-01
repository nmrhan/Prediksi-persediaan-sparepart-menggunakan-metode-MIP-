<?php

// Query untuk mendapatkan data penjualan selama 6 bulan terakhir per barang
$query = "SELECT kode_barang, MONTH(tanggal) AS bulan, SUM(jumlah) AS total_jumlah 
          FROM penjualan 
          WHERE tanggal >= DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 6 MONTH)
          GROUP BY kode_barang, MONTH(tanggal)";

$result = $koneksi->query($query);

// Array untuk menyimpan jumlah penjualan per bulan per barang
$penjualan_per_barang = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kode_barang = $row['kode_barang'];
        $bulan = $row['bulan'];
        $jumlah = $row['total_jumlah'];

        // Menyimpan jumlah penjualan per bulan
        $penjualan_per_barang[$kode_barang][$bulan] = $jumlah;
    }
}

// Array untuk menyimpan MAD dan MIP per barang
$hasil_prediksi = array();

// Mendefinisikan variabel OC, LT, dan SS
$oc = 5 / 22;
$lt = 9 / 22;
$ss = 2 / 22;

foreach ($penjualan_per_barang as $kode_barang => $penjualan) {
    // Menghitung total penjualan untuk 6 bulan terakhir
    $total_penjualan = array_sum($penjualan);

    // Menghitung MAD dengan membagi dengan jumlah bulan (di sini, 6 bulan)
    $mad = number_format($total_penjualan / 6, 2);

    // Menghitung MIP
    $mip = round($mad * ($oc + $lt + $ss));

    // Menyimpan hasil prediksi hanya jika MIP lebih dari 0
    if ($mip > 0) {
        $hasil_prediksi[$kode_barang] = array(
            'MAD' => $mad,
            'MIP' => $mip
        );
    }
}
?>


<div class="container">
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title"  id="tableTitle">Data Prediksi</h3>
            <div class="text-end">
            </div>
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="example1" class="table table-nobordered datatables-basic table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Sparepart</th>
                            <th>Nama Sparepart</th>
                            <!-- <th>MAD</th> -->
                            <th>MIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Tampilkan data dalam tabel HTML
                        $no = 1;
                        foreach ($hasil_prediksi as $kode_barang => $hasil) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                       
                            // Ambil nama barang dari tabel persediaan berdasarkan kode_barang
                            $query1 = "SELECT * FROM persediaan WHERE kode_barang = '$kode_barang'";
                            $result1 = $koneksi->query($query1);
                            if ($result1 && $result1->num_rows > 0) {
                                $row = $result1->fetch_assoc();
                                echo "<td>" . $row['kode_barang'] . "</td>";
                                echo "<td>" . $row['nama_barang'] . "</td>";
                            } else {
                                echo "<td>Data tidak ditemukan</td>";
                                echo "<td>Data tidak ditemukan</td>";
                            }
                            echo "<td>" . round($hasil['MIP']) . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Tutup koneksi
$koneksi->close();
?>
