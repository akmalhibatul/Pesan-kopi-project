<?php
include '../backend/koneksi.php';

if (isset($_POST['id_menu'], $_POST['id_kategori'], $_POST['nama_menu'], $_POST['deskripsi'], $_POST['harga'])) {

    $id_menu = $_POST['id_menu'];
    $id_kategori = $_POST['id_kategori'];
    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];


    // Menghindari SQL Injection
    $id_kategori = mysqli_real_escape_string($koneksi, $id_kategori);
    $nama_menu = mysqli_real_escape_string($koneksi, $nama_menu);
    $deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
    $harga = mysqli_real_escape_string($koneksi, $harga);

    // Periksa apakah ada gambar baru yang diunggah
    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];

        // Hapus gambar lama dari folder jika ada
        $sqlOldImage = "SELECT img_menu FROM tb_menu WHERE id_menu = $id_menu";
        $resultOldImage = $koneksi->query($sqlOldImage);
        if ($resultOldImage->num_rows > 0) {
            $rowOldImage = $resultOldImage->fetch_assoc();
            $oldImagePath = 'img/menu/' . $rowOldImage['img_menu'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Pindahkan gambar baru ke folder tujuan (images/)
        $targetDir = 'img/menu/';
        $targetPath = $targetDir . $imageName;
        move_uploaded_file($imageTmp, $targetPath);

        // Update informasi gambar di database
        $sql = "UPDATE `tb_menu` SET `id_kategori`='$id_kategori',`nama_menu`='$nama_menu',`deskripsi`='$deskripsi',`harga`='$harga',`img_menu`='$imageName' WHERE `id_menu`='$id_menu'";
    } else {
        // Hanya update informasi kategori
        $sql = "UPDATE `tb_menu` SET `id_kategori`='$id_kategori',`nama_menu`='$nama_menu',`deskripsi`='$deskripsi',`harga`='$harga' WHERE `id_menu`='$id_menu'";
    }

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
