<?php
$id = $_GET['id_persediaan'];




?>


<?php
$sql = $koneksi->query("SELECT * FROM persediaan 
     WHERE id_persediaan ='$id' ");
while ($data = $sql->fetch_assoc()) {
?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Penjualan</h5>

                    </div>

                    <form method="post" action="page/persediaan/update_persediaan.php">
                        <input type="hidden" name="id_persediaan" value="<?php echo $data['id_persediaan']; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="npk" class="form-label">Kode Barang</label>
                                    <input type="text" id="nameBasic" class="form-control" placeholder="kode barang" name="kode_barang" value="<?php echo $data['kode_barang']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Nama Barang</label>
                                    <input type="text" id="nameBasic" class="form-control" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tipe" class="form-label">Tipe</label>
                                    <select name="tipe" class="form-select show-tick" required>
                                        <option value="Part" <?php if ($data['tipe'] == 'Part')
                                                                    echo 'selected'; ?>>Part</option>
                                        <option value="Oil" <?php if ($data['tipe'] == 'Oil')
                                                                echo 'selected'; ?>>Oil</option>
                                        <option value="Accessoris" <?php if ($data['tipe'] == 'Accessoris')
                                                                        echo 'selected'; ?>>
                                            Accessoris</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="updatesparepart">Update</button>

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