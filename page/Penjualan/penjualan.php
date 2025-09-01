<?php
$spareParts = [];
$sql_id = $koneksi->query("SELECT persediaan.id_persediaan, persediaan.nama_barang, persediaan.kode_barang FROM persediaan");
while ($data_id = $sql_id->fetch_assoc()) {
    $spareParts[] = [
        'id' => $data_id['id_persediaan'],
        'kode' => $data_id['kode_barang'],
        'nama' => $data_id['nama_barang']
    ];
}
$sparePartsJson = json_encode($spareParts);



?>
<div class="container">
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title">Data Penjualan</h3>
            <div class="text-end">
                <?php if ($role == 'Divisi Spare Part') { ?>
                    <button id="addButton" type="button" class="btn btn-danger">Tambah</button>
                   
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                        Import
                    </button>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="penjualan" class="table table-nobordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Spare Part</th>
                            <th>Nama Spare Part</th>
                            <th>Jumlah</th>
                           
                                <th>Aksi</th>
                           </tr>
                    </thead>
                    <tbody></tbody> <!-- Kosongkan tbody untuk DataTables -->
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Import File </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data" action="page/penjualan/import.php">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <input type="file" class="form-control" name="import_excel" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="import">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="canvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tambah Penjualan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="addNewUserForm" method="post" action="page/penjualan/tambahpenjualan.php">
            <div class="mb-3">
                <label class="form-label" for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" placeholder=" " name="tanggal" aria-label="tanggal"
                    required />
            </div>
            <div class="mb-3">
                <label class="form-label" for="spare-part-autocomplete">Kode Spare Part</label><br>
                <input id="spare-part-autocomplete" class="form-control" type="text" placeholder="kode sparepart"
                    required>
                <input type="hidden" name="kode_barang" id="kode_barang">
            </div>
            <div class="mb-3">
                <label class="form-label" for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" class="form-control" placeholder=" " aria-label="jumlah" name="jumlah"
                    required />
            </div>
            <button type="submit" name="tambahpenjualan"
                class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>

        <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengambil tombol "Tambah" dan elemen offcanvas
        var addButton = document.querySelector('#addButton');
        var offcanvas = new bootstrap.Offcanvas(document.querySelector('#canvasAddUser'));

        // Menambahkan event listener ke tombol "Tambah"
        addButton.addEventListener('click', function() {
            offcanvas.show(); // Menampilkan elemen offcanvas saat tombol "Tambah" diklik
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        var spareParts = <?php echo $sparePartsJson; ?>;
        var input = document.getElementById("spare-part-autocomplete");

        new Awesomplete(input, {
            list: spareParts.map(function (part) {
                return {
                    label: part.kode + ' | ' + part.nama,
                    value: part.kode
                };
            }),
            replace: function (suggestion) {
                this.input.value = suggestion.label;
                document.getElementById("kode_barang").value = suggestion.value;
            }
        });
    });
</script>