<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }


        .bukti-pembayaran {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            /* Set width to 100% */
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container-fluid bukti-pembayaran">
        <div class="row">
            <h2 class="text-center mb-2" style="font-weight: bold; text-decoration: underline;">BUKTI PEMBAYARAN</h2>
            <table class="mt-4 mb-4">
                <?php
                include '../backend/koneksi.php';
                include('indo_format.php');

                $id_order = $_GET['id_order'];
                $query = mysqli_query($koneksi, "SELECT tb_order.*, tb_user.nama_lengkap FROM `tb_order` LEFT JOIN tb_user ON tb_user.id_user = tb_order.id_user WHERE tb_order.id_order = $id_order");
                $d = mysqli_fetch_array($query);
                ?>
                <tr>
                    <td style="float: left;">
                        <p><strong>Nama Pelanggan:</strong> <?= $d['nama_pelanggan']; ?></p>
                        <?php if ($d['id_user'] !== null) : ?>
                            <b>Kasir : </b> <?= $d['nama_lengkap']; ?>
                        <?php endif; ?>
                    </td>
                    <td style="float: right;">
                        <p><strong>No. Order:</strong> <?= $d['no_order']; ?></p>
                        <p><strong>Tanggal Order:</strong> <?= format_hari_tanggal($d['tanggal_order']); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <center>
                <h4 class="mb-3" style="font-weight: 600; text-decoration: underline;">DETAIL PESANAN</h4>
            </center>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
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
                        $total_semua = 0; // Definisikan variabel total_semua
                        $bayar = 0; // Definisikan variabel bayar
                        $kembalian = 0; // Definisikan variabel kembalian
                        while ($data = mysqli_fetch_array($query)) {
                            $total_item += $data['jumlah_order_detail'];
                            $total_price += $data['harga'] * $data['jumlah_order_detail'];
                            $total_semua += $data['total_order_detail'];
                            $bayar = $data['bayar_order'];
                            $kembalian = $data['kembalian_order'];
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_menu']; ?></td>
                                <td><?= $data['jumlah_order_detail']; ?></td>
                                <td>Rp. <?= number_format($data['harga']) ?></td>
                                <td>Rp. <?= number_format($data['total_order_detail']) ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4">
                            </td>
                            <td>
                                <p><strong>Total:</strong> Rp. <?= number_format($total_semua) ?></p>
                                <p><strong>Bayar:</strong> Rp. <?= number_format($bayar) ?></p>
                                <p><strong>Kembali:</strong> Rp. <?= number_format($kembalian) ?></p>
                            </td>
                        </tr>
                        <!-- Tambahkan baris data sesuai dengan pesanan -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <script>
        window.print();
    </script> -->
    <!-- Load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>