<?php
session_start();
include 'backend/koneksi.php';

$nama_pelanggan = $_POST['nama_pelanggan'];
$jumlah_order = $_POST['jumlah_order'];
$total_price = $_POST['total_price'];
$tipe_pesanan = $_POST['tipe_pesanan'];

$status_order = "2";
$order_date = date("Y-m-d");
$no_order = date("YmdHis");

$nama_pelanggan2 = $_POST['nama_pelanggan2'];
$notelp_pelanggan = $_POST['notelp_pelanggan'];

// Set session variables
$_SESSION['nama_pelanggan2'] = $nama_pelanggan2;
$_SESSION['notelp_pelanggan'] = $notelp_pelanggan;

if ($tipe_pesanan == 1) {
    $query3 = mysqli_query($koneksi, "INSERT INTO `tb_order`(`id_order`, `no_order`, `nama_pelanggan`, `notelp_pelanggan`, `tanggal_order`, `jumlah_order`, `total_order`, `bayar_order`, `kembalian_order`, `tanggal_bayar_order`, `status_order`, `tipe_pesanan`, `id_user`) VALUES 
    (NULL,'$no_order','$nama_pelanggan','0','$order_date','$jumlah_order','$total_price','0','0','','$status_order','Dine In', NULL)");
} else if ($tipe_pesanan == 2) {
    echo '<script>window.location.href = "halaman_pembayaran.php";</script>';
} else {
    echo "Error in query: " . mysqli_error($koneksi);
}

// echo $query3;
if ($query3) {
    $id_order = mysqli_insert_id($koneksi);

    foreach ($_SESSION['cart'] as $cart_item) {
        $id_menu = $cart_item['id_menu'];
        $qty = $cart_item['qty'];
        $query2 = mysqli_query($koneksi, "SELECT * FROM tb_menu WHERE id_menu = '$id_menu'");
        $row = mysqli_fetch_assoc($query2);
        $harga = $row['harga'];
        $item_price = $harga * $qty;
        $query = mysqli_query($koneksi, "INSERT INTO `tb_order_detail`(`id_order_detail`, `id_order`, `id_menu`, `harga_order_detail`, `jumlah_order_detail`, `total_order_detail`, `status_order_detail`) VALUES (NULL,'$id_order','$id_menu','$harga','$qty','$item_price','$status_order')");
    }

    if ($query) {
        // Bersihkan keranjang
        unset($_SESSION['cart']);

        // Redirect ke halaman konfirmasi
        header("Location: selesai.php?id_order=$id_order");
    } else {
        echo "Error in query: " . mysqli_error($koneksi);
    }
} else {
    echo "Error in query: " . mysqli_error($koneksi);
}
