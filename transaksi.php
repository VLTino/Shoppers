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


} else {
    // Pengguna belum login, lakukan tindakan yang sesuai
    echo "Anda belum login.";
}

if (isset($_GET["status"])) {
    $status = $_GET["status"];
}

foreach ($user as $us) {
    if (isset($status)) {
        $usid = $us["id"];
        $transaksi = query("SELECT * FROM `orders` WHERE `id_user`= $usid AND `status` = '$status' ORDER BY `id` DESC");
    } else {
        $usid = $us["id"];
        $transaksi = query("SELECT * FROM `orders` WHERE `id_user`= $usid ORDER BY `id` DESC");
    }
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                                    <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
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
                                    } else {
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
                        <li> <a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li class="active"><a href="shop.php">Shop</a></li>
                        <li><a href="#">Catalogue</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong
                            class="text-black">Shop</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">

                <div class="row mb-5">


                    <div class="col-md-3 order-1 mb-5 mb-md-0">
                        <div class="border p-4 rounded mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Profile</h3>
                            <ul class="list-unstyled mb-0 site-menu js-clone-nav d-none d-md-block">

                                <li class="active mb-1"><a href="profile.php">Edit Profile</a></li>
                                <li class="active mb-1"><a href="transaksi.php" style="color:black;">Transaksi</a></li>
                                
                                <!-- <li class="active mb-1"><a href="Gantisandi.php">Ganti Sandi</a></li> -->

                            </ul>
                        </div>

                    </div>
                    <!-- ... (kode sebelumnya) -->





                    <div class="col-md-9 order-1 mb-5 mb-md-0">
                        <button onclick="window.location='transaksi.php'" class="btn btn-primary"><span
                                class="fab fa-dropbox"></span>Semua</button>
                        <button onclick="window.location='transaksi.php?status=unpaid'" class="btn btn-primary"><span
                                class="fab fa-creative-commons-nc"></span> Belum Bayar</button>
                        <button onclick="window.location='transaksi.php?status=paid'" class="btn btn-primary"><span
                                class="far fa-check-circle"></span>Dibayar</button>
                        <button onclick="window.location='transaksi.php?status=dikirim'" class="btn btn-primary"><span
                                class="fas fa-truck"></span>Dikirim</button>
                        <button onclick="window.location='transaksi.php?status=sampai'" class="btn btn-primary"><span
                                class="fas fa-truck-loading"></span>Sampai</button>
                        <table class="table table-hover table-responsive-sm ">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Total Payment</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                if (empty($transaksi)) {
                                    echo "<tr><td colspan='7'><h5 style='color:red;text-align:center'>Tidak Ada Data</h5></td></tr>";
                                } ?>

                                <?php foreach ($transaksi as $tr): ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i++; ?>
                                        </th>
                                        <th>
                                            <?php $formattedId = "INV" . str_pad($tr["id"], 5, "0", STR_PAD_LEFT);
                                            echo $formattedId ?>
                                        </th>
                                        <td>
                                              <?php $originalDate = $tr["order_date"]; 
                                                $newDate = date("d-m-Y", strtotime($originalDate)); 
                                                echo $newDate;  ?>
                                        </td>
                                        <td>
                                            <?php $originalDate = $tr["due_date"]; 
                                                $newDate = date("d-m-Y", strtotime($originalDate)); 
                                                echo $newDate; ?>
                                        </td>
                                        <td>
                                            <?php $formattedPrice = "Rp " . number_format($tr["orders_total"], 0, ',', '.');
                                            echo $formattedPrice; ?>
                                        </td>
                                        <td>
                                            <?= $tr["status"]; ?>
                                        </td>
                                        <?php if ($tr["status"] === "sampai"): ?>
                                            <td><a href="invoice.php?id=<?= $tr["id"]; ?>"
                                                    class="btn btn-outline-primary">Review</a></td>
                                        <?php else: ?>
                                            <td><a href="invoice.php?id=<?= $tr["id"]; ?>"
                                                    class="btn btn-outline-primary">Detail</a></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

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