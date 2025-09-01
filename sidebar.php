<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


<div class="app-brand demo mb-3 mt-2  border-bottom">
  <a href="index?page=dashboard" class="app-brand-link">
    <span class="rounded-circle app-brand-logo">
      <img src="assets/img/logo/logo_m1.png" style="height: 5vh; width: 5vh;" class=" rounded-circle">
    </span>
    <span class="app-brand-text demo menu-text fw-bold">SPPS -BTV</span>
  </a>

  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
  </a>
</div>

<div class="menu-inner-shadow"></div>


<ul class="menu-inner py-1">
  <?php if ($role == 'Divisi Spare Part') { ?>
    <li class="menu-item <?php echo ($page == 'dashboard') ? 'active' : ''; ?>">
      <a href="?page=dashboard" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>

    <li class="menu-item <?php echo ($page == 'users') ? 'active' : ''; ?>">
      <a href="?page=users" class="menu-link">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Users">Users</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($page == 'persediaan') ? 'active' : ''; ?>">
      <a href="?page=persediaan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-files"></i>
        <div data-i18n="Data Master">Persediaan</div>
      </a>
    </li>

    <li class="menu-item <?php echo ($page == 'penjualan') ? 'active' : ''; ?>">
      <a href="?page=penjualan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-package"></i>
        <div data-i18n="Penjualan">Penjualan</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($page == 'prediksi') ? 'active' : ''; ?>">
      <a href="?page=prediksi" class="menu-link">
        <i class="menu-icon tf-icons ti ti-device-analytics"></i>
        <div data-i18n="Prediksi">Prediksi</div>
      </a>
    </li>


    <li class="menu-item <?php echo ($page == 'laporan') ? 'active' : ''; ?>">
      <a href="?page=laporan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-checklist"></i>
        <div data-i18n="Laporan Persetujuan">Laporan Persetujuan</div>
      </a>
    </li>


    <!-- <li class="menu-item <?php echo ($page == 'report') ? 'active' : ''; ?>">
      <a href="?page=report" class="menu-link">
        <i class="menu-icon tf-icons ti ti-report"></i>
        <div data-i18n="Report">Report</div>
      </a>
    </li> -->
  <?php } else { ?>
    <li class="menu-item <?php echo ($page == 'servicemanager') ? 'active' : ''; ?>">
      <a href="?page=servicemanager" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($page == 'persediaan') ? 'active' : ''; ?>">
      <a href="?page=persediaan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-files"></i>
        <div data-i18n="Data Master">Persediaan</div>
      </a>
    </li>
    </li>
    <li class="menu-item <?php echo ($page == 'penjualan') ? 'active' : ''; ?>">
      <a href="?page=penjualan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-package"></i>
        <div data-i18n="Penjualan">Penjualan</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($page == 'laporan') ? 'active' : ''; ?>">
      <a href="?page=laporan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-checklist"></i>
        <div data-i18n="Laporan Persetujuan">Laporan Persetujuan</div>
      </a>
    </li>
    <!-- tambahkan item menu lainnya di sini -->
  <?php } ?>
</ul>




</aside>
<!-- / Menu -->
