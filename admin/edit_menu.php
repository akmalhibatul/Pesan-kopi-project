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
          <h1>Edit Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="menu.php">Menu</a></li>
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
              <h3 class="card-title">Edit Menu</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php
            include('../backend/koneksi.php');
            $id_menu = $_GET['id_menu'];
            $data = mysqli_query($koneksi, "SELECT * FROM tb_menu WHERE id_menu='$id_menu'");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <form id="editMenuForm" enctype="multipart/form-data">
                <input type="text" name="id_menu" value="<?= $id_menu; ?>" hidden>
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" class="form-control" name="nama_menu" value="<?= $d['nama_menu']; ?>" placeholder="Masukan Nama Menu" required>
                  </div>
                  <div class="form-group">
                    <label>Deksipsi</label>
                    <input type="text" class="form-control" name="deskripsi" value="<?= $d['deskripsi']; ?>" placeholder="Masukan Deksipsi" required>
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <?php $kategori = $d['id_kategori']; ?>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" name="id_kategori">
                      <option selected disabled value="">Pilih Kategori</option>
                      <?php
                      $query_kategori = "SELECT * FROM tb_kategori";
                      $sql_kategori = mysqli_query($koneksi, $query_kategori);
                      while ($data_kategori = mysqli_fetch_array($sql_kategori)) {
                        if ($kategori == $data_kategori['id_kategori']) {
                          $select = "selected";
                        } else {
                          $select = "";
                        }

                        echo "<option value='$data_kategori[id_kategori]' $select>$data_kategori[nama_kategori]</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" value="<?= $d['harga']; ?>" placeholder="Masukan Harga" required>
                  </div>
                  <label>Foto Menu</label><br>
                  <img src="img/menu/<?= $d['img_menu']; ?>" class="img-fluid mx-2 mb-3" width="50" alt=""><br>
                  <input type="file" name="image"><br>
                  <span style="color: red;">*Tidak Perlu Diisi jika tidak ingin mengganti gambar</span>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-warning" id="submitEdit" name="submit">Submit</button>
                  <a href="menu.php" class="btn btn-danger">Kembali</a>
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