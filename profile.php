<?php
session_start();
require('admins/functions.php');

if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
  // Mendapatkan username dari session
  $email = $_SESSION["email"];
  $password = $_SESSION["password"];

  // Gunakan nilai email sesuai kebutuhan
  $user = query("SELECT * FROM `customer` WHERE `email`='$email'");


}

if (isset($_POST["changename"])) {
  if (changename($_POST) > 0) {
    header("Location: profile.php?successname=true");
    exit();
  } else {
    echo mysqli_error($conn);
  }

}

if (isset($_POST["changepp"])) {
  if (changepp($_POST) > 0) {
    header("Location: profile.php?successpp=true");
    exit();
  } else {
    echo mysqli_error($conn);
  }

}

if (isset($_POST["changegender"])) {
  if (changegender($_POST) > 0) {
    header("Location: profile.php?successgender=true");
    exit();
  } else {
    echo mysqli_error($conn);
  }

}

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
  <div id="custom-alert" class="alert alert-success fade show" style="display: none;" role="alert">
    <strong>Yeay</strong> Username berhasil diganti!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div id="custom-alert-pp" class="alert alert-success fade show" style="display: none;" role="alert">
    <strong>Yeay</strong> Foto Profil berhasil diganti!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div id="custom-alert-gender" class="alert alert-success fade show" style="display: none;" role="alert">
    <strong>Yeay</strong> Gender berhasil diedit!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <script>
    // Fungsi untuk menampilkan alert
    function showAlert(elementId) {
      const alertElement = document.getElementById(elementId);
      alertElement.style.display = "block";

      // Sembunyikan alert setelah 3 detik
      setTimeout(function () {
        alertElement.style.display = "none";
      }, 3000);
    }

    // Cek apakah alert perlu ditampilkan berdasarkan parameter URL 'success'
    const urlParams = new URLSearchParams(window.location.search);

    const successParamName = urlParams.get('successname');
    if (successParamName && successParamName === "true") {
      showAlert('custom-alert');
    }

    const successParamPP = urlParams.get('successpp');
    if (successParamPP && successParamPP === "true") {
      showAlert('custom-alert-pp');
    }

    const successParamgender = urlParams.get('successgender');
    if (successParamgender && successParamgender === "true") {
      showAlert('custom-alert-gender');
    }
  </script>

  <style>
    .fotoprofil {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    /* Menyembunyikan input asli */
    button[id="file-upload"] {
      display: none;
    }

    /* Gaya untuk tombol custom */
    .custom-button {
      border: 1px solid #ccc;
      display: inline-block;
      padding: 6px 12px;
      cursor: pointer;
      background-color: rgb(121, 113, 234);
      border-radius: 4px;
      color: white;
    }

    /* Optional: Gaya tambahan untuk mengindikasikan tombol aktif */
    .custom-button:hover {
      background-color: #e5e5e5;
      color: black;
    }

    .popup-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #f9f9f9;
      padding: 20px;
      border: 1px solid #ccc;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      z-index: 9999;
      border-radius: 10px;
      width: 500px;
    }

    /* CSS untuk overlay */
    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9998;
    }
  </style>
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

                <li class="active mb-1"><a href="profile.php" style="color:black;">Edit Profile</a></li>
                <li class="active mb-1"><a href="transaksi.php">Transaksi</a></li>
                <li class="active mb-1"><a href="riwayat.php">Riwayat Transaksi</a></li>
                <!-- <li class="active mb-1"><a href="Gantisandi.php">Ganti Sandi</a></li> -->

              </ul>
            </div>

          </div>

          <?php foreach ($user as $us): ?>
            <div class="col-md-3 order-1 mb-5 mb-md-0 fotoprofil">

              <div class="col-md fotoprofil">
                <img src="<?php if (!isset($us["pp"])) {
                  echo "images/defaultpp.png";
                } else {
                  echo "images/" . $us["pp"];
                } ?>" alt="" srcset="" class="img-fluid" style=" width: 100px;
      height: 100px;
      border-radius: 50%;">
              </div>
              <div class="col pt-3 fotoprofil">
                <label for="file-upload" class="custom-button">
                  Ubah Foto
                </label>
                <button id="file-upload" onclick="togglePopuppp()"></button>
              </div>
            </div>

            <div class="col-md-6 order-1 mb-5 mb-md-0 form-group">
              <h6>Username</h6>
              <p>
                <?= $us["name"]; ?><a onclick="togglePopupnama()" href="#" class="pl-3">Ubah</a>
              </p>
              <h6>Gender</h6>
              <p>
                <?php if (empty($us["gender"])) {
                  echo "Not Set";
                }else {
                  echo $us["gender"];
                } ; ?><a onclick="togglePopupgender()" href="#" class="pl-3">Ubah</a>
              </p>
              <button class="custom-button" onclick="window.location='login-form-06/forgotpass.php'">Ganti
                Password</button>
            </div>

            <div class="overlay" id="overlay"></div>

            <div class="popup-form" id="popupForm">
              <h2>Ubah Nama</h2>
              <form action="" method="post">
                <!-- Tambahkan elemen formulir sesuai kebutuhan -->
                <div class="form-group">
                  <label for="name">Nama:</label>
                  <input type="text" id="name" name="name" value="<?= $us["name"]; ?>" required class="form-control">
                </div>
                <input type="hidden" name="email" id="" value="<?= $us["email"]; ?>">
                <button type="submit" class="btn btn-primary" name="changename">Kirim</button>
                <a class="btn btn-danger" style="color:white;" onclick="window.location='profile.php'">Batal</a>
              </form>
            </div>

            <div class="popup-form" id="popupForm-gender">
              <h2>Ubah Foto Profil</h2>
              <form action="" method="post" enctype="multipart/form-data">
                <!-- Tambahkan elemen formulir sesuai kebutuhan -->
                <div class="form-group">
                  <div class="pria">
                  <input type="radio" name="gender" id="pria" value="Pria">
                  <label for="pria">Pria</label>
                  </div>
                  <div class="wanita">
                  <input type="radio" name="gender" id="wanita" value="Wanita">
                  <label for="wanita">Wanita</label>
                  </div>
                </div>
                <input type="hidden" name="email" id="" value="<?= $us["email"]; ?>">
                <button type="submit" class="btn btn-primary" name="changegender">Kirim</button>
                <a class="btn btn-danger" style="color:white;" onclick="window.location='profile.php'">Batal</a>
              </form>
            </div>

            <div class="popup-form" id="popupForm-pp">
              <h2>Ubah Foto Profil</h2>
              <form action="" method="post" enctype="multipart/form-data">
                <!-- Tambahkan elemen formulir sesuai kebutuhan -->
                <div class="form-group">

                  <input type="file" name="gambar" required>
                </div>
                <input type="hidden" name="email" id="" value="<?= $us["email"]; ?>">
                <button type="submit" class="btn btn-primary" name="changepp">Kirim</button>
                <a class="btn btn-danger" style="color:white;" onclick="window.location='profile.php'">Batal</a>
              </form>
            </div>
          <?php endforeach; ?>


        </div>
      </div>
    </div>


    <!-- Script JavaScript untuk menampilkan atau menyembunyikan popup form -->
    <script>
      function togglePopupnama() {
        var overlay = document.getElementById('overlay');
        var popupForm = document.getElementById('popupForm');

        // Jika popup form sedang tersembunyi, maka tampilkan
        if (popupForm.style.display === 'none') {
          popupForm.style.display = 'block';
          overlay.style.display = 'block';
        } else {
          // Jika popup form sedang ditampilkan, maka sembunyikan
          popupForm.style.display = 'none';
          overlay.style.display = 'none';
        }
      }

      function togglePopuppp() {
        var overlay = document.getElementById('overlay');
        var popupForm = document.getElementById('popupForm-pp');

        // Jika popup form sedang tersembunyi, maka tampilkan
        if (popupForm.style.display === 'none') {
          popupForm.style.display = 'block';
          overlay.style.display = 'block';
        } else {
          // Jika popup form sedang ditampilkan, maka sembunyikan
          popupForm.style.display = 'none';
          overlay.style.display = 'none';
        }
      }

      function togglePopupgender() {
        var overlay = document.getElementById('overlay');
        var popupForm = document.getElementById('popupForm-gender');

        // Jika popup form sedang tersembunyi, maka tampilkan
        if (popupForm.style.display === 'none') {
          popupForm.style.display = 'block';
          overlay.style.display = 'block';
        } else {
          // Jika popup form sedang ditampilkan, maka sembunyikan
          popupForm.style.display = 'none';
          overlay.style.display = 'none';
        }
      }
    </script>

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
                  <li class="address">
                    <?= $alamat; ?>
                  </li>
                  <li class="phone"><a href="tel://23923929210">
                      <?= $phone; ?>
                    </a></li>
                  <li class="email">
                    <?= $email; ?>
                  </li>
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