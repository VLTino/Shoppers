<?php
namespace Midtrans;

require_once dirname(__FILE__) . '/midtransphp/midtrans-php-master/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-a-N7sylbogmzvwFJ7PbqCe2x';
Config::$clientKey = 'SB-Mid-client-cpj2em5xbS_DUWq1';

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


$id = $_GET["id"];
$orders = query("SELECT * FROM `orders` WHERE `id` = $id");
$cart_order = query("SELECT * FROM `cart_orders` WHERE `orders_id` = $id");
$contact = query("SELECT * FROM `contact` WHERE `id`=1");
$imgh = query("SELECT * FROM `imgheader` WHERE `id`=1");

if (isset($_POST["konfirmasi"])) {
  if (konfirmasi($_POST)) {
    header("Location: transaksi.php?status=sampai");
  } else {
      echo "<script>
      alert('data gagal diedit');
      document.location.href = 'color.php';
      </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
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
                <a href="index.php" class="js-logo-clone">Shoppers</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
                    echo "<li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                        <span class='icon icon-person'></span>
                    </a>
                    <ul class='dropdown-menu'>
                        <li class='dropdown-item'><a href='profile.php'> Edit Profile</a></li>
                        <li class='dropdown-item'><a href='transaksi.php'> Transaksi</a></li>
                        <li class='dropdown-item'><a href='riwayat.php'> Riwayat Transaksi</a></li>
                        <li class='dropdown-item'><a href='logoutuser.php'> Logout</a></li>
                        <!-- Tambahkan item dropdown lainnya sesuai kebutuhan -->
                    </ul>
                </li>";
                  } else {
                    echo "<li><a href='login-form-06'><span class='icon icon-person'></span></a></li>";
                  } ?>
                  <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                  <li>
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">2</span>
                    </a>
                  </li>
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
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a
              href="cart.php">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <?php foreach ($orders as $ord): ?>
              <h2 class="h3 mb-3 text-black">
                <?php $formattedId = "INV" . str_pad($ord["id"], 5, "0", STR_PAD_LEFT);

                echo $formattedId ?>
              </h2>
              <div class="p-3 p-lg-5 border">
                <h5 class="text-black">Nama</h5>
                <p class="text-black">
                  <?= $ord["firstname"] . " " . $ord["lastname"]; ?>
                </p>
                <h5 class="text-black">Alamat</h5>
                <p class="text-black" style="word-break:break-word">
                  <?= $ord["alamat"] ?>
                </p>
                <h5 class="text-black">Kecamatan</h5>
                <p class="text-black">
                  <?= $ord["kecamatan"] ?>
                </p>
                <h5 class="text-black">Kabupaten/Kota</h5>
                <p class="text-black">
                  <?= $ord["kabupaten"] ?>
                </p>
                <h5 class="text-black">Provinsi</h5>
                <p class="text-black">
                  <?= $ord["provinsi"] ?>
                </p>
                <div class="row">
                  <div class="col-md-6">
                    <h5 class="text-black">Email</h5>
                    <p class="text-black">
                      <?= $ord["email"] ?>
                    </p>
                  </div>
                  <div class="col-md-6">
                    <h5 class="text-black">Phone</h5>
                    <p class="text-black">
                      <?= $ord["phone"] ?>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <h5 class="text-black">Kurir</h5>
                    <p class="text-black">
                      <?= $ord["kurir"] ?>
                    </p>
                  </div>
                  <div class="col-md-6">
                    <h5 class="text-black">Estimasi</h5>
                    <p class="text-black">
                      <?= $ord["estimasi"] . ' Hari' ?>
                    </p>
                  </div>
                </div>





                <div class="form-group">
                  <label for="c_order_notes" class="text-black">Order Notes</label>
                  <textarea name="order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                    disabled><?= $ord["order_notes"] ?></textarea>
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
                      


                      foreach ($cart_order as $cr):
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
                            <?php $subtotal = $price * $jumlah;
                            $sub = "Rp" . number_format($subtotal, 0, ',', '.');
                            echo $sub; ?>
                          </td>
                        </tr>
                        <?php $product_total += $price * $jumlah; // tambahkan harga produk ke total
                      endforeach; ?>

                      <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                        <td class="text-black">
                          <?php
                          $formattedPrice = "Rp" . number_format($product_total, 0, ',', '.');
                          echo $formattedPrice; ?>
                        </td>
                      </tr>
                      <?php foreach ($orders as $ord):
                        $ongkir = $ord["ongkir"];
                        $order_total = $ord["orders_total"]; ?>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Ongkir</strong></td>
                          <td class="text-black">
                            <?php
                            $formattedPrice = "Rp" . number_format($ongkir, 0, ',', '.');
                            echo $formattedPrice; ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                          <td class="text-black font-weight-bold"><strong>
                              <?php
                              $formattedPrice = "Rp" . number_format($order_total, 0, ',', '.');
                              echo $formattedPrice; ?>
                            </strong></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  
                  <?php
                  foreach ($orders as $ord):
                    if ($ord["status"] === 'unpaid'): ?>
                      <div class="form-group">
                        <button class="btn btn-primary btn-sm py-3 btn-block" id="pay-button">Pay</button>
                        <button class="btn btn-danger btn-sm py-3 btn-block"
                          onclick="window.location='transaksi.php'">Back</button>
                        <?php foreach ($orders as $ord) {
                          $snap_token = $ord["snaptoken"];
                        } ?>
                        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                          data-client-key="<?php echo Config::$clientKey; ?>"></script>
                        <script type="text/javascript">
                          document.getElementById('pay-button').onclick = function () {
                            // SnapToken acquired from previous step
                            snap.pay('<?php echo $snap_token ?>');
                          };
                        </script>
                      </div>
                    <?php elseif ($ord["status"] === 'paid'): ?>
                      <div class="form-group">
                        <button class="btn btn-danger btn-sm py-3 btn-block"
                          onclick="window.location='transaksi.php'">Back</button>
                      </div>
                      <?php elseif ($ord["status"] === 'dikirim'): ?>
                        <h5>No. Resi : <?= $ord["resi"]; ?></h5> <br>
                        <form action="" method="post">
                        <div class="form-group">
                          <input type="hidden" name="orderid" id="" value="<?= $id; ?>">
                        <button class="btn btn-success btn-sm py-3 btn-block"
                          type="submit" name="konfirmasi">Konfirmasi</button>
                          </form>
                        <button class="btn btn-danger btn-sm py-3 btn-block"
                          onclick="window.location='transaksi.php'">Back</button>
                      </div>
                      <?php elseif ($ord["status"] === 'sampai'): ?>
                        <div class="form-group">
                        <button class="btn btn-success btn-sm py-3 btn-block"
                          onclick="window.location='listorder.php?order_id=<?= $id; ?>'">Review</button>
                        <button class="btn btn-danger btn-sm py-3 btn-block"
                          onclick="window.location='transaksi.php'">Back</button>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <div class="form-group">
                  <button id="cetakButton" class="btn btn-secondary form-control">Print</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
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
                class="text-primary">Colorlib</a>
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

  <script>
// Fungsi untuk menangani aksi klik pada button cetak
document.getElementById("cetakButton").addEventListener("click", function() {
    // Panggil fungsi cetak halaman
    cetakHalaman();
});

// Fungsi untuk mencetak halaman
function cetakHalaman() {
    // Ambil konten div dengan class "site-section"
    var konten = document.querySelector(".site-section").outerHTML;

    // Buka jendela cetak baru
    var win = window.open('', '_blank');
    win.document.write('<html><head><title>Invoice</title></head><body>');
    win.document.write(konten);
    win.document.write('</body></html>');

    // Cetak halaman
    win.print();
}
</script>

</body>

</html>