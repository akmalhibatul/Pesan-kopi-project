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
            <a href="kategori.php" class="nav-link">
                <i class="nav-icon fas fa-ellipsis-h"></i>
                <p>
                    Kategori
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="menu.php" class="nav-link">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                    Menu
                </p>
            </a>
        </li>
        <li class="nav-header">MENU TRANSAKSI</li>
        <li class="nav-item">
            <a href="laporan.php" class="nav-link active">
                <i class="nav-icon fas fa-tv"></i>
                <p>Monitoring</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="order.php" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Order</p>
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
                    <h1>Monitoring</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Monitoring</li>
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
                            <h3 class="card-title">Monitor Order Per Menu</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Order</th>
                                        <th>Nama Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../backend/koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT tb_order_detail.*, tb_menu.*, tb_order.tanggal_order, tb_order.no_order FROM tb_order_detail INNER JOIN tb_menu ON tb_menu.id_menu = tb_order_detail.id_menu INNER JOIN tb_order ON tb_order_detail.id_order = tb_order.id_order WHERE tb_order.tanggal_order = CURDATE() ORDER BY tb_order.status_order desc ");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $d['no_order']; ?></td>
                                            <td><?= $d['nama_menu']; ?></td>
                                            <td><?= $d['jumlah_order_detail']; ?></td>
                                            <td>Rp. <?= number_format($d['harga']) ?></td>
                                            <td>Rp. <?= number_format($d['total_order_detail']) ?></td>
                                            <td><?php
                                                if ($d['status_order_detail'] == '1')
                                                    echo '<span class="badge bg-success">Selesai</span>';
                                                else if ($d['status_order_detail'] == '2')
                                                    echo '<span class="badge bg-warning">Pending</span>';
                                                else
                                                    echo '<span class="badge bg-danger">Gagal</span>';
                                                ?></td>
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