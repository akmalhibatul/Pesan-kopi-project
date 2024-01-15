  <?php include('header.php') ?>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="index.php" class="nav-link active">
          <i class="nav-icon fas fa-home"></i>
          <p> Dashboard </p>
            </a>
        </li>
        <li class="nav-header">DATA MENU</li>
        <li class="nav-item">
            <a href="menu.php" class="nav-link">
                <i class="nav-icon fas fa-utensils"></i>
                <p>Menu</p>
            </a>
        </li>
        <li class="nav-header">DATA PESANAN</li>
        <li class="nav-item">
            <a href="order.php" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Order</p>
            </a>
        </li>
        <li class="nav-header">DATA PENJUALAN</li>
        <li class="nav-item">
            <a href="laporan.php" class="nav-link ">
                <i class="nav-icon fas fa-file"></i>
                <p>Laporan</p>
            </a>
        </li>
        <li class="nav-header">DATA PENGGUNA</li>
        <li class="nav-item">
            <a href="user.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
            </a>
        </li>
    </ul>
</nav>
  <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    include '../backend/koneksi.php';

    $JmlMenuResult = mysqli_query($koneksi, "SELECT COUNT(*) AS total_menu FROM tb_menu");
    $incomeHariIniResult = mysqli_query($koneksi, "SELECT SUM(total_order) AS total_income FROM tb_order WHERE status_order = '1' AND DATE(tanggal_order) = CURDATE()");
    $incomeBulanIniResult = mysqli_query($koneksi, "SELECT SUM(total_order) AS total_income FROM tb_order WHERE status_order = '1' AND MONTH(tanggal_order) = MONTH(CURDATE())");
    $incomeKeseluruhanResult = mysqli_query($koneksi, "SELECT SUM(total_order) AS total_income FROM tb_order WHERE status_order = '1'");

    // Fetching data
    $JmlMenuData = mysqli_fetch_assoc($JmlMenuResult);
    $incomeHariIniData = mysqli_fetch_assoc($incomeHariIniResult);
    $incomeBulanIniData = mysqli_fetch_assoc($incomeBulanIniResult);
    $incomeKeseluruhanData = mysqli_fetch_assoc($incomeKeseluruhanResult);

    $totalMenu = $JmlMenuData['total_menu'];
    $totalIncomeHariIni = $incomeHariIniData['total_income'];
    $totalIncomeBulanIni = $incomeBulanIniData['total_income'];
    $totalIncomeKeseluruhan = $incomeKeseluruhanData['total_income'];

    // Close result objects
    mysqli_free_result($JmlMenuResult);
    mysqli_free_result($incomeHariIniResult);
    mysqli_free_result($incomeBulanIniResult);
    mysqli_free_result($incomeKeseluruhanResult);

    // ... Rest of your code ...
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Menu</span>
                <span class="info-box-number"><?= $totalMenu; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Order Hari Ini</span>
                <span class="info-box-number">Rp. <?= number_format($totalIncomeHariIni) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Income Bulan Ini</span>
                <span class="info-box-number">Rp. <?= number_format($totalIncomeBulanIni) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Income</span>
                <span class="info-box-number">Rp. <?= number_format($totalIncomeKeseluruhan) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('footer.php') ?>