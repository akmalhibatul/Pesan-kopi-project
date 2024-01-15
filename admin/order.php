<?php include('header.php') ?>
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="index.php" class="nav-link ">
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
            <a href="order.php" class="nav-link active">
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
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <div class="card-header">
              <button class="btn btn-secondary" id="refreshButton"><i class="fas fa-sync"></i> Refresh</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Order</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../backend/koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM `tb_order` ORDER BY id_order DESC");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $d['no_order']; ?></td>
                      <td><?= format_hari_tanggal($d['tanggal_order']); ?></td>
                      <td><?= $d['nama_pelanggan']; ?></td>
                      <td><?= $d['jumlah_order']; ?></td>
                      <td>Rp. <?= number_format($d['total_order']) ?></td>
                      <td><?php
                          if ($d['status_order'] == '1')
                            echo '<span class="badge bg-success">Selesai</span>';
                          else if ($d['status_order'] == '2')
                            echo '<span class="badge bg-warning">Pending</span>';
                          else
                            echo '<span class="badge bg-danger">Gagal</span>';
                          ?>
                      </td>
                      <td>
                        <a href="detail_order.php?id_order=<?= $d['id_order']; ?>" class="btn btn-primary mx-2"><i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php include('footer.php') ?>