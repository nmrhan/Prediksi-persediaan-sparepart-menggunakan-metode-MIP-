<?php
if (isset($_POST['tambahlaporan'])) {
    $tanggal = $_POST['tanggal'];

    $keterangan_berkas = $_POST['keterangan_berkas'];
    $keterangan = $_POST['keterangan'];

    // Handle file upload
    $target_dir = "file_persetujuan/";
    $nama_berkas = basename($_FILES["nama_berkas"]["name"]);
    $target_file = $target_dir . $nama_berkas;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('File already exists.'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB for example)
    if ($_FILES["nama_berkas"]["size"] > 2000000) {
        echo "<script>alert('Sorry, your file is too large.'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
        && $fileType != "pdf" && $fileType != "doc" && $fileType != "docx"
    ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG, PDF, DOC & DOCX files are allowed.'); window.history.back();</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.'); window.history.back();</script>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["nama_berkas"]["tmp_name"], $target_file)) {
            // Prepare the SQL query
            $query = "INSERT INTO laporan (tanggal, id, keterangan_berkas, nama_berkas, keterangan) VALUES (?, ?, ?, ?, ?)";

            // Prepare statement
            if ($stmt = $koneksi->prepare($query)) {
                // Bind parameters
                $stmt->bind_param("sssss", $tanggal, $id_login, $keterangan_berkas, $nama_berkas, $keterangan);

                // Execute statement
                if ($stmt->execute()) {
                    echo "<script>
                        alert('Tambah data berhasil');
                        window.location.href = '?page=laporan';
                        </script>";
                } else {
                    echo "<script>
                    alert('Data tidak berhasil ditambahkan');
                    window.location.href = '?page=laporan';
                    </script>: ";
                }

                // Close statement
                $stmt->close();
            } else {
                echo "Error: " . $koneksi->error;
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.'); window.history.back();</script>";
        }
    }
}

if (isset($_POST['updatestatus'])) {
    // Ambil data dari form
    $id_laporan = $_POST['id_laporan'];
    $status = $_POST['status'];


    // Buat query untuk memperbarui data di dalam tabel tbl_sanksi
    $query = "UPDATE laporan SET status = '$status' WHERE id_laporan = '$id_laporan'";

    // Jalankan query
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        // Jika berhasil, berikan pesan sukses
        echo '<script>alert("Data status diupdate.");</script>';
        echo '<script>window.location.href = "?page=laporan";</script>';
    } else {
        // Jika gagal, berikan pesan error
        echo "Error: " . mysqli_error($koneksi);
        echo '<script>window.location.href = "?page=laporan";</script>';
    }
}
?>
<style>
    table td:nth-child(8) {
        width: 15vh;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: wrap;
    }
</style>

<div class="container">

    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title ">Laporan Persetujuan</h3>
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-warning" id="btnDiproses">Diproses</button>
                    <button type="button" class="btn btn-primary" id="btnDiterima">Diterima</button>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                        <?php if ($role == 'Divisi Spare Part') { ?>
                            <button id="addButton" type="button" class="btn btn-danger">Tambah</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="card-datatable table-responsive">
         

                <table id="tableDiproses" class="table table-nobordered" style="width:100%; ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>User</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <?php if ($role == 'Divisi Spare Part') { ?>
                                <th>Aksi</th>
                            <?php } else { ?>
                                <th>Validasi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $statement = mysqli_query($koneksi, "SELECT * FROM `laporan` INNER JOIN user ON user.id = laporan.id WHERE status = 'Diproses' ORDER BY id_laporan ASC");
                        foreach ($statement as $key) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $key['tanggal']; ?></td>
                                <td><?php echo $key['nama']; ?></td>
                                <td><?php echo $key['keterangan_berkas']; ?></td>
                                <td><a href="file_persetujuan/<?php echo $key['nama_berkas']; ?>" target="_blank"><?php echo $key['nama_berkas']; ?></a></td>
                                <td><?php echo $key['keterangan']; ?></td>
                                <td>
                                    <?php if ($key['status'] == 'Diproses') {
                                        echo '<button type="button" class="btn btn-warning" style="height:7vh;width:14vh;">Diproses</button>';
                                    } elseif ($key['status'] == 'Diterima') {
                                        echo '<button type="button" class="btn btn-primary" style="height:7vh;width:14vh;">Diterima</button>';
                                    } ?>
                                </td>
                                <?php if ($role == 'Divisi Spare Part') { ?>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal<?php echo $key['id_laporan']; ?>"><span class="ti ti-edit"></span></button>
                                        <button type="button" class="btn btn-icon btn-danger"><a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=laporan&aksi=deletelaporan&id_laporan=<?php echo $key['id_laporan']; ?>" style="color:white;"><span class="ti ti-trash"></span></a></button>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal<?php echo $key['id_laporan']; ?>"><span class="ti ti-edit"></span></button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <table id="tableDiterima" class="table table-nobordered" style="width:100%; display: none;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>User</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <?php if ($role == 'Divisi Spare Part') { ?>
                                <th>Aksi</th>
                            <?php } else { ?>
                                <th>Validasi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $statement = mysqli_query($koneksi, "SELECT * FROM `laporan` INNER JOIN user ON user.id = laporan.id WHERE status = 'Diterima' ORDER BY id_laporan ASC");
                        foreach ($statement as $key) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $key['tanggal']; ?></td>
                                <td><?php echo $key['nama']; ?></td>
                                <td><?php echo $key['keterangan_berkas']; ?></td>
                                <td><a href="file_persetujuan/<?php echo $key['nama_berkas']; ?>" target="_blank"><?php echo $key['nama_berkas']; ?></a></td>
                                <td><?php echo $key['keterangan']; ?></td>
                                <td>
                                    <?php if ($key['status'] == 'Diproses') {
                                        echo '<button type="button" class="btn btn-warning" style="height:7vh;width:14vh;">Diproses</button>';
                                    } elseif ($key['status'] == 'Diterima') {
                                        echo '<button type="button" class="btn btn-primary" style="height:7vh;width:14vh;">Diterima</button>';
                                    } ?>
                                </td>
                                <?php if ($role == 'Divisi Spare Part') { ?>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal<?php echo $key['id_laporan']; ?>"><span class="ti ti-edit"></span></button>
                                        <button type="button" class="btn btn-icon btn-danger"><a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=laporan&aksi=deletelaporan&id_laporan=<?php echo $key['id_laporan']; ?>" style="color:white;"><span class="ti ti-trash"></span></a></button>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal<?php echo $key['id_laporan']; ?>"><span class="ti ti-edit"></span></button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="canvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tambah Laporan Persetujuan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="addNewUserForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label" for="kode-barang">Tanggal Pengajuan</label>
                <input type="date" class="form-control" id="tanggal" placeholder=" " name="tanggal" aria-label="tanggal" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="kode-barang">Deskripsi</label>
                <input type="text" class="form-control" id="keterangan_berkas" placeholder=" " name="keterangan_berkas" aria-label="keterangan_berkas" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="kode-barang">File</label>
                <input type="file" class="form-control" id="nama_berkas" placeholder=" " name="nama_berkas" aria-label="nama_berkas" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="keterangan">Keterangan</label>
                <input type="text" id="qty" class="form-control" placeholder=" " aria-label="keterangan" name="keterangan" />
            </div>
            <button type="submit" name="tambahlaporan" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
<?php
$sql = $koneksi->query("SELECT * FROM laporan");
while ($data = $sql->fetch_assoc()) {
?>
    <div class="modal fade" id="statusModal<?php echo $data['id_laporan']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <input type="hidden" name="id_laporan" value="<?php echo $data['id_laporan']; ?>">
                    <div class="modal-body">
                        <div class="row">

                            <label class="form-label" for="id">Status</label>
                            <select name="status" class="form-select show-tick" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Diproses" <?php if ($data['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                                <option value="Diterima" <?php if ($data['status'] == 'Diterima') echo 'selected'; ?>>Diterima</option>


                            </select>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="updatestatus">Update</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php  } ?>

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
  
    $(document).ready(function() {
    var diterimaTableInitialized = false;
    var diprosesTableInitialized = false; // Ubah menjadi false agar tabel Diproses tidak terinisialisasi saat halaman pertama kali dimuat

    // Inisialisasi DataTable untuk tableDiproses saat halaman pertama kali dimuat
    $('#tableDiproses').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "pageLength": 10,
        "language": {
            "paginate": {
                "previous": "<",
                "next": ">"
            }
        }
    });

    $('#btnDiproses').on('click', function() {
        if (diprosesTableInitialized) return;

        if ($.fn.DataTable.isDataTable('#tableDiterima')) {
            $('#tableDiterima').DataTable().destroy();
            diterimaTableInitialized = false;
        }
        $('#tableDiterima').hide();
        $('#tableDiproses').show();

        if (!diprosesTableInitialized) {
            $('#tableDiproses').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });
            diprosesTableInitialized = true;
        }
    });

    $('#btnDiterima').on('click', function() {
        if (diterimaTableInitialized) return;

        if ($.fn.DataTable.isDataTable('#tableDiproses')) {
            $('#tableDiproses').DataTable().destroy();
            diprosesTableInitialized = false;
        }
        $('#tableDiproses').hide();
        $('#tableDiterima').show();

        if (!diterimaTableInitialized) {
            $('#tableDiterima').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });
            diterimaTableInitialized = true;
        }
    });
});

</script>