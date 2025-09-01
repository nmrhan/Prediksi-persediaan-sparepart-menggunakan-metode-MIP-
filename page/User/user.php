<?php
if (isset($_POST['tambahuser'])) {
    // Ambil data dari form
    $nama = $_POST['userFullname'];
    $username = $_POST['userUsername'];
    $password = md5($_POST['userPassword']); // Enkripsi password
    $role = $_POST['role'];
    // Validasi Username
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Username sudah ada dalam database
        echo '<script>alert("Username sudah ada dalam database. Silakan coba lagi.");</script>';
    } else {
        // Username belum ada dalam database, tambahkan data
        $insert_query = "INSERT INTO user (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')";
        if (mysqli_query($koneksi, $insert_query)) {
            echo '<script>alert("Data user berhasil ditambahkan.");</script>';
            echo '<script>window.location.href = "?page=users";</script>'; // Ganti halaman_tujuan.php dengan halaman yang sesuai
        } else {
            echo '<script>alert("Terjadi kesalahan dalam penambahan data user.");</script>';
        }
    }
}
if (isset($_POST['updatesparepart'])) {
    // Ambil data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Buat query untuk memperbarui data di dalam tabel penjualan
    $query = "UPDATE user SET nama = '$nama', username = '$username', role = '$role' WHERE id = '$id'";

    // Jalankan query
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        // Jika berhasil, berikan pesan sukses
        echo '<script>alert("Data berhasil diupdate.");</script>';
        echo '<script>window.location.href = "?page=users";</script>';
    } else {
        // Jika gagal, berikan pesan error
        echo "Error: " . mysqli_error($koneksi);
        echo '<script>window.location.href = "?page=users";</script>';
    }
}
?>

<div class="container-xxl flex-grow-1 container-p-y">



    <!--<div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Manager</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">4,567</h3>
                                <p class="text-success mb-0">(+18%)</p>
                            </div>
                            <p class="mb-0">Users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="ti ti-user-plus ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Section Head</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">19,860</h3>
                                <p class="text-danger mb-0">(-14%)</p>
                            </div>
                            <p class="mb-0">Users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="ti ti-user-check ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Foreman</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">237</h3>
                                <p class="text-success mb-0">(+42%)</p>
                            </div>
                            <p class="mb-0">users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="ti ti-user-exclamation ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Staff</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">21,459</h3>
                                <p class="text-success mb-0">(+29%)</p>
                            </div>
                            <p class="mb-0">Users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title ">Data user</h3>
            <div class="text-end ">
                <button id="addButton" type="button" class="btn btn-danger">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="example" class="table table-nobordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $statement = mysqli_query($koneksi, "SELECT * FROM `user` ORDER BY id DESC");
                        foreach ($statement as $key) {
                        ?>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $key['nama']; ?></td>
                            <td><?php echo $key['username']; ?></td>
                            <td><?php echo $key['role']; ?></td>
                  
                            <td>
                                <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $key['id']; ?>">
                                    <span class="ti ti-edit"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-danger">
                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=users&aksi=deleteuser&id=<?php echo $key['id']; ?>" style="color:white;">
                                        <span class="ti ti-trash"></span>
                                    </a>
                                </button>
                            </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="canvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tambah User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="user-fullname">Nama</label>
                        <input type="text" class="form-control" id="user-fullname" placeholder="masukkan nama" name="userFullname" aria-label="nama" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-username">Username</label>
                        <input type="text" id="user-username" class="form-control" placeholder="masukkan username" aria-label="username" name="userUsername" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-password">Password</label>
                        <input type="password" id="user-password" class="form-control" placeholder="******" aria-label="******" name="userPassword" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-role">Role</label>
                        <select id="user-role" class="form-select" name="role">
                            <option value="Divisi Spare Part">Divisi Spare Part</option>
                            <option value="Service Manager">Service Manager</option>
                        </select>
                    </div>
                    <button type="submit" name="tambahuser" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>
    <!-- edit modal  -->
    <?php
     $sql = $koneksi->query("SELECT * FROM user");
     while ($data = $sql->fetch_assoc()) {
     ?>
         <div class="modal fade" id="editModal<?php echo $data['id']; ?>" tabindex="-1" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form method="post">
                         <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                         <div class="modal-body">
                             <div class="row">
                                 <div class="col mb-3">
                                     <label for="nama" class="form-label">Nama</label>
                                     <input type="text" id="nameBasic" class="form-control" placeholder="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col mb-3">
                                     <label for="name" class="form-label">Username</label>
                                     <input type="text" id="nameBasic" class="form-control" name="username" value="<?php echo $data['username']; ?>" required>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col mb-3">
                                     <label for="Role" class="form-label">Role</label>
                                     <select name="role" class="form-select show-tick" required>  
                                         <option value="Service Manager" <?php if ($data['role'] == 'Service Manager') echo 'selected'; ?>>Service Manager</option>
                                         <option value="Divisi Spare Part" <?php if ($data['role'] == 'Divisi Spare Part') echo 'selected'; ?>>Divisi Spare Part</option>
                                 
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
     <?php  } ?>

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
</script>