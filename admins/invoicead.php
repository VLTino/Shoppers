<?php


session_start();
require('functions.php');

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}


$id = $_GET["id"];
$orders = query("SELECT * FROM `orders` WHERE `id` = $id");
$cart_order = query("SELECT * FROM `cart_orders` WHERE `orders_id` = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="../fonts/icomoon/style.css">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/magnific-popup.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">


  <link rel="stylesheet" href="../css/aos.css">

  <link rel="stylesheet" href="../css/style.css">

</head>

<body>

  <div class="site-wrap">
  
    

    <div class="site-section">
      <div class="container">
       
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <?php foreach ($orders as $ord): ?>
            <h2 class="h3 mb-3 text-black"><?php $formattedId = "INV" . str_pad($ord["id"], 5, "0", STR_PAD_LEFT); 
            
            echo $formattedId?></h2>
            <div class="p-3 p-lg-5 border">
            <h5 class="text-black">Nama</h5>
            <p class="text-black"><?= $ord["firstname"]." ".$ord["lastname"];?></p>
            <h5 class="text-black">Alamat</h5>
            <p class="text-black" style="word-break:break-word"><?= $ord["alamat"] ?></p>
            <h5 class="text-black">Kecamatan</h5>
            <p class="text-black"><?= $ord["kecamatan"]?></p>
            <h5 class="text-black">Kabupaten/Kota</h5>
            <p class="text-black"><?= $ord["kabupaten"]?></p>
            <h5 class="text-black">Provinsi</h5>
            <p class="text-black"><?= $ord["provinsi"]?></p>
            <div class="row"><div class="col-md-6"><h5 class="text-black">Email</h5>
            <p class="text-black"><?= $ord["email"]?></p></div>
<div class="col-md-6"> <h5 class="text-black">Phone</h5>
            <p class="text-black"><?= $ord["phone"]?></p></div></div>
            <div class="row"><div class="col-md-6"><h5 class="text-black">Kurir</h5>
            <p class="text-black"><?= $ord["kurir"]?></p></div>
           <div class="col-md-6"><h5 class="text-black">Estimasi</h5>
            <p class="text-black"><?= $ord["estimasi"].' Hari' ?></p></div></div>
           
            
            
             

              <div class="form-group">
                <label for="c_order_notes" class="text-black">Order Notes</label>
                <textarea name="order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                  disabled><?= $ord["order_notes"]?></textarea>
              </div>
<?php endforeach; ?>
            </div>
          </div>
          <div class="col-md-6">

            

            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                    <?php
                $product_total = 0; // variabel untuk menghitung total harga produk

                    

                    foreach ($cart_order as $cr) :
                      $product_id = $cr["product_id"];
                      $cart_id = $cr["id"];
                      $color = $cr["color"];
                      $size = $cr["size"];
                      $jumlah = $cr["jumlah"];
                      

                      $prd = query("SELECT * FROM `product` WHERE `id` = $product_id");

                    
                    
                    
                    foreach ($prd as $pr) {
                      $price = $pr["price"];
                      $gambar = $pr["gambar"];
                      $name = $pr["name"];
                    }

                    ?>
                          <tr>
                            <td>
                              <?= $pr["name"]; ?> <strong class="mx-2">x</strong>
                              <?= $jumlah; ?>
                            </td>
                            <td>
                            <?php $subtotal=$price*$jumlah; $sub = "Rp" . number_format($subtotal, 0, ',', '.');
                          echo $sub;?>
                            </td>
                          </tr>
                          <?php $product_total += $price * $jumlah; // tambahkan harga produk ke total
                          endforeach; ?>
                      
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                        <td class="text-black"><?php
                          $formattedPrice = "Rp" . number_format($product_total, 0, ',', '.');
                          echo $formattedPrice; ?></td>
                      </tr>
                      <?php foreach ($orders as $ord): 
                        $ongkir = $ord["ongkir"];
                        $order_total = $ord["orders_total"];?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Ongkir</strong></td>
                        <td class="text-black"><?php
                          $formattedPrice = "Rp" . number_format($ongkir, 0, ',', '.');
                          echo $formattedPrice; ?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong><?php
                          $formattedPrice = "Rp" . number_format($order_total, 0, ',', '.');
                          echo $formattedPrice; ?></strong></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>

                  
      
                  <div class="form-group">
                    <?php
                    foreach ($orders as $ord):
                    if ($ord["status"] === 'paid'): ?>
                      <button class="btn btn-primary btn-sm py-3 btn-block" onclick="window.location='resi.php?id=<?= $ord['id'] ;?>'">Proses</button>
                      <?php endif; ?>
                      <?php endforeach; ?>
                      <button class="btn btn-danger btn-sm py-3 btn-block" onclick="window.location='unpaid.php'">back</button>
                      
               
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>

   
  </div>

  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/aos.js"></script>

  <script src="../js/main.js"></script>

 

</body>

</html>