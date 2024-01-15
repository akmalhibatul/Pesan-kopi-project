<?php
session_start();
include 'backend/koneksi.php';

$response = array();

if (isset($_POST['id_menu']) && is_numeric($_POST['id_menu']) && isset($_POST['qty'])) {
    $id_menu = $_POST['id_menu'];
    $qty = $_POST['qty']; // Ambil jumlah qty dari AJAX

    // Simpan item ke keranjang (dalam session)
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Cek apakah item sudah ada dalam keranjang
    $item_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id_menu'] == $id_menu) {
            $item['qty'] += $qty; // Tambahkan jumlah qty yang dikirimkan melalui AJAX
            $item_exists = true;
            break;
        }
    }

    // Jika item belum ada dalam keranjang, tambahkan item baru
    if (!$item_exists) {
        $_SESSION['cart'][] = array('id_menu' => $id_menu, 'qty' => $qty);
    }

    // Persiapan response untuk dikirimkan kembali ke JavaScript
    $response['success'] = true;
    $response['cart_count'] = count($_SESSION['cart']);
    // Perbarui nilai lain yang diperlukan dalam $response sesuai kebutuhan

} else {
    // Jika id_menu tidak valid, atur response sebagai error
    $response['success'] = false;
}

// Mengirim response sebagai JSON
header('Content-Type: application/json');
echo json_encode($response);
