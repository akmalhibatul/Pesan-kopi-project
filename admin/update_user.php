<?php
include('../backend/koneksi.php');

if (isset($_POST['id_user'], $_POST['username'], $_POST['nama_lengkap'], $_POST['password'], $_POST['email'], $_POST['status'])) {

    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Menghindari SQL Injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $nama_lengkap);
    $email = mysqli_real_escape_string($koneksi, $email);
    $status = mysqli_real_escape_string($koneksi, $status);

    // Query untuk memeriksa apakah username sudah digunakan
    // $checkUsernameResult = $koneksi->query($checkUsernameQuery);
    // if ($checkUsernameResult->num_rows > 0) {
    //     echo "Username sudah digunakan. Silakan pilih username lain.";
    // } else {
    // Update informasi pengguna
    if (!empty($password)) {
        // Mengamankan password dengan hash dan salt
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE `tb_user` SET `username`='$username',`nama_lengkap`='$nama_lengkap',`password`='$hashedPassword',`email`='$email',`status`='$status' WHERE `id_user`='$id_user'";
    } else if (!empty($password)) {
    } else {
        $updateQuery = "UPDATE `tb_user` SET `username`='$username',`nama_lengkap`='$nama_lengkap',`email`='$email',`status`='$status' WHERE `id_user`='$id_user'";
    }

    if ($koneksi->query($updateQuery) === TRUE) {
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
