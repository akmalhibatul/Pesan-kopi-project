<?php
// Koneksi ke database
include '../backend/koneksi.php';

// Ambil data dari POST
$id_order = $_POST['id_order'];
$id_user = $_POST['id_user'];
$bayar = $_POST['bayar'];
$kembali = $_POST['kembali'];

$tanggal_bayar = date('Y-m-d');
$status = 1;
// ... (ambil data lainnya dari POST)

// Lakukan operasi UPDATE ke tabel yang sesuai
$query = mysqli_query($koneksi, "UPDATE `tb_order` SET `bayar_order`='$bayar',`kembalian_order`='$kembali',`tanggal_bayar_order`='$tanggal_bayar',`status_order`='$status', `id_user`='$id_user' WHERE `id_order`='$id_order'");
mysqli_query($koneksi, "UPDATE `tb_order_detail` SET `status_order_detail`='$status' WHERE `id_order`='$id_order'");

if ($query) {
    $response = array('success' => true);
} else {
    $response = array('success' => false);
}

// Kembalikan response dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi ke database
mysqli_close($koneksi);
