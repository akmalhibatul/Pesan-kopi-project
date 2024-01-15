<?php
include '../backend/koneksi.php';

if (isset($_POST['id_kategori'], $_POST['nama_kategori'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    // Menghindari SQL Injection
    $nama_kategori = mysqli_real_escape_string($koneksi, $nama_kategori);

    // Hanya update informasi kategori
    $sql = "UPDATE tb_kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = $id_kategori";

    if ($koneksi->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Data berhasil diupdate.";
    } else {
        $response['success'] = false;
        $response['message'] = "Terjadi kesalahan saat mengupdate data: " . $koneksi->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Data tidak lengkap.";
}

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

$koneksi->close();
