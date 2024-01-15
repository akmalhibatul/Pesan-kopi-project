<?php
include '../backend/koneksi.php';
// Proses unggahan gambar
if (isset($_POST['nama_menu']) && isset($_FILES['image'])) {

    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];


    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    // Pindahkan gambar ke folder tujuan (misalnya: images/)
    $targetDir = 'img/menu/';
    $targetPath = $targetDir . $imageName;
    move_uploaded_file($imageTmp, $targetPath);

    // Masukkan informasi gambar ke database
    $sql = "INSERT INTO `tb_menu`(`id_menu`, `id_kategori`, `nama_menu`, `deskripsi`, `harga`, `img_menu`) VALUES (NULL,'$kategori','$nama_menu','$deskripsi','$harga','$imageName')";
    if ($koneksi->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Gambar berhasil diunggah dan informasi tersimpan di database.";
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
