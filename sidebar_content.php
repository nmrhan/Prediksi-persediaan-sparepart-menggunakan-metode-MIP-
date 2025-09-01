  <!-- Content -->
  <?php
          $page = isset($_GET['page']) ? $_GET['page'] : '';
          $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

          if ($page == "dashboard") {
            if ($aksi == "") {
              include "page/Dashboard/dashboard.php";
            }
          }
          if ($page == "servicemanager") {
            if ($aksi == "") {
              include "page/Dashboard/servicemanager.php";
            }
          }
          if ($page == "users") {
            if ($aksi == "") {
              include "page/User/user.php";
            }
            if ($aksi == "deleteuser") {
              include "page/User/deleteuser.php";
            }
          }
          if ($page == "penjualan") {
            if ($aksi == "") {
              include "page/penjualan/penjualan.php";
            }
            if ($aksi == "deletepenjualan") {
              include "page/Penjualan/deletepenjualan.php";
            }
          }
        
          if ($page == "updatepenjualan") {
            if ($aksi == "") {
              include "page/penjualan/formupdate.php";
            }
          }
          if ($page == "persediaan") {
            if ($aksi == "") {
              include "page/persediaan/persediaan.php";
            }
            if ($aksi == "deletepersediaan") {
              include "page/persediaan/deletepersediaan.php";
            }
          }
          if ($page == "updatepersediaan") {
            if ($aksi == "") {
              include "page/persediaan/formupdate.php";
            }
          }
          if ($page == "laporan") {
            if ($aksi == "") {
              include "page/laporan/laporan.php";
            }
            if ($aksi == "deletelaporan") {
              include "page/Laporan/deletelaporan.php";
            }
          }

          if ($page == "prediksi") {
            if ($aksi == "") {
              include "page/prediksi/prediksi.php";
            }
          }
          if ($page == "permintaandiproses") {
            if ($aksi == "") {
              include "page/admin/diproses.php";
            }
          }
          if ($page == "permintaanditolak") {
            if ($aksi == "") {
              include "page/admin/ditolak.php";
            }
          }
          if ($page == "permintaanselesai") {
            if ($aksi == "") {
              include "page/admin/permintaanselesai.php";
            }
          }

          //mhrga

          if ($page == "permintaanbaru") {
            if ($aksi == "") {
              include "page/mhrga/permintaanbaru.php";
            }
          }
          if ($page == "datapermintaan") {
            if ($aksi == "") {
              include "page/mhrga/semuapermintaan.php";
            }
          }

          //hrga
          if ($page == "pengajuanpermintaan") {
            if ($aksi == "") {
              include "page/hrga/pengajuanpermintaan.php";
            }
            if ($aksi == "tambahdata") {
              if (isset($_GET['id'])) {
                $id = $_GET['id'];
                include "page/hrga/tambahbarang.php";
              }
            }
          }

          //finance
          if ($page == "pengajuanbudget") {
            if ($aksi == "") {
              include "page/finance/pengajuanbudget.php";
            }
          }
          if ($page == "pengajuandiproses") {
            if ($aksi == "") {
              include "page/finance/permintaandiproses.php";
            }
          }
          if ($page == "pengajuanselesai") {
            if ($aksi == "") {
              include "page/finance/pengajuanselesai.php";
            }
          }
          ?>
