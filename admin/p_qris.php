<?php
include '../backend/koneksi.php';

if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];
    $id_user = $_GET['id_user'];

    $tanggal_bayar = date('Y-m-d');
    $status = 1;

    $query2 = mysqli_query($koneksi, "SELECT * FROM tb_order WHERE id_order = '$id_order'");
    $row = mysqli_fetch_assoc($query2);
    $total = $row['total_order'];

    $query = mysqli_query($koneksi, "UPDATE tb_order SET bayar_order = '$total' , `tanggal_bayar_order`='$tanggal_bayar',`status_order`='$status', `id_user`='$id_user' WHERE id_order = '$id_order'");
    mysqli_query($koneksi, "UPDATE `tb_order_detail` SET `status_order_detail`='$status' WHERE `id_order`='$id_order'");


    if ($koneksi->query($query) === TRUE) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Parameter id_order tidak ditemukan.';
}
