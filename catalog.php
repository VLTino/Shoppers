<?php
session_start(); 
require('admins/functions.php');

$category = query("SELECT * FROM `category` ORDER BY `id` DESC");

$contact = query("SELECT * FROM `contact` WHERE `id`=1");
$imgh = query("SELECT * FROM `imgheader` WHERE `id`=1");


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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                    <li>
                                        <a href="cart.php" class="site-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span class="count">2</span>
                                        </a>
                                    </li>
                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                            class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                                    </li>
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
                        <li class="active"><a href="catalog.php">Catalogue</a></li>
                        <li><a href="newarrival.php">New Arrivals</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong
                            class="text-black">Catalogue</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
            <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row">
          <?php foreach ($category as $ctg): ?>
            <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
              <a class="block-2-item" href="shop.php">
                <figure class="image">
                  <img src="images/<?= $ctg["gambar"]; ?>" alt="" class="img-fluid">
                </figure>
                <div class="text">
                  <span class="text-uppercase">
                    <?= $ctg["teks"]; ?>
                  </span>
                  <h3>
                    <?= $ctg["category"]; ?>
                  </h3>
                </div>
              </a>
            </div>
          <?php endforeach; ?>

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

</body>

</html>