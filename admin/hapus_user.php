<?php
include '../backend/koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $sql = "DELETE FROM tb_user WHERE id_user = $id_user";
    if ($koneksi->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = 'Data berhasil dihapus.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Terjadi kesalahan saat menghapus data.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Parameter id_user tidak ditemukan.';
}

$koneksi->close();

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
