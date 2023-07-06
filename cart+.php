<?php
session_start();

// Memeriksa jika keranjang belanja sudah ada di session, jika tidak maka inisialisasi dengan array kosong
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Memeriksa jika ada product_id yang dikirimkan melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product'])) {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $jumlah = $_POST['jumlah'];
    $price = $_POST['price'];

    // Menambahkan data produk ke dalam keranjang belanja
    $product = array(
        'product_id' => $product_id,
        'size' => $size,
        'color' => $color,
        'jumlah' => $jumlah,
        'price' => $price
    );
    $_SESSION['cart'][] = $product;
}

// Redirect kembali ke halaman sebelumnya
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
