<?php
session_start();
include '../backend/koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menghindari SQL Injection
    $username = mysqli_real_escape_string($koneksi, $username);

    // Query untuk mengambil informasi pengguna berdasarkan username
    $userResult = mysqli_query($koneksi, "SELECT * FROM `tb_user` WHERE username = '$username'");

    $data = mysqli_fetch_assoc($userResult);

    if ($userResult->num_rows == 1) {
        if (password_verify($password, $data['password'])) {
            if ($data['status'] == 'Aktif') {
                $_SESSION['id_user'] = $data['id_user']; // Menyimpan id_user dalam sesi
                $_SESSION['username'] = $data['username']; // Menyimpan username dalam sesi
                header("Location: ../admin/index.php"); // Mengalihkan ke halaman yang sesuai
            } else {
                // Jika status tidak aktif, maka akan diarahkan ke halaman login dengan pesan error
                header("location:index.php?msg=2");
            }
        } else {
            // Jika password tidak cocok, maka akan diarahkan ke halaman login dengan pesan error
            header("location:index.php?msg=1");
        }
    } else {
        // Jika username tidak ditemukan, maka akan diarahkan ke halaman login dengan pesan error
        header("location:index.php?msg=1");
    }
}

$koneksi->close();
