<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

$berat= $_POST["total_berat"];
$paket= $_POST["paket"];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$provinsi = $_POST['provinsi'];
$kota = $_POST['kota'];
$kecamatan = $_POST['kecamatan'];
$alamat = $_POST['alamat'];
$ekspedisi = $_POST['ekspedisi'];
$ongkir = $_POST['ongkir'];
$order_total = $_POST['order_total'];
$estimasi = $_POST['estimasi'];
$email = $_POST['email_address'];
$phone = $_POST['phone'];
$order_notes = $_POST['order_notes'];
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : array();
$jumlahpr = isset($_POST['jumlah']) ? $_POST['jumlah'] : array();
$color = isset($_POST['color']) ? $_POST['color'] : array();
$size = isset($_POST['size']) ? $_POST['size'] : array();
$userid = $_POST["user_id"];

$detail_pengiriman = "$ekspedisi $paket";
// ... (kode sebelumnya)

// Menggabungkan product_id, jumlahpr, color, dan size menjadi satu array
$combinedArray = array();
foreach ($product_id as $key => $id) {
    $combinedArray[] = array(
        'product_id' => $id,
        'quantity' => $jumlahpr[$key],
        'color' => $color[$key],
        'size' => $size[$key]
    );
}

// ... (kode selanjutnya)





date_default_timezone_set('Asia/Jakarta');
$created_at = date('Y-m-d H:i'); // Ganti dengan nilai yang sesuai

$due_date = date('Y-m-d H:i', strtotime($created_at . ' +1 day'));
$data['due_date'] = $due_date;


require 'admins/functions.php';
$result = query("SELECT MAX(id) AS last_id FROM `orders`");
$lastId = $result[0]['last_id'];

// Mendapatkan nomor urut baru
$newId = $lastId + 1;

// Format nomor urut dengan panjang 5 digit dan awalan "INV "
// $formattedId = "INV" . str_pad($newId, 5, "0", STR_PAD_LEFT);
$formattedId = $newId;

require_once dirname(__FILE__) . '/midtransphp/midtrans-php-master/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-a-N7sylbogmzvwFJ7PbqCe2x';
Config::$clientKey = 'SB-Mid-client-cpj2em5xbS_DUWq1';

// non-relevant function only used for demo/example purpose


// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
    'order_id' => $formattedId,
    'gross_amount' => $order_total, // no decimal allowed for creditcard
);


// Menambahkan item baru ke array item_details
$item_details = array(
    array(
    'id' => $formattedId,
    'price' => $order_total,
    'quantity' => 1,
    'name' => "Pembayaran Shopeers"
    ),
    );



// Optional
$customer_details = array(
    'first_name' => $fname,
    'last_name' => $lname,
    'email' =>  $email,
    'phone' =>  $phone,

);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}
// echo "snapToken = ".$snap_token."<br>";
// echo "time = ".$created_at."<br>";
// echo "time2 = ".$due_date."<br>";


global $conn;

$query1 = "INSERT INTO `orders` VALUES (NULL,$userid,'$alamat','$provinsi','$kota','$kecamatan','$fname','$lname','$email','$phone','$order_notes','$detail_pengiriman',$ongkir,'$estimasi','$snap_token',$order_total,'$created_at','$due_date','unpaid',NULL)";


mysqli_query($conn, $query1);



// Proses insert data ke dalam tabel cart_orders
foreach ($combinedArray as $product) {
    $product_id = $product['product_id'];
    $quantity = $product['quantity'];
    $color = $product['color'];
    $size = $product['size'];

    $query2 = "INSERT INTO `cart_orders` VALUES (NULL, '$product_id', '$quantity', '$color', '$size', $formattedId)";
    mysqli_query($conn, $query2);
}


$query3 = "DELETE FROM `cart` WHERE `id_customer`= $userid";

mysqli_query($conn, $query3);

header('Location: cart.php');
exit;










?>