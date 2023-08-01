<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for sample HTTP notifications:
// https://docs.midtrans.com/en/after-payment/http-notification?id=sample-of-different-payment-channels

namespace Midtrans;

require('../../../admins/functions.php');
require_once dirname(__FILE__) . '/../Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-a-N7sylbogmzvwFJ7PbqCe2x';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

try {
    $notif = new Notification();
}
catch (\Exception $e) {
    exit($e->getMessage());
}

$notif = $notif->getResponse();
$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card') {
        if ($fraud == 'challenge') {
            mysqli_query($conn,"UPDATE `orders` SET `status` = 'challenged by FDS' WHERE `id`=$order_id");
        } else {
            mysqli_query($conn,"UPDATE `orders` SET `status` = 'paid' WHERE `id`=$order_id");
        }
    }
} else if ($transaction == 'settlement') {
    mysqli_query($conn,"UPDATE `orders` SET `status` = 'paid' WHERE `id`=$order_id");
} else if ($transaction == 'pending') {
    mysqli_query($conn,"UPDATE `orders` SET `status` = 'pending' WHERE `id`=$order_id");
} else if ($transaction == 'deny') {
    mysqli_query($conn,"UPDATE `orders` SET `status` = 'deny' WHERE `id`=$order_id");
} else if ($transaction == 'expire') {
    mysqli_query($conn,"UPDATE `orders` SET `status` = 'expired' WHERE `id`=$order_id");
} else if ($transaction == 'cancel') {
    mysqli_query($conn,"UPDATE `orders` SET `status` = 'canceled' WHERE `id`=$order_id");
}

function printExampleWarningMessage() {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo 'Notification-handler are not meant to be opened via browser / GET HTTP method. It is used to handle Midtrans HTTP POST notification / webhook.';
    }
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
