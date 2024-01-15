<?php
include '../backend/koneksi.php';

if (isset($_GET['id_menu'])) {
    $id_menu = $_GET['id_menu'];

    // Hapus gambar dari folder jika ada
    $sqlImage = "SELECT img_menu FROM tb_menu WHERE id_menu = $id_menu";
    $resultImage = $koneksi->query($sqlImage);
    if ($resultImage->num_rows > 0) {
        $rowImage = $resultImage->fetch_assoc();
        $imagePath = 'img/menu/' . $rowImage['img_menu'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Hapus gambar dari database
    $sql = "DELETE FROM tb_menu WHERE id_menu = $id_menu";
    if ($koneksi->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = 'Data berhasil dihapus.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Terjadi kesalahan saat menghapus data.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Parameter id_menu tidak ditemukan.';
}

$koneksi->close();

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
