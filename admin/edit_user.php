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
      <a href="order.php" class="nav-link ">
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
      <a href="user.php" class="nav-link active">
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
          <h1>Edit User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="user.php">Users</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php
            include '../backend/koneksi.php';
            $id_user = $_GET['id_user'];
            $data = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$id_user'");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <form id="editUserForm" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" name="id_user" value="<?= $id_user; ?>" hidden>
                    <input type="text" name="username" value="<?= $d['username']; ?>" hidden>
                    <label>Username</label>
                    <input type="text" class="form-control" value="<?= $d['username']; ?>" placeholder="Masukan Username" required disabled>
                  </div>
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" value="<?= $d['nama_lengkap']; ?>" placeholder="Masukan Nama Lengkap" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                    <span style="color: red;">*Tidak Perlu Diisi jika tidak ingin mengganti Password</span>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $d['email']; ?>" class="form-control" placeholder="Masukan Email" required>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <?php $st = $d['status'] ?>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="status">
                      <option selected disabled value="">Pilih Status</option>
                      <option <?= ($st == 'Aktif') ? "selected" : "" ?> value="Aktif">Aktif</option>
                      <option <?= ($st == 'Tidak Aktif') ? "selected" : "" ?> value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-warning" id="submitEdit" name="submit">Submit</button>
                  <a href="user.php" class="btn btn-danger">Kembali</a>
                </div>
              </form>
            <?php } ?>
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