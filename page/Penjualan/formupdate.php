<?php
$id = $_GET['id_penjualan'];

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


<?php
$sql = $koneksi->query("SELECT * FROM penjualan 
     INNER JOIN `persediaan` ON persediaan.kode_barang = penjualan.kode_barang WHERE id_penjualan ='$id' ");
while ($data = $sql->fetch_assoc()) {
?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Penjualan</h5>

                    </div>
                    <form method="post" action="page/penjualan/updatepenjualan.php">
                        <input type="hidden" name="id_penjualan" value="<?php echo $data['id_penjualan']; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" id="tanggal" class="form-control" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="spare-part-autocomplete">Kode Spare Part</label>
                                    <input id="spare-part-autocomplete" class="form-control" type="text" placeholder="kode sparepart" value="<?php echo $data['kode_barang']; ?>" required readonly>
                                    <input type="hidden" name="kode_barang" id="kode_barang">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="spare-part-autocomplete">Nama Spare Part</label>
                                    <input id="spare-part-autocomplete" class="form-control" type="text" placeholder="nama sparepart" value="<?php echo $data['nama_barang']; ?>" required readonly>
                                    <input type="hidden" name="nama_barang" id="nama_barang">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" id="jumlah" class="form-control" placeholder=" " value="<?php echo $data['jumlah']; ?>" name="jumlah" required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="window.history.go(-1)" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-primary" name="updatepenjualan">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var spareParts = <?php echo $sparePartsJson; ?>;
        var input = document.getElementById("spare-part-autocomplete");

        new Awesomplete(input, {
            list: spareParts.map(function(part) {
                return {
                    label: part.kode + ' | ' + part.nama,
                    value: part.kode
                };
            }),
            replace: function(suggestion) {
                this.input.value = suggestion.label;
                document.getElementById("kode_barang").value = suggestion.value;
            }
        });
    });
</script>