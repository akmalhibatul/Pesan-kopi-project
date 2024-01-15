<?php
include '../backend/koneksi.php';

$response = array(); // Menyiapkan array untuk respons

if (isset($_POST['nama_kategori'])) {
    $nama_kategori = $_POST['nama_kategori'];

    // Menghindari SQL Injection
    $nama_kategori = mysqli_real_escape_string($koneksi, $nama_kategori);

    // Masukkan informasi kategori ke database
    $sql = "INSERT INTO `tb_kategori`(`id_kategori`, `nama_kategori`) VALUES (NULL,'$nama_kategori')";
    
    if ($koneksi->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Informasi kategori berhasil disimpan di database.";
    } else {
        $response['success'] = false;
        $response['message'] = "Terjadi kesalahan saat menyimpan data: " . $koneksi->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Data tidak lengkap.";
}

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

$koneksi->close();
