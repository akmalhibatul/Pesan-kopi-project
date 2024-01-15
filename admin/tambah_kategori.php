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
            <a href="menu.php" class="nav-link active">
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
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="menu.php">Data Master</a></li>
            <li class="breadcrumb-item active">Tambah</li>
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
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tambah Kategori</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="kategoriForm" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Kategori</label>
                  <input type="text" class="form-control" name="nama_kategori" placeholder="Masukan Nama Kategori" required>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="menu.php" class="btn btn-danger">Kembali</a>
              </div>
            </form>

          </div>
          <!-- /.card -->
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