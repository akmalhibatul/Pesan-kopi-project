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
            <a href="order.php" class="nav-link ">
                <i class="nav-icon fas fa-book"></i>
                <p>Order</p>
            </a>
        </li>
        <li class="nav-header">DATA PENJUALAN</li>
        <li class="nav-item">
            <a href="laporan.php" class="nav-link active">
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
                    <h1>Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
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
                            <h3 class="card-title">Laporan</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="" id="searchForm">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Dari Tanggal</label>
                                            <input type="date" name="tgl_awal" class="form-control" value="<?= isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sampai tanggal</label>
                                            <input type="date" name="tgl_akhir" class="form-control" value="<?= isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary mr-2">Tampilkan</button>
                                    <button type="button" class="btn btn-success" id="cetakPdf">Cetak PDF</button>
                                </div>
                            </form>

                            <script>
                                document.getElementById("cetakPdf").addEventListener("click", function() {
                                    // Get the form values
                                    var tglAwal = document.querySelector('input[name="tgl_awal"]').value;
                                    var tglAkhir = document.querySelector('input[name="tgl_akhir"]').value;

                                    // Create a new form element
                                    var pdfForm = document.createElement("form");
                                    pdfForm.action = "generate_pdf.php";
                                    pdfForm.method = "post";
                                    pdfForm.target = "_blank";

                                    // Create hidden inputs for tgl_awal and tgl_akhir
                                    var inputTglAwal = document.createElement("input");
                                    inputTglAwal.type = "hidden";
                                    inputTglAwal.name = "tgl_awal";
                                    inputTglAwal.value = tglAwal;

                                    var inputTglAkhir = document.createElement("input");
                                    inputTglAkhir.type = "hidden";
                                    inputTglAkhir.name = "tgl_akhir";
                                    inputTglAkhir.value = tglAkhir;

                                    // Append inputs to the new form and submit
                                    pdfForm.appendChild(inputTglAwal);
                                    pdfForm.appendChild(inputTglAkhir);
                                    document.body.appendChild(pdfForm);
                                    pdfForm.submit();
                                    document.body.removeChild(pdfForm);
                                });
                            </script>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Order</th>
                                        <th>Tanggal Order</th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../backend/koneksi.php'; // Mengganti 'koneksi.php' dengan file koneksi database Anda

                                    if (isset($_GET['tgl_awal'], $_GET['tgl_akhir'])) {
                                        $tgl_awal = $_GET['tgl_awal'];
                                        $tgl_akhir = $_GET['tgl_akhir'];

                                        // Menghindari SQL Injection
                                        $tgl_awal = mysqli_real_escape_string($koneksi, $tgl_awal);
                                        $tgl_akhir = mysqli_real_escape_string($koneksi, $tgl_akhir);

                                        // Query untuk mengambil data sesuai tanggal
                                        $query = "SELECT * 
                                    FROM tb_order 
                                    INNER JOIN tb_order_detail ON tb_order_detail.id_order = tb_order.id_order 
                                    INNER JOIN tb_menu ON tb_menu.id_menu = tb_order_detail.id_menu 
                                    WHERE tb_order.tanggal_order BETWEEN '$tgl_awal' AND '$tgl_akhir' 
                                    AND tb_order_detail.status_order_detail = 1 ORDER BY tb_order.tanggal_order DESC;
                                    ";
                                        $result = mysqli_query($koneksi, $query);

                                        // Tampilkan data hasil query
                                        $no = 1; // Inisialisasi nomor urut
                                        while ($d = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $no++ . "</td>";
                                            echo "<td>" . $d['no_order'] . "</td>";
                                            echo "<td>" . format_hari_tanggal($d['tanggal_order']) . "</td>";
                                            echo "<td>" . $d['nama_menu'] . "</td>";
                                            echo "<td>Rp. " . number_format($d['harga']) . "</td>";
                                            echo "<td>" . $d['jumlah_order_detail'] . "</td>";
                                            echo "<td>Rp. " . number_format($d['total_order_detail']) . "</td>";
                                            echo "</tr>";
                                        }

                                        mysqli_close($koneksi);
                                    }
                                    ?>

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