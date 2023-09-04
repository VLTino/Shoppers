<?php
session_start();
require('admins/functions.php');

// Periksa apakah pengguna telah login
if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
  // Mendapatkan username dari session
  $email = $_SESSION["email"];
  $password = $_SESSION["password"];

  // Gunakan nilai email sesuai kebutuhan
  $user = query("SELECT * FROM `customer` WHERE `email`='$email'");

  
} 
$contact = query("SELECT * FROM `contact` WHERE `id`=1");
$imgh = query("SELECT * FROM `imgheader` WHERE `id`=1");
$storename = "SELECT * FROM `storename` WHERE `id`=1";
$resultstorename = $conn->query($storename);

if ($resultstorename->num_rows > 0) {
    $row = $resultstorename->fetch_assoc();
    $strname = $row["name"];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $strname; ?> &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.php" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&family=Black+Ops+One&family=Dancing+Script&family=Lobster&family=Open+Sans&family=PT+Serif&family=Pacifico&family=Phudu&family=Qwitcher+Grypen&family=Roboto&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">
  </head>
  <body>
  
  <div class="site-wrap">
  <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">
          <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="shop.php" method="get" class="site-block-top-search">

                <span class="icon icon-search2"></span>
                <input type="text" id="searchInput" name="search" class="form-control border-0" placeholder="Search">
                <button type="submit" style="display: none;"></button>

                <input type="hidden" name="filter" value="true">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone"><?= $strname; ?></a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true){
                    echo "<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                        <span class='icon icon-person'></span>
                    </a>
                    <ul class='dropdown-menu'>
                        <li class='dropdown-item'><a href='profile.php'> Edit Profile</a></li>
                        <li class='dropdown-item'><a href='transaksi.php'> Transaksi</a></li>
                        
                        <li class='dropdown-item'><a href='logoutuser.php'> Logout</a></li>
                        <!-- Tambahkan item dropdown lainnya sesuai kebutuhan -->
                    </ul>
                </li>";
                  }else {
                    echo "<li><a href='login-form-06'><span class='icon icon-person'></span></a></li>";
                  } ?>
                  <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                  <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true):
                    $email = $_SESSION["email"];
                    $user = query("SELECT * FROM `customer` WHERE `email`='$email'");
                    foreach ($user as $us) {
                      $usid = $us['id'];
  
                      $countcart = query("SELECT COUNT(*) as total FROM cart WHERE `id_customer` = '$usid'");
                  }

                  foreach ($countcart as $count):
                    $totalData = $count["total"];

?>
                  <li>
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count"><?= $totalData ?></span>
                    </a>
                  </li>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <li>
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">x</span>
                    </a>
                  </li>
                  <?php endif; ?>
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span
                        class="icon-menu"></span></a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="catalog.php">Catalogue</a></li>
            <li><a href="newarrival.php">New Arrivals</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
            <?php // Tampilkan produk dalam keranjang belanja
        if (isset($_SESSION["login"]) && $_SESSION["login"] === true) : ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="color">Color</th>
                    <th class="size">Size</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
          
                <?php
                $product_total = 0; // variabel untuk menghitung total harga produk

                foreach ($user as $us) :
                    $user = $us['id'];

                    $cart = query("SELECT * FROM `cart` WHERE `id_customer`=$user");
                    

                    if (empty($cart)) {
                      echo '<tr><td colspan="8" style="text-align:center;color:red;">Tidak Ada Produk Dikeranjang.</td></tr>';
                  } 

                    foreach ($cart as $cr) :
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
                    
                        <td class="product-thumbnail">
                          <img src="images/<?=$gambar?>" alt="Image" class="img-fluid">
                        </td>
                        <td class="product-name">
                          <h2 class="h5 text-black"><?=$name?></h2>
                        </td>
                        <td><?=$price?></td>
                        <td>
                          <?= $color; ?>
                        </td>
                        <td>
                          <?= $size; ?>
                        </td>
                        <td>
                          <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" value="<?= $jumlah;?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                              <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                          </div>

                        </td>
                        <td><?= $price*$jumlah; ?></td>
                        <td><a href="admins/deletecart.php?id_cart=<?= $cart_id?>"   class="btn btn-primary btn-sm">X</a></td>
                        <?php endforeach; ?>
                      </tr>
    <?php endforeach; ?>
    <?php else: ?>
                      <h3 style="color:red;text-align:center;">Anda Belum Login.</h3>
                <?php endif; ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
                <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
              </div>
              <div class="col-md-6">
                <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location='shop.php'">Continue Shopping</button>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm">Apply Coupon</button>
              </div>
            </div> -->
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true) : ?>
                    <?php
                     foreach ($cart as $cr) :
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
                    <strong class="text-black"><?php $subtotal=$price*$jumlah; $sub = "Rp " . number_format($subtotal, 0, ',', '.');
                          echo $sub;
                          $product_total += $price*$jumlah;
                          ?></strong><br>
                  <?php endforeach ?>
                  <?php else: ?>
                    <strong class="text-black">Rp0</strong><br>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                  <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true) : ?>
                    <strong class="text-black"><?php
                          $formattedPrice = "Rp " . number_format($product_total, 0, ',', '.');
                          echo $formattedPrice; ?></strong>
                   <?php else: ?>   
                    <strong class="text-black">Rp0</strong>    
                    <?php endif; ?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                  <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true) : ?>
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                    <?php else: ?>
                      <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='login-form-06'">Proceed To Checkout</button>
                      <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Sell online</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Shopping cart</a></li>
                  <li><a href="#">Store builder</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Mobile commerce</a></li>
                  <li><a href="#">Dropshipping</a></li>
                  <li><a href="#">Website development</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Point of sale</a></li>
                  <li><a href="#">Hardware</a></li>
                  <li><a href="#">Software</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <h3 class="footer-heading mb-4">Promo</h3>
            <a href="#" class="block-6">
            <?php foreach ($imgh as $imgh):
                                $gambar = $imgh["gambar"];
                            ?>
              <img src="images/<?= $gambar; ?>" alt="Image placeholder" class="img-fluid rounded mb-4">
              <?php endforeach; ?>
              <h3 class="font-weight-light  mb-0">Finding Your Perfect Shoes</h3>
              <p>Promo from nuary 15 &mdash; 25, 2019</p>
            </a>
          </div>
          <?php foreach ($contact as $ctc):
                                $alamat = $ctc["alamat"];
                                $phone = $ctc["phone"];
                                $email = $ctc["email"];
                            ?>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address"><?= $alamat; ?></li>
                <li class="phone"><a href="tel://23923929210"><?= $phone; ?></a></li>
                <li class="email"><?= $email; ?></li>
              </ul>
            </div>
            <?php endforeach; ?>

            <div class="block-7">
              <form action="#" method="post">
                <label for="email_subscribe" class="footer-heading">Subscribe</label>
                <div class="form-group">
                  <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
                  <input type="submit" class="btn btn-sm btn-primary" value="Send">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;
              <script data-cfasync="false"
                src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
              <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made
              with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank"
                class="text-primaryc">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>

        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>
