<?php
include '../backend/koneksi.php';
include 'indo_format.php';

$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];

require_once "./mpdf_v8.0.3-master/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");

ob_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penjualan - <?= $tgl_awal; ?> s/d <?= $tgl_akhir; ?></title>
</head>
<style>
    body {
        font-family: sans-serif;

    }

    .text-center {
        text-align: center;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: black;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 2px;
    }
</style>

<body>
    <h2 class="text-center">LAPORAN PENJUALAN</h2>
    <h3 class="text-center">MAAHAD KOPI</h3>
    <p><strong>Dari Tanggal : <?= format_hari_tanggal($tgl_awal) ?> - <?= format_hari_tanggal($tgl_akhir) ?></strong></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">No Order</th>
                <th scope="col">Tanggal Order</th>
                <th scope="col">Nama Menu</th>
                <th scope="col">Harga Menu</th>
                <th scope="col">Jumlah Order</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php


            $query_total = "SELECT SUM(jumlah_order) AS total_terjual, SUM(total_order) AS total_harga FROM tb_order WHERE tanggal_order BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            $result_total = mysqli_query($koneksi, $query_total);
            $row_total = mysqli_fetch_assoc($result_total);
            $total_terjual = $row_total['total_terjual'];
            $total_harga = $row_total['total_harga'];


            $query = "SELECT tb_order_detail.*, tb_menu.*, tb_order.tanggal_order, tb_order.no_order FROM tb_order_detail INNER JOIN tb_menu ON tb_menu.id_menu = tb_order_detail.id_menu INNER JOIN tb_order ON tb_order_detail.id_order = tb_order.id_order WHERE tb_order.tanggal_order BETWEEN '$tgl_awal' AND '$tgl_akhir' 
            AND tb_order_detail.status_order_detail = 1";
            $result = mysqli_query($koneksi, $query);
            $no = 1;
            $total_price = 0;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $row['no_order']; ?></td>
                    <td><?= format_hari_tanggal($row['tanggal_order']) ?></td>
                    <td><?= $row['nama_menu']; ?></td>
                    <td>Rp. <?= number_format($row['harga']) ?></td>
                    <td><?= $row['jumlah_order_detail']; ?></td>
                    <td>Rp. <?= number_format($row['total_order_detail']); ?></td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="3"><strong>Total Menu Terjual: <?= $total_terjual; ?></strong></td>
                <td colspan="4"><strong>Total Income : Rp. <?= number_format($total_harga) ?></strong></td>
            </tr>

    </table>
</body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($html);
$mpdf->Output("Laporan Penjualan - $tgl_awal s/d $tgl_akhir.pdf", \Mpdf\Output\Destination::INLINE);
$koneksi->close();

?>