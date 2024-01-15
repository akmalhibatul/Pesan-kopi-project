<?php include('header.php') ?>
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="index.php" class="nav-link ">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>

    <li class="nav-header">DATA MASTER</li>
    <li class="nav-item">
      <a href="menu.php" class="nav-link">
        <i class="nav-icon fas fa-folder"></i>
        <p>
          Data
        </p>
      </a>
    </li>
    <li class="nav-header">KELOLA ORDER</li>
    <li class="nav-item">
      <a href="order.php" class="nav-link active">
        <i class="nav-icon fas fa-book"></i>
        <p>Order</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="laporan.php" class="nav-link ">
        <i class="nav-icon fas fa-file"></i>
        <p>Laporan</p>
      </a>
    </li>
    <li class="nav-header">MENU USERS</li>
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
          <h1>Kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kategori</li>
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
              <a href="tambah_kategori.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('../backend/koneksi.php');
                  $no = 1;
                  $data = mysqli_query($koneksi, "select * from tb_kategori");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $d['nama_kategori']; ?></td>
                      <td>
                        <a href="edit_kategori.php?id_kategori=<?= $d['id_kategori']; ?>" class="btn btn-warning mx-2"><i class="fas fa-edit"></i></a>
                        <button type='button' class='btn btn-danger mx-2' onclick="hapusKategori(<?= $d['id_kategori']; ?>)"><i class='fas fa-trash'></i></button>
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