<?php
// Koneksi ke database
include '../backend/koneksi.php';

$id_order = $_GET['id_order'];

// Query untuk mengambil data pesanan dari database
$query = "SELECT * FROM tb_order WHERE id_order = $id_order"; // Ganti dengan query dan tabel Anda

$result = mysqli_query($koneksi, $query);

if ($result) {
    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'Gagal mengambil data.'));
}
