<?php
include '../backend/koneksi.php';
if (isset($_POST['username'], $_POST['nama_lengkap'], $_POST['password'], $_POST['email'])) {

    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $status = 'Aktif';

    // Menghindari SQL Injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $nama_lengkap);
    $email = mysqli_real_escape_string($koneksi, $email);
    $status = mysqli_real_escape_string($koneksi, $status);

    // Mengamankan password dengan hash dan salt
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memeriksa apakah username sudah digunakan
    $checkUsernameQuery = "SELECT id_user FROM `tb_user` WHERE `username` = '$username'";
    $checkUsernameResult = $koneksi->query($checkUsernameQuery);
    if ($checkUsernameResult->num_rows > 0) {
        echo "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        // Insert pengguna baru ke database
        $insertQuery = "INSERT INTO `tb_user`(`id_user`, `username`, `nama_lengkap`, `password`, `email`, `status`) VALUES (NULL,'$username','$nama_lengkap','$hashedPassword','$email','$status')";
        if ($koneksi->query($insertQuery) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Data berhasil Ditambahkan.";
        } else {
            $response['success'] = false;
            $response['message'] = "Terjadi kesalahan saat menambah data: " . $koneksi->error;
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Data tidak lengkap.";
}

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

$koneksi->close();
