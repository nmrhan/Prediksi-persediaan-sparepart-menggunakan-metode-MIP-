<?php
if (isset($_POST['tambahsparepart'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $tipe = $_POST['tipe'];

    // Membuat query untuk menyimpan data ke tabel 'persediaan'
    $query = "INSERT INTO persediaan (kode_barang, nama_barang, tipe) VALUES (?, ?, ?)";

    // Mempersiapkan statement
    if ($stmt = $koneksi->prepare($query)) {
        // Mengikat parameter
        $stmt->bind_param("sss", $kode_barang, $nama_barang, $tipe);

        // Menjalankan statement
        if ($stmt->execute()) {
            // Menghasilkan kode JavaScript untuk alert dan pengalihan
            echo "<script>
                alert('Tambah data berhasil');
                window.location.href = '?page=persediaan';
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



<div class="container">
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title">Data Spare Part</h3>
            <div class="text-end">
                <?php if ($role == 'Divisi Spare Part') { ?>
                    <button id="addButton" type="button" class="btn btn-danger">Tambah</button>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="persediaan" class="table table-nobordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Tipe</th>
                            
                            <?php if ($role == 'Divisi Spare Part') { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody></tbody> <!-- Kosongkan tbody untuk DataTables -->
                </table>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="canvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tambah Spare Part</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="addNewUserForm" method="post">
            <div class="mb-3">
                <label class="form-label" for="kode-barang">Kode Barang</label>
                <input type="text" class="form-control" id="kode-barang" placeholder="masukkan kode barang"
                    name="kode_barang" aria-label="kode barang" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nama-barang">Nama Barang</label>
                <input type="text" id="nama-barang" class="form-control" placeholder="masukkan nama barang"
                    aria-label="nama barang" name="nama_barang" />
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="Tipe" class="form-label">Tipe</label>
                    <select name="tipe" class="form-select show-tick" required>
                        <option value="" selected>-- Pilih Tipe --</option>
                        <option value="Part">Part</option>
                        <option value="Oil">Oil</option>
                        <option value="Accessoris">Accessoris</option>

                    </select>
                </div>
            </div>
       
            <button type="submit" name="tambahsparepart"
                class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mengambil tombol "Tambah" dan elemen offcanvas
        var addButton = document.querySelector('#addButton');
        var offcanvas = new bootstrap.Offcanvas(document.querySelector('#canvasAddUser'));

        // Menambahkan event listener ke tombol "Tambah"
        addButton.addEventListener('click', function () {
            offcanvas.show(); // Menampilkan elemen offcanvas saat tombol "Tambah" diklik
        });
    });
</script>