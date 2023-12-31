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
$id = $_GET["id"];

if (isset($_POST["cart"])) {
  if (cartplus($_POST) > 0) {
    header("Location: shop-single.php?id=$id&success=true");
    exit();
  } else {
    echo mysqli_error($conn);
  }

}

$contact = query("SELECT * FROM `contact` WHERE `id`=1");
$imgh = query("SELECT * FROM `imgheader` WHERE `id`=1");

$rating = query("SELECT * FROM `ulasan` WHERE `id_produk` = $id");
$product = query("SELECT * FROM `product` WHERE `id`=$id");
$clr = query("SELECT * FROM `color`");
$newprd = query("SELECT * FROM `product` ORDER BY id DESC LIMIT 5");
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
  <div id="custom-alert" class="alert alert-success fade show" style="display: none;" role="alert">
    <strong>Yeay</strong> Produk berhasil ditambahkan ke keranjang!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <script>
    // Fungsi untuk menampilkan alert
    function showAlert() {
      const alertElement = document.getElementById("custom-alert");
      alertElement.style.display = "block";

      // Sembunyikan alert setelah 3 detik
      setTimeout(function () {
        alertElement.style.display = "none";
      }, 3000);
    }

    // Cek apakah alert perlu ditampilkan berdasarkan parameter URL 'success'
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');

    if (successParam && successParam === "true") {
      showAlert();
    }
  </script>



  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="shop.php" class="site-block-top-search" method="post" class="filterForm">

                <span class="icon icon-search2"></span>

                <input type="text" name="search" class="form-control border-0" placeholder="Search">
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
            <li class="active"><a href="shop.php">Shop</a></li>
            <li><a href="catalog.php">Catalogue</a></li>
            <li><a href="newarrival.php">New Arrivals</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <?php foreach ($product as $prd): ?>
      <div class="bg-light py-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong
                class="text-black"><?= $prd["name"]; ?></strong></div>
          </div>
        </div>
      </div>

      <div class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <img src="images/<?= $prd["gambar"]; ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6">
              <?= $prd["about"]; ?>
              <p><strong class="text-primaryc h4">
                  <?php
                  $priceFromDatabase = $prd["price"];
                  $formattedPrice = "Rp " . number_format($priceFromDatabase, 0, ',', '.');
                  echo $formattedPrice;
                  ?>
                </strong></p>
              <form action="" method="post">
                <?php
                // Ambil nilai ukuran dari kolom 'size' pada tabel produk
                $sizeValues = $prd["size"];

                // Pecah nilai ukuran menjadi array
                $sizeArray = explode(',', $sizeValues);
                ?>
                <div class="mb-1 d-flex">
                  <?php foreach ($sizeArray as $size): ?>
                    <label for="<?= $size; ?>" class="d-flex mr-3 mb-3">
                      <span class="d-inline-block mr-2" style="top:2px; position: relative;"><input type="radio"
                          id="<?= $size; ?>" name="size" value="<?= $size; ?>" required></span> <span
                        class="d-inline-block text-black">
                        <?= $size; ?>
                      </span>
                    </label>
                  <?php endforeach; ?>
                </div>
                <?php
                // Ambil nilai ukuran dari kolom 'size' pada tabel produk
                $colorValues = $prd["color"];

                // Pecah nilai ukuran menjadi array
                $colorArray = explode(',', $colorValues);
                ?>
                <div class="mb-1 d-flex">
                  <?php foreach ($colorArray as $color): ?>
                    <?php foreach ($clr as $clrColor): ?>
                      <?php if ($color === $clrColor["color"]): ?>
                        <label for="<?= $color; ?>" class="d-flex mr-3 mb-3">
                          <span class="d-inline-block mr-2" style="top:2px; position: relative;">
                            <input type="radio" id="<?= $color; ?>" name="color" value="<?= $color; ?>" required>
                          </span>
                          <a class="d-flex color-item align-items-center">
                            <span class="color d-inline-block rounded-circle mr-2"
                              style="background-color: <?= $clrColor["codeclr"]; ?>"></span>
                            <span class="d-inline-block text-black">
                              <?= $color; ?>
                            </span>
                          </a>
                        </label>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </div>

                <div class="mb-5">
                  <div class="input-group mb-3" style="max-width: 120px;">
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                    </div>
                    <input type="text" name="jumlah" class="form-control text-center" value="1" placeholder=""
                      aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                    </div>
                  </div>

                </div>
                <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true): ?>
                  <?php foreach ($user as $us): ?>
                    <input type="hidden" name="id_customer" id="" value="<?= $us["id"]; ?>">
                  <?php endforeach; ?>
                <?php endif; ?>
                <input type="hidden" name="product_id" id="" value="<?= $prd["id"]; ?>">
                <input type="hidden" name="price" id="" value="<?= $prd["price"]; ?>">
                <?php if (isset($_SESSION["login"]) && $_SESSION["login"] === true): ?>
                  <p><button type="submit" class="buy-now btn btn-sm btn-primary" name="cart">Add To Cart</button></p>
                <?php else: ?>
                  <p><button type="submit" class="buy-now btn btn-sm btn-primary"
                      onclick="window.location='login-form-06'">Add To Cart</button></p>
                <?php endif; ?>
              </form>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      
      <?php if (empty($rating)): ?>
        <div class="container">
        <div class="review">
          <div class="row">
            <div class="col-12">
          <h5 style="color:red;text-align:center;">Belum ada ulasan.</h5>
          </div>
          </div>
        </div>
        </div>
      
        <div class="review">
        <?php else: ?>
          <?php foreach ($rating as $rt): 
            $star = $rt["rating"];
            $idus = $rt["id_user"];
            $teks = $rt["teks"];
            $tanggal = $rt["date_sub"];
            $user = query("SELECT * FROM `customer` WHERE `id` = $idus");

            foreach ($user as $us) {
              $gambar = $us["pp"];
              $name = $us["name"];
            }

            ?>
            <div class="container">
          <div class="row">
            <div class="col-lg-1">
              <img src="<?php if (!isset($gambar)) {
                  echo "images/defaultpp.png";
                } else {
                  echo "images/".$gambar;
                } ?>" alt="" srcset="" style="width:75px;height:75px;border-radius:50%;margin-top:10px">
            </div>
            <div class="col-lg-10">
              <h5><?= $name; ?></h5>
              <div class="rating2">
                <input type="radio" id="star5" value="5" <?php if ($star == "5") echo "checked"; ?> disabled />
                <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                <input type="radio" id="star4" value="4" <?php if ($star == "4") echo "checked"; ?> disabled />
                <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                <input type="radio" id="star3" value="3" <?php if ($star == "3") echo "checked"; ?> disabled />
                <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                <input type="radio" id="star2" value="2" <?php if ($star == "2") echo "checked"; ?> disabled />
                <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                <input type="radio" id="star1" value="1" <?php if ($star == "1") echo "checked"; ?> disabled />
                <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
              </div><br><br>
              <p style="margin:0px;"><?php echo date('Y-m-d H:i', strtotime($tanggal)); ?></p>
              <p><?= $teks; ?></p>
            </div>
          </div>
        </div>
          <?php endforeach; ?>
          <?php endif; ?>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Featured Products</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
              <?php foreach ($newprd as $prd): ?>
                <div class="item">
                  <div class="block-4 text-center">
                    <figure class="block-4-image">
                      <img src="images/<?= $prd["gambar"]; ?>" alt="<?= $prd["name"]; ?>" class="img-fluid">
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="shop-single.php?id=<?= $prd["id"]; ?>">
                          <?= $prd["name"]; ?>
                        </a></h3>
                      <p class="mb-0">
                        <?= $prd["short"]; ?>
                      </p>
                      <p class="text-primaryc font-weight-bold">
                        <?php $priceFromDatabase = $prd["price"];
                        $formattedPrice = "Rp " . number_format($priceFromDatabase, 0, ',', '.');
                        echo $formattedPrice; ?>
                      </p>
                    </div>
                  </div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/0d2b3238f9.js" crossorigin="anonymous"></script>
</body>

</html>