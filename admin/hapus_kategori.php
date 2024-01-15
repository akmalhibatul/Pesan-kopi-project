<?php
include '../backend/koneksi.php';

if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];
    $sql = "DELETE FROM tb_kategori WHERE id_kategori = $id_kategori";
    if ($koneksi->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = 'Data berhasil dihapus.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Terjadi kesalahan saat menghapus data.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Parameter id_kategori tidak ditemukan.';
}

$koneksi->close();

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
