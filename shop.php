<?php
require('admins/functions.php');

$query = "SELECT * FROM `product`";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_all($result, MYSQLI_ASSOC);


// // Periksa apakah form dikirimkan
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter'])) {
//   // Ambil nilai dari form
//   $selectedCategory = isset($_POST['category']) ? $_POST['category'] : '';
//   $selectedColors = isset($_POST['color']) ? $_POST['color'] : array();
//   $selectedSizes = isset($_POST['size']) ? $_POST['size'] : array();
//   $searchTerm = $_POST['search'];
//   $priceRange = $_POST['price_range'];

//   // Buat klausa WHERE berdasarkan filter yang dipilih
//   $whereClause = '1 = 1'; // Kondisi awal untuk memastikan query tetap valid
//   if (!empty($selectedCategory)) {
//     $whereClause .= " AND category = '$selectedCategory'";
//   }

//   if (!empty($selectedColors)) {
//     $colorConditions = array();
//     foreach ($selectedColors as $color) {
//       $colorConditions[] = "FIND_IN_SET('$color', color) > 0";
//     }
//     $colorClause = implode(' OR ', $colorConditions);
//     $whereClause .= " AND ($colorClause)";
//   }

//   if (!empty($selectedSizes)) {
//     $sizeConditions = array();
//     foreach ($selectedSizes as $size) {
//       $sizeConditions[] = "FIND_IN_SET('$size', size) > 0";
//     }
//     $sizeClause = implode(' OR ', $sizeConditions);
//     $whereClause .= " AND ($sizeClause)";
//   }

//   if (!empty($searchTerm)) {
//     $whereClause .= " AND (name LIKE '%$searchTerm%')";
//   }

//   // Peroleh harga minimal dan maksimal dari string
//   $priceRange = str_replace(array('Rp', ','), '', $priceRange);
//   $prices = explode('-', $priceRange);
//   $minPrice = (int) $prices[0];
//   $maxPrice = (int) $prices[1];


//   // Tambahkan klausa WHERE untuk filter harga minimal dan maksimal
//   if (!empty($minPrice)) {
//     $whereClause .= " AND price >= $minPrice";
//   }

//   if (!empty($maxPrice)) {
//     $whereClause .= " AND price <= $maxPrice";
//   }

//   // Query SQL dengan filter
//   $query = "SELECT * FROM `product` WHERE $whereClause";
//   $result = mysqli_query($conn, $query);
//   $product = mysqli_fetch_all($result, MYSQLI_ASSOC);

//   // Eksekusi query dan lakukan pengolahan data

//   // ...
// }

// if (!isset($_POST['filter'])) {
//   $query = "SELECT * FROM `product` WHERE 1=1";
//   $result = mysqli_query($conn, $query);
//   $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
// }



$category = query("SELECT * FROM `category`");
$size = query("SELECT * FROM `size`");
$color = query("SELECT * FROM `color`");

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
              <form action="" class="site-block-top-search" method="post">
                <button type="submit" name="filter" hidden></button>
                <span class="icon icon-search2"></span>

                <input type="text" name="search" class="form-control border-0"
                  value="<?= isset($_POST['search']) ? $_POST['search'] : ''; ?>" placeholder="Search">
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
                  <li><a href="#"><span class="icon icon-person"></span></a></li>
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
            <li class="has-children">
              <a href="index.php">Home</a>
              <ul class="dropdown">
                <li><a href="#">Menu One</a></li>
                <li><a href="#">Menu Two</a></li>
                <li><a href="#">Menu Three</a></li>
                <li class="has-children">
                  <a href="#">Sub Menu</a>
                  <ul class="dropdown">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-children">
              <a href="about.php">About</a>
              <ul class="dropdown">
                <li><a href="#">Menu One</a></li>
                <li><a href="#">Menu Two</a></li>
                <li><a href="#">Menu Three</a></li>
              </ul>
            </li>
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
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4">
                  <h2 class="text-black h5">Shop All</h2>
                </div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Latest
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                      <a class="dropdown-item" href="#">Men</a>
                      <a class="dropdown-item" href="#">Women</a>
                      <a class="dropdown-item" href="#">Children</a>
                    </div>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference"
                      data-toggle="dropdown">Reference</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                      <a class="dropdown-item" href="#">Relevance</a>
                      <a class="dropdown-item" href="#">Name, A to Z</a>
                      <a class="dropdown-item" href="#">Name, Z to A</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Price, low to high</a>
                      <a class="dropdown-item" href="#">Price, high to low</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-5" id="productList">
              <?php if (empty($product)): ?>
                <p style="color:red;text-decoration: underline;" class="ml-5">Product yang anda Cari Tidak Ada</p>
              <?php else: ?>
                <?php foreach ($product as $prd): ?>
                  <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                    <div class="block-4 text-center border">
                      <figure class="block-4-image">
                        <a href="shop-single.php"><img src="images/<?= $prd["gambar"]; ?>" alt="Image placeholder"
                            class="img-fluid"></a>
                      </figure>
                      <div class="block-4-text p-4">
                        <h3><a href="shop-single.php?id=<?= $prd["id"]; ?>"><?= $prd["name"]; ?></a></h3>
                        <p class="mb-0">
                          <?= $prd["short"]; ?>
                        </p>
                        <p class="text-primary font-weight-bold">
                          <?php
                          $priceFromDatabase = $prd["price"];
                          $formattedPrice = "Rp " . number_format($priceFromDatabase, 0, ',', '.');
                          echo $formattedPrice;
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>



            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                    <li><a href="#">&lt;</a></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&gt;</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <form action="" method="post" id="filterForm" name="filter">
                  <li class="mb-1">
                    <input type="radio" name="category" id="all" value=""  <?= empty($_POST['category']) ? 'checked' : ''; ?>>
                    <label for="all"><span style="color:#7971ea;">All Category</span> </label>
                  </li>
                  <?php foreach ($category as $ctg): ?>
                    <li class="mb-1">
                      <input type="radio" name="category" id="<?= $ctg["category"]; ?>" value="<?= $ctg["category"]; ?>"
                        <?= (isset($_POST['category']) && $_POST['category'] === $ctg["category"]) ? 'checked' : ''; ?>>
                      <label for="<?= $ctg["category"]; ?>"><span style="color:#7971ea;">
                          <?= $ctg["category"]; ?>
                        </span> <span class="text-black ml-auto"> (
                          <?php
                          $categoryCount = query("SELECT COUNT(category) AS jumlah FROM product WHERE category = '" . $ctg["category"] . "'");
                          if ($categoryCount && !empty($categoryCount)) {
                            echo $categoryCount[0]["jumlah"];
                          } else {
                            echo "0";
                          }
                          ?>)
                        </span></label>
                    </li>
                  <?php endforeach; ?>
              </ul>
            </div>
            <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <div id="slider-range" class="border-primary"></div>
                <input type="text" name="Price" id="amount" class="form-control border-0 pl-0 bg-white filter-input"
                  readonly />
              </div>
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                <?php foreach ($size as $sz): ?>
                  <label for="<?= $sz["size"]; ?>" class="d-flex">
                    <input type="checkbox" id="<?= $sz["size"]; ?>" class="mr-2 mt-1 filter-input" name="size[]"
                      value="<?= $sz["size"]; ?>" <?= isset($_POST['size']) && in_array($sz["size"], $_POST['size']) ? 'checked' : ''; ?>> <span class="text-black mt-1">
                      <?= $sz["size"]; ?>
                    </span>
                  </label>
                <?php endforeach; ?>
              </div>

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                <?php foreach ($color as $clr): ?>
                  <div class="d-flex align-items-center">
                    <input type="checkbox" name="color[]" id="<?= $clr["color"]; ?>" value="<?= $clr["color"]; ?>"class="filter-input"
                      <?= isset($_POST['color']) && in_array($clr["color"], $_POST['color']) ? 'checked' : ''; ?>>
                    <label for="<?= $clr["color"]; ?>">
                      <a class="d-flex color-item align-items-center mt-2 ml-2">
                        <span class="color d-inline-block rounded-circle mr-2"
                          style="background-color: <?= $clr["codeclr"]; ?>"></span>
                        <span class="text-black">
                          <?= $clr["color"]; ?>
                        </span>
                      </a>
                    </label>
                  </div>
                <?php endforeach; ?>
                <br>
                <input type="hidden" name="search" id=""
                  value="<?= isset($_POST['search']) ? $_POST['search'] : ''; ?>">

                </form>

                <script>
   $(document).ready(function() {
  // Fungsi untuk mengirim permintaan filter ke server
  function filterProducts() {
    var formData = $('#filterForm').serialize(); // Mendapatkan nilai filter dari form
    $.ajax({
      url: 'filter.php', // Ganti dengan URL endpoint untuk pemrosesan filter di sisi server
      type: 'POST',
      data: formData,
      beforeSend: function() {
        // Tampilkan loader atau animasi loading
        $('#productList').html('<div class="loader">Loading...</div>');
      },
      success: function(response) {
        // Update daftar produk dengan hasil filter dari server
        $('#productList').html(response);
      }
    });
  }

  // Tangkap perubahan pada elemen filter dan panggil fungsi filterProducts
  $('#filterForm input').change(function() {
    filterProducts();
  });

  $('#filterForm select').change(function() {
    filterProducts();
  });
});
$(document).ready(function() {
  // Fungsi untuk mengirim permintaan filter ke server
  function filterProducts() {
    var formData = $('#filterForm').serialize(); // Mendapatkan nilai filter dari form
    $.ajax({
      url: 'filter.php', // Ganti dengan URL endpoint untuk pemrosesan filter di sisi server
      type: 'POST',
      data: formData,
      beforeSend: function() {
        // Tampilkan loader atau animasi loading
        $('#productList').html('<div class="loader">Loading...</div>');
      },
      success: function(response) {
        // Update daftar produk dengan hasil filter dari server
        $('#productList').html(response);
      }
    });
  }

  // Tangkap perubahan pada elemen filter dan panggil fungsi filterProducts
  $('.filter-input').change(function() {
    filterProducts();
  });

  $('#filterForm select').change(function() {
    filterProducts();
  });
});

  </script>
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="site-section site-blocks-2">
              <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7 site-section-heading pt-4">
                  <h2>Categories</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                  <a class="block-2-item" href="#">
                    <figure class="image">
                      <img src="images/women.jpg" alt="" class="img-fluid">
                    </figure>
                    <div class="text">
                      <span class="text-uppercase">Collections</span>
                      <h3>Women</h3>
                    </div>
                  </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                  <a class="block-2-item" href="#">
                    <figure class="image">
                      <img src="images/children.jpg" alt="" class="img-fluid">
                    </figure>
                    <div class="text">
                      <span class="text-uppercase">Collections</span>
                      <h3>Children</h3>
                    </div>
                  </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                  <a class="block-2-item" href="#">
                    <figure class="image">
                      <img src="images/men.jpg" alt="" class="img-fluid">
                    </figure>
                    <div class="text">
                      <span class="text-uppercase">Collections</span>
                      <h3>Men</h3>
                    </div>
                  </a>
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
              <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
              <h3 class="font-weight-light  mb-0">Finding Your Perfect Shoes</h3>
              <p>Promo from nuary 15 &mdash; 25, 2019</p>
            </a>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
              </ul>
            </div>

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