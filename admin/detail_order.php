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
                    <h1>Detail Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Order</li>
                        <li class="breadcrumb-item active">Detail Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-coffee"></i> Kopishop.
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <?php
                        include '../backend/koneksi.php';
                        $id_order = $_GET['id_order'];
                        $query = mysqli_query($koneksi, "SELECT tb_order.*, tb_user.nama_lengkap FROM `tb_order` LEFT JOIN tb_user ON tb_user.id_user = tb_order.id_user WHERE tb_order.id_order = $id_order");
                        $data = mysqli_fetch_array($query);
                        ?>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <b>No Order #<?= $data['no_order']; ?></b><br>
                                <br>
                                <b>Tanggal Order:</b> <?= format_hari_tanggal($data['tanggal_order']); ?><br>
                                <b>Nama Pembeli :</b> <?= $data['nama_pelanggan']; ?>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Status Pembayaran : </b> <?php
                                                            if ($data['status_order'] == '1')
                                                                echo '<span class="badge bg-success">Selesai</span>';
                                                            else if ($data['status_order'] == '2')
                                                                echo '<span class="badge bg-warning">Pending</span>';
                                                            else
                                                                echo '<span class="badge bg-danger">Gagal</span>';
                                                            ?> <br>
                                <?php if ($data['id_user'] !== null) : ?>
                                    <b>Tanggal Bayar :</b> <?= format_hari_tanggal($data['tanggal_bayar_order']); ?> <br>
                                    <b>Kasir : </b> <?= $data['nama_lengkap']; ?>
                                <?php endif; ?>
                                <br><br>
                            </div>
                        </div>

                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../backend/koneksi.php';
                                        $id_order = $_GET['id_order'];
                                        $query = mysqli_query($koneksi, "SELECT * FROM `tb_order_detail` INNER JOIN tb_menu ON tb_menu.id_menu = tb_order_detail.id_menu INNER JOIN tb_order ON tb_order_detail.id_order = tb_order.id_order WHERE tb_order_detail.id_order = $id_order");
                                        $no = 1;
                                        $total_item = 0;
                                        $total_price = 0;
                                        while ($data = mysqli_fetch_array($query)) {
                                            $total_item += $data['jumlah_order_detail'];
                                            $total_price += $data['harga'] * $data['jumlah_order_detail']; // Menambahkan harga item ke total_price
                                            $status_order = $data['status_order'];
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $data['nama_menu']; ?></td>
                                                <td><?= $data['jumlah_order_detail']; ?></td>
                                                <td>Rp. <?= number_format($data['harga']) ?></td>
                                                <td>Rp. <?= number_format($data['total_order_detail']) ?></td>
                                                <td><?php
                                                    if ($data['status_order'] == '1')
                                                        echo '<span class="badge bg-success">Selesai</span>';
                                                    else if ($data['status_order'] == '2')
                                                        echo '<span class="badge bg-warning">Pending</span>';
                                                    else
                                                        echo '<span class="badge bg-danger">Gagal</span>';
                                                    ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Jumlah : </th>
                                            <td><?= $total_item; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>Rp. <?= number_format($total_price) ?></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <?php
                                if ($status_order == '2') {
                                    echo "
                                    <button type='button' class='btn btn-success mx-2' onclick='showForm($id_order)'><i class='fas fa-check'></i> Bayar</button>
                                    <button type='button' class='btn btn-primary mx-2' onclick='qrisSubmit($id_order, $id_user)'><i class='fas fa-qrcode'></i> QRIS</button>
                                    <a href='order.php' class='btn btn-danger mx-2' style='margin-right: 5px;'> <i class='fas fa-times'></i> Batal</a>
                                    ";
                                } else if ($status_order == '1') {
                                    echo "
                                    <a href='p_order.php?id_order=$id_order' target='blank' class='btn btn-primary mx-2' style='margin-right: 5px;'> <i class='fas fa-print'></i> Print</a>
                                    <a href='order.php' class='btn btn-danger mx-2' style='margin-right: 5px;'> <i class='fas fa-times'></i> Kembali</a>
                                    ";
                                } else {
                                    echo "tidak ada aksi";
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include('footer.php') ?>