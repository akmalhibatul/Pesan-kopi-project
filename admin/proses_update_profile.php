<?php
session_start();
include '../backend/koneksi.php';

if (isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Pastikan bahwa pengguna yang melakukan update adalah pengguna yang sedang login
    if ($_SESSION['id_user'] == $id_user) {
        $update_query = "UPDATE tb_user SET nama_lengkap = '$nama_lengkap', email = '$email' WHERE id_user = $id_user";

        if (mysqli_query($koneksi, $update_query)) {
            // Update berhasil
            $_SESSION['success_message'] = "Profil berhasil diperbarui.";
            header("Location: profile.php"); // Ganti dengan halaman profil yang sesuai
            exit();
        } else {
            // Terjadi kesalahan dalam query
            $_SESSION['error_message'] = "Terjadi kesalahan dalam memperbarui profil.";
            header("Location: profile.php"); // Ganti dengan halaman profil yang sesuai
            exit();
        }
    } else {
        // ID User tidak cocok, tidak diizinkan mengubah profil
        $_SESSION['error_message'] = "Anda tidak diizinkan mengubah profil ini.";
        header("Location: profile.php"); // Ganti dengan halaman profil yang sesuai
        exit();
    }
} else {
    // Tidak ada data yang dikirimkan dari formulir
    $_SESSION['error_message'] = "Tidak ada data yang dikirimkan.";
    header("Location: profile.php"); // Ganti dengan halaman profil yang sesuai
    exit();
}

$koneksi->close();
