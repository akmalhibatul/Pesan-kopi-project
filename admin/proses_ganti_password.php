<?php
session_start();
include '../backend/koneksi.php';

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
} else {
    header("Location: login.php");
    exit();
}

if (isset($_POST['new_password']) && isset($_POST['konfirmasi_password'])) {
    $new_password = $_POST['new_password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Validasi apakah password dan konfirmasi password cocok
    if ($new_password === $konfirmasi_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_query = "UPDATE `tb_user` SET `password` = '$hashed_password' WHERE `id_user` = $id_user";

        if (mysqli_query($koneksi, $update_query)) {
            $_SESSION['success_message'] = "Password berhasil diubah."; // Set pesan sukses ke dalam session
            header("Location: profile.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Terjadi kesalahan saat mengubah password."; // Set pesan error ke dalam session
            header("Location: profile.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Password dan konfirmasi password tidak cocok."; // Set pesan error ke dalam session
        header("Location: profile.php");
        exit();
    }
}

$koneksi->close();
