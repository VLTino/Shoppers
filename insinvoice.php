<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;
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
  $product_id = $_POST['product_id'];
  $jumlahpr = $_POST['jumlah'];


require 'admins/functions.php';
$result = query("SELECT MAX(id) AS last_id FROM `orders`");
$lastId = $result[0]['last_id'];

// Mendapatkan nomor urut baru
$newId = $lastId + 1;

// Format nomor urut dengan panjang 5 digit dan awalan "INV "
$formattedId = "INV" . str_pad($newId, 5, "0", STR_PAD_LEFT);

require_once dirname(__FILE__) . '/midtransphp/midtrans-php-master/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-a-N7sylbogmzvwFJ7PbqCe2x';
Config::$clientKey = 'SB-Mid-client-cpj2em5xbS_DUWq1';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
    'order_id' => $formattedId,
    'gross_amount' => $order_total, // no decimal allowed for creditcard
);
// Optional
$item_details = array (
    array(
        'id' => 'a1',
        'price' => $order_total,
        'quantity' => 1,
        'name' => "Apple"
    ),
  );
// Optional
$customer_details = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
    
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
echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
}

echo $product_id;

?>


