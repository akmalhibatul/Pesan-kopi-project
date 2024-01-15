<?php
session_start();

if (isset($_GET['id_menu']) && is_numeric($_GET['id_menu'])) {
    $id_menu = $_GET['id_menu'];

    // Cari index item dalam keranjang
    $index = array_search($id_menu, array_column($_SESSION['cart'], 'id_menu'));

    // Jika ditemukan, hapus item dari keranjang
    if ($index !== false) {
        array_splice($_SESSION['cart'], $index, 1);
    }
}

// Redirect kembali ke halaman keranjang
header("Location: cart_view.php");
exit();
