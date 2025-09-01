<!-- build:js assets/vendor/js/core.js -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/popper/popper.js"></script>
<script src="assets/vendor/js/bootstrap.js"></script>
<script src="assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="assets/vendor/js/menu.js"></script>
<!-- endbuild -->
<!-- Vendors JS -->
<script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="assets/vendor/libs/swiper/swiper.js"></script>
<!-- Vedors JS -->
<script src="assets/vendor/libs/moment/moment.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script src="assets/vendor/libs/%40form-validation/popular.js"></script>
<script src="assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
<script src="assets/vendor/libs/%40form-validation/auto-focus.js"></script>
<script src="assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<!-- Vendors JS -->
<script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>
<!-- Page JS -->
<script src="assets/js/dashboards-crm.js"></script>
<script src="assets/js/extended-ui-sweetalert2.js"></script>

<!-- Page JS -->
<script src="assets/js/dashboards-analytics.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#example').DataTable({
      "paging": true, // Aktifkan pagination
      "searching": true, // Aktifkan pencarian
      "ordering": true, // Aktifkan pengurutan
      "info": true, // Tampilkan informasi jumlah data
      "lengthChange": true, // Aktifkan pengubahan jumlah data per halaman
      "pageLength": 10, // Jumlah data per halaman
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      }
    });
  });

</script>

<script>
  $(document).ready(function () {
    $('#penjualan').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "data_penjualan.php", // Ganti dengan nama file server-side script Anda
        "type": "POST"
      },
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
      },
      "columns": [
        { "data": "No" },
        { "data": "Tanggal" },
        { "data": "Kode Spare Part" },
        { "data": "Nama Spare Part" },
        { "data": "Jumlah" },
        {
          "data": "Aksi",
          "orderable": false,
          "searchable": false,
          "defaultContent": "" // Tambahkan default content kosong
        }
      ]
    });
  });
</script>

<script>
  $(document).ready(function () {
    $('#persediaan').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "data_persediaan.php", // Ganti dengan nama file server-side script Anda
        "type": "POST"
      },
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
      },
      "columns": [
        { "data": "No" },
        { "data": "Kode Barang" },
        { "data": "Nama Barang" },
        { "data": "Tipe" },
        {
          "data": "Aksi",
          "orderable": false,
          "searchable": false,
          "defaultContent": "" // Tambahkan default content kosong
        }
      ]

    });
  });
</script>



<script>
  $(document).ready(function () {
    $('#example1').DataTable({
      dom: '<"card-header flex-column flex-md-row"<"#tableTitle.card-title"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      buttons: [
        {
          extend: "collection",
          className: "btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light",
          text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [
            {
              extend: "print",
              text: '<i class="ti ti-printer me-1"></i>Print',
              className: "dropdown-item",
              exportOptions: {
                columns: ':visible',
              },
              customize: function (win) {
                $(win.document.body)
                  .css("color", '#000')
                  .css("border-color", '#ddd')
                  .css("background-color", '#fff');
                $(win.document.body).find("table")
                  .addClass("compact")
                  .css("color", "inherit")
                  .css("border-color", "inherit")
                  .css("background-color", "inherit");
              }
            },
            {
              extend: "csv",
              text: '<i class="ti ti-file-text me-1"></i>Csv',
              className: "dropdown-item",
              exportOptions: {
                columns: ':visible',
              }
            },
            {
              extend: "excel",
              text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
              className: "dropdown-item",
              exportOptions: {
                columns: ':visible',
              }
            },
            {
              extend: "pdf",
              text: '<i class="ti ti-file-description me-1"></i>Pdf',
              className: "dropdown-item",
              exportOptions: {
                columns: ':visible',
              }
            },
            {
              extend: "copy",
              text: '<i class="ti ti-copy me-1"></i>Copy',
              className: "dropdown-item",
              exportOptions: {
                columns: ':visible',
              }
            }
          ]
        }
      ]
    });
  });
</script>
<script>
  window.addEventListener('load', function () {
    const preloader = document.getElementById('preloader');
    const layoutWrapper = document.querySelector('.layout-wrapper');

    preloader.style.display = 'none';
    layoutWrapper.style.display = 'block';
  });

  document.addEventListener('DOMContentLoaded', function () {
    var logoutButton = document.getElementById('logoutButton');

    if (logoutButton) {
      logoutButton.addEventListener('click', function (event) {
        event.preventDefault();
        Swal.fire({
          title: "Are you sure?",
          text: "Do you really want to log out?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes, log out",
          cancelButtonText: "Cancel",
          customClass: {
            confirmButton: "btn btn-primary me-3 waves-effect waves-light",
            cancelButton: "btn btn-label-secondary waves-effect waves-light",
          },
          buttonsStyling: false,
        }).then(function (result) {
          if (result.isConfirmed) {
            // Redirect to the logout page
            window.location.href = 'logout.php'; // Ubah "logout.php" sesuai dengan halaman logout Anda
          }
        });
      });
    }
  });
</script>