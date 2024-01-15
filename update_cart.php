<?php
session_start();
include 'backend/koneksi.php';

if (isset($_GET['action']) && isset($_GET['id_menu']) && is_numeric($_GET['id_menu'])) {
    $action = $_GET['action'];
    $id_menu = $_GET['id_menu'];

    // Perbarui kuantitas dalam session
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id_menu'] == $id_menu) {
            if ($action == 'increase') {
                $cart_item['qty']++;
            } elseif ($action == 'decrease') {
                $cart_item['qty'] = max(1, $cart_item['qty'] - 1);
            }
            break;
        }
    }
}

// Redirect kembali ke halaman keranjang belanja
header("Location: cart_view.php");
exit();
