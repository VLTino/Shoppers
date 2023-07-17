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
  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : array();
  $jumlahpr = isset($_POST['jumlah']) ? $_POST['jumlah'] : array();
  $color = isset($_POST['color']) ? $_POST['color'] : array();
  $size = isset($_POST['size']) ? $_POST['size'] : array();
  $userid = $_POST["user_id"];
  $combinedArray = array_combine($product_id, $jumlahpr);
  
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
$formattedId = "INV" . str_pad($newId, 5, "0", STR_PAD_LEFT);

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
// Melakukan foreach pada array yang telah digabungkan
foreach ($combinedArray as $key => $value) {
    // Mendapatkan data produk berdasarkan product_id
    $product = query("SELECT * FROM `product` WHERE `id` = $key");

    // Memastikan ada data produk yang ditemukan
    if (!empty($product)) {
        $product_name = $product[0]['name'];

        // Menambahkan item baru ke array item_details
        $item_details[] = array(
            'id' => $key,
            'price' => $order_total,
            'quantity' => $value,   
            'name' => $product_name
        );
    }
};


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
echo "snapToken = ".$snap_token."<br>";
echo "time = ".$created_at."<br>";
echo "time2 = ".$due_date."<br>";


 global $conn;

 $query1 = "INSERT INTO `orders` VALUES ($formattedId,$userid,'$alamat','$provinsi','$kota','$kecamatan','$fname','$lname','$order_notes','$snap_token','$order_total',$created_at,$due_date)";

 mysqli_query($conn,$query1);

 

 foreach ($combinedArray as $key => $value) {
    
    global $conn;

    $query2 = "INSERT INTO `cart_orders` VALUES (NULL,$key,$value,$formattedId) ";

    mysqli_query($conn,$query2);
 }


 $query3 = "DELETE FROM `cart` WHERE `id_customer`= $userid";

 mysqli_query($conn,$query3);

    return mysqli_affected_rows($conn);






?>
