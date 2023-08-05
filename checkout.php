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
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="#">Click here</a> to login
            </div>
          </div>
        </div>
        <form action="insinvoice.php" method="post">
          <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Billing Details</h2>
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="fname">
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="lname">
                  </div>
                </div>

                <div class="form-group">

                  <label for="prov" class="text-black">Provinsi <span class="text-danger">*</span></label>
                  <select id="prov" class="form-control" name="nama_provinsi">

                  </select>
                </div>
                <div class="form-group">
                  <label for="kab" class="text-black">Kota/Kabupaten <span class="text-danger">*</span></label>
                  <select id="kab" class="form-control" name="nama_kota">
                    <option value="">Pilih Kabupaten/Kota</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="kec" class="text-black">Kecamatan <span class="text-danger">*</span></label>
                  <select id="kec" class="form-control" name="nama_kecamatan">
                    <option value="">Pilih Kecamatan</option>
                  </select>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_address" class="text-black">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="alamat" id="c_address" cols="30" rows="10" class="form-control"
                      placeholder="Nama Jalan, Gedung, No. Rumah , Kodepos"></textarea>
                  </div>
                </div>

                

                <div class="form-group">
                  
                    <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_phone" name="phone" placeholder="Phone Number">
                  
                </div>


                <div class="form-group">
                  <label for="c_ship_different_address" class="text-black" data-toggle="collapse"
                    href="#ship_different_address" role="button" aria-expanded="false"
                    aria-controls="ship_different_address"><input type="checkbox" value="1"
                      id="c_ship_different_address" name="diff_address">
                    Ship To A Different Address?</label>
                  <div class="collapse" id="ship_different_address">
                    <div class="py-2">

                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="c_fnamediff" class="text-black">First Name <span
                              class="text-danger">*</span></label>
                          <input type="text" class="form-control diff" id="c_fnamediff" name="difffname">
                        </div>
                        <div class="col-md-6">
                          <label for="c_lnamediff" class="text-black">Last Name <span
                              class="text-danger">*</span></label>
                          <input type="text" class="form-control diff" id="c_lnamediff" name="difflname">
                        </div>
                      </div>

                      <div class="form-group">

                        <label for="prov" class="text-black">Provinsi <span class="text-danger">*</span></label>
                        <select id="prov" class="form-control diff" name="diffnama_provinsi">

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kab" class="text-black">Kota/Kabupaten <span class="text-danger">*</span></label>
                        <select id="kab" class="form-control diff" name="diffnama_kota">
                          <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="kec" class="text-black">Kecamatan <span class="text-danger">*</span></label>
                        <select id="kec" class="form-control diff" name="diffnama_kecamatan">
                          <option value="">Pilih Kecamatan</option>
                        </select>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-12">
                          <label for="c_address" class="text-black">Alamat Lengkap <span
                              class="text-danger">*</span></label>
                          <textarea name="diffalamat" id="c_addressdiff" cols="30" rows="10" class="form-control diff"
                            placeholder="Nama Jalan, Gedung, No. Rumah , Kodepos"></textarea>
                        </div>
                      </div>

                    


                      <div class="form-group">
                      
                          <label for="c_phonediff" class="text-black">Phone <span class="text-danger">*</span></label>
                          <input type="text" class="form-control diff" id="c_phonediff" name="diffphone"
                            placeholder="Phone Number">
                       
                      </div>

                    </div>

                  </div>
                </div>

    <div class="form-group">
    <label for="c_email_address" class="text-black">Email Address <span
                            class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="c_email_address" name="email">
    </div>

                <div class="form-group">
                  <label for="kurir" class="text-black">Kurir Ekspedisi<span class="text-danger">*</span></label>
                  <select id="kurir" class="form-control" name="nama_ekspedisi">
                    <option value="">Pilih Kurir</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="paket" class="text-black">Paket <span class="text-danger">*</span></label>
                  <select id="paket" class="form-control" name="nama_paket">
                    <option value="">Pilih Paket</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="c_order_notes" class="text-black">Order Notes</label>
                  <textarea name="order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                    placeholder="Write your notes here..."></textarea>
                </div>

                


              </div>
            </div>
            <div class="col-md-6">

              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                  <div class="p-3 p-lg-5 border">

                    <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                    <div class="input-group w-75">
                      <input type="text" class="form-control" id="c_code" placeholder="Coupon Code"
                        aria-label="Coupon Code" aria-describedby="button-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

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
                        $berat_total = 0;
                        foreach ($user as $us):
                          $userid = $us['id'];

                          $cart = query("SELECT * FROM `cart` WHERE `id_customer`=$userid");


                          foreach ($cart as $cr):
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
                              $idpr = $pr["id"];
                              $berat = $pr["berat"];
                            }

                            ?>
                            <tr>
                              <td>
                                <?= $name; ?> <strong class="mx-2">x</strong>
                                <?= $jumlah . " " . $color; ?>
                                <input type="hidden" name="product_id[]" id="" value="<?= $product_id ?>">
                                <input type="hidden" name="jumlah[]" id="" value="<?= $jumlah ?>">
                              </td>
                              <td>
                                <?php $subtotal = $price * $jumlah;
                                $sub = "Rp" . number_format($subtotal, 0, ',', '.');
                                echo $sub; ?>
                              </td>
                            </tr>
                            <?php $product_total += $price * $jumlah; // tambahkan harga produk ke total 
                                $berat_total += $berat * $jumlah;
                          endforeach; ?>
                        <?php endforeach; ?>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                          <td class="text-black">
                            <?php
                            $formattedPrice = "Rp" . number_format($product_total, 0, ',', '.');
                            echo $formattedPrice; ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Ongkir</strong></td>
                          <td class="text-black hargaongkir">
                            <?php
                            if (!empty($ongkir)) {
                              $formattedPrice = "Rp" . number_format($ongkir, 0, ',', '.');
                              echo $formattedPrice;
                            } else {
                              echo "Belum Dipilih";
                            }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                          <td class="text-black font-weight-bold order-total"><strong>Rp
                              <?php
                              if (!empty($order_total)) {
                                echo number_format($order_total, 0, ',', '.');
                              } else {
                                echo number_format($product_total, 0, ',', '.');
                              }
                              ?>
                            </strong></td>

                        </tr>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Total Berat</strong></td>
                          <td class="text-black font-weight-bold order-total"><strong>
                              <?= $berat_total ?> gram
                            </strong></td>

                        </tr>
                      </tbody>
                    </table>



                    <input type="hidden" name="total_berat" id="" value="<?= $berat_total ?>">
                    <input type="hidden" name="alamatlengkap" id="alamatlengkap" required>
                    <input type="hidden" name="firstname" id="firstname" required>
                    <input type="hidden" name="lastname" id="lastname" required>
                    <input type="hidden" name="number" id="number" required>
                    <input type="hidden" name="provinsi" id="" value="" required>
                    <input type="hidden" name="kota" id="" value="" required>
                    <input type="hidden" name="kecamatan" id="" value="" required>
                    <input type="hidden" name="kodepos" id="" value="" required>
                    <input type="hidden" name="ekspedisi" id="" value="" required>
                    <input type="hidden" name="paket" id="" value="" required>
                    <input type="hidden" name="ongkir" id="" value="" required>
                    <input type="hidden" name="estimasi" id="" value="" required>
                    <input type="hidden" name="order_total" id="" required>
                    <input type="datetime-local" name="created_at" id="waktu_kirim" required style="display:none;">
                    <?php foreach ($user as $us): ?>
                      <input type="hidden" name="user_id" id="" required value="<?= $us["id"]; ?>">
                    <?php endforeach; ?>
                    <?php foreach ($cart as $cr): ?>
                      <input type="hidden" name="color[]" id="" required value="<?= $cr["color"]; ?>">
                      <input type="hidden" name="size[]" id="" required value="<?= $cr["size"]; ?>">
                    <?php endforeach; ?>
                    <script>
                      // Mendapatkan waktu saat ini
                      var now = new Date();

                      // Mengubah waktu menjadi string dalam format yang diterima oleh input datetime-local
                      var formattedDateTime = now.toISOString().slice(0, 16);

                      // Mengisi nilai default pada input datetime-local
                      document.getElementById('waktu_kirim').value = formattedDateTime;
                    </script>

                    <div class="form-group">
                      <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Place
                        Order</button>
                      <button class="btn btn-danger btn-lg py-3 btn-block" onclick="window.location='cart.php'">Cancel</button>
                    </div>



                  </div>
                </div>
              </div>

            </div>
          </div>
        </form>
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

  <script>
    $(document).ready(function () {

      $.ajax({
        type: 'POST',
        url: 'admins/dataprovinsi.php',
        success: function (provinsi) {
          $("select[name=nama_provinsi]").html(provinsi);
        }
      });

      $("select[name=nama_provinsi]").on("change", function () {
        var provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
        $.ajax({
          type: 'POST',
          url: 'admins/datakota.php',
          data: { id_provinsi: provinsi_terpilih },
          success: function (kota) {
            $("select[name=nama_kota]").html(kota);
          }
        });
      });

      $("select[name=nama_kota]").on("change", function () {
        var kota_terpilih = $("option:selected", this).attr("city_id");
        $.ajax({
          type: 'POST',
          url: 'admins/datakecamatan.php',
          data: { id_kota: kota_terpilih },
          success: function (kecamatan) {
            $("select[name=nama_kecamatan]").html(kecamatan);
          }
        });

        $.ajax({
          type: 'POST',
          url: 'admins/datakurir.php',
          success: function (kurir) {
            $("select[name=nama_ekspedisi]").html(kurir);
          }
        });
      });

      $("select[name=nama_ekspedisi]").on("change", function () {
        var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
        var kota_terpilih = $("option:selected", "select[name=nama_kota]").attr("city_id");
        var total_berat = $("input[name=total_berat]").val();

        $.ajax({
          type: 'POST',
          url: 'admins/datapaket.php',
          data: 'ekspedisi=' + ekspedisi_terpilih + '&kota=' + kota_terpilih + '&berat=' + total_berat,
          success: function (paket) {
            $("select[name=nama_paket]").html(paket);

            $("input[name=ekspedisi]").val(ekspedisi_terpilih);
          }
        });
      });

      $("select[name=nama_kota]").on("change", function () {
        var prov = $("option:selected", this).attr("nama_provinsi");
        var kota = $("option:selected", this).attr("nama_kota");
        var codepost = $("option:selected", this).attr("codepost");

        $("input[name=provinsi]").val(prov);
        $("input[name=kota]").val(kota);
        $("input[name=kodepos]").val(codepost);

      });

      $("select[name=nama_paket]").on("change", function () {
        var paket = $("option:selected", this).attr("paket");
        var ongkir = parseFloat($("option:selected", this).attr("ongkir"));
        var etd = $("option:selected", this).attr("etd");

        $("input[name=paket]").val(paket);
        $("input[name=ongkir]").val(ongkir);
        $("input[name=estimasi]").val(etd);


        $("td.hargaongkir").text("Rp" + ongkir.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));



        // Mengambil nilai product_total
        var product_total = parseFloat(<?php echo $product_total; ?>);

        // Menghitung order total
        var order_total = product_total + ongkir;
        $("td.order-total").text("Rp" + order_total.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));

        // Mengupdate nilai input hidden dengan order_total
        $("input[name=order_total]").val(order_total);
      });

      $("select[name=nama_kecamatan]").on("change", function () {
        var kec = $("option:selected", this).attr("nama_kecamatan");

        $("input[name=kecamatan]").val(kec);


      });

      $("input[name=diff_address]").on("change", function () {
        if ($(this).prop("checked")) {

          $.ajax({
            type: 'POST',
            url: 'admins/dataprovinsi0.php',
            success: function (provinsi) {
              $("select[name=nama_provinsi]").html(provinsi);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datakurir0.php',
            success: function (kurir) {
              $("select[name=nama_ekspedisi]").html(kurir);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datakota0.php',
            success: function (kota) {
              $("select[name=nama_kota]").html(kota);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datakecamatan0.php',
            success: function (kecamatan) {
              $("select[name=nama_kecamatan]").html(kecamatan);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datapaket0.php',
            success: function (paket) {
              $("select[name=nama_paket]").html(paket); 
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/dataprovinsi.php',
            success: function (provinsi) {
              $("select[name=diffnama_provinsi]").html(provinsi);
            }
          });

          $("select[name=diffnama_provinsi]").on("change", function () {
            var provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
              type: 'POST',
              url: 'admins/datakota.php',
              data: { id_provinsi: provinsi_terpilih },
              success: function (kota) {
                $("select[name=diffnama_kota]").html(kota);
              }
            });
          });

          $("select[name=diffnama_kota]").on("change", function () {
            var kota_terpilih = $("option:selected", this).attr("city_id");
            $.ajax({
              type: 'POST',
              url: 'admins/datakecamatan.php',
              data: { id_kota: kota_terpilih },
              success: function (kecamatan) {
                $("select[name=diffnama_kecamatan]").html(kecamatan);
              }
            });

            $.ajax({
              type: 'POST',
              url: 'admins/datakurir.php',
              success: function (kurir) {
                $("select[name=nama_ekspedisi]").html(kurir);
              }
            });
          });

          $("select[name=nama_ekspedisi]").on("change", function () {
            var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
            var kota_terpilih = $("option:selected", "select[name=diffnama_kota]").attr("city_id");
            var total_berat = $("input[name=total_berat]").val();

            $.ajax({
              type: 'POST',
              url: 'admins/datapaket.php',
              data: 'ekspedisi=' + ekspedisi_terpilih + '&kota=' + kota_terpilih + '&berat=' + total_berat,
              success: function (paket) {
                $("select[name=nama_paket]").html(paket);

                $("input[name=ekspedisi]").val(ekspedisi_terpilih);
              }
            });
          });

          $("select[name=diffnama_kota]").on("change", function () {
            var prov = $("option:selected", this).attr("nama_provinsi");
            var kota = $("option:selected", this).attr("nama_kota");
            var codepost = $("option:selected", this).attr("codepost");

            $("input[name=provinsi]").val(prov);
            $("input[name=kota]").val(kota);
            $("input[name=kodepos]").val(codepost);

          });

          $("select[name=nama_paket]").on("change", function () {
            var paket = $("option:selected", this).attr("paket");
            var ongkir = parseFloat($("option:selected", this).attr("ongkir"));
            var etd = $("option:selected", this).attr("etd");

            $("input[name=paket]").val(paket);
            $("input[name=ongkir]").val(ongkir);
            $("input[name=estimasi]").val(etd);


            $("td.hargaongkir").text("Rp" + ongkir.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));



            // Mengambil nilai product_total
            var product_total = parseFloat(<?php echo $product_total; ?>);

            // Menghitung order total
            var order_total = product_total + ongkir;
            $("td.order-total").text("Rp" + order_total.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));

            // Mengupdate nilai input hidden dengan order_total
            $("input[name=order_total]").val(order_total);
          });

          $("select[name=diffnama_kecamatan]").on("change", function () {
            var kec = $("option:selected", this).attr("nama_kecamatan");

            $("input[name=kecamatan]").val(kec);


          });

        } else {

          $.ajax({
            type: 'POST',
            url: 'admins/dataprovinsi0.php',
            success: function (provinsi) {
              $("select[name=diffnama_provinsi]").html(provinsi);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datakurir0.php',
            success: function (kurir) {
              $("select[name=nama_ekspedisi]").html(kurir);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datakota0.php',
            success: function (kota) {
              $("select[name=diffnama_kota]").html(kota);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datakecamatan0.php',
            success: function (kecamatan) {
              $("select[name=diffnama_kecamatan]").html(kecamatan);
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/datapaket0.php',
            success: function (paket) {
              $("select[name=nama_paket]").html(paket); 
            }
          });

          $.ajax({
            type: 'POST',
            url: 'admins/dataprovinsi.php',
            success: function (provinsi) {
              $("select[name=nama_provinsi]").html(provinsi);
            }
          });

          $("select[name=nama_provinsi]").on("change", function () {
            var provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
              type: 'POST',
              url: 'admins/datakota.php',
              data: { id_provinsi: provinsi_terpilih },
              success: function (kota) {
                $("select[name=nama_kota]").html(kota);
              }
            });
          });

          $("select[name=nama_kota]").on("change", function () {
            var kota_terpilih = $("option:selected", this).attr("city_id");
            $.ajax({
              type: 'POST',
              url: 'admins/datakecamatan.php',
              data: { id_kota: kota_terpilih },
              success: function (kecamatan) {
                $("select[name=nama_kecamatan]").html(kecamatan);
              }
            });
          });

          $("select[name=nama_ekspedisi]").on("change", function () {
            var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
            var kota_terpilih = $("option:selected", "select[name=nama_kota]").attr("city_id");
            var total_berat = $("input[name=total_berat]").val();

            $.ajax({
              type: 'POST',
              url: 'admins/datapaket.php',
              data: 'ekspedisi=' + ekspedisi_terpilih + '&kota=' + kota_terpilih + '&berat=' + total_berat,
              success: function (paket) {
                $("select[name=nama_paket]").html(paket);

                $("input[name=ekspedisi]").val(ekspedisi_terpilih);
              }
            });
          });

          $("select[name=nama_kota]").on("change", function () {
            var prov = $("option:selected", this).attr("nama_provinsi");
            var kota = $("option:selected", this).attr("nama_kota");
            var codepost = $("option:selected", this).attr("codepost");

            $("input[name=provinsi]").val(prov);
            $("input[name=kota]").val(kota);
            $("input[name=kodepos]").val(codepost);

          });

          $("select[name=nama_paket]").on("change", function () {
            var paket = $("option:selected", this).attr("paket");
            var ongkir = parseFloat($("option:selected", this).attr("ongkir"));
            var etd = $("option:selected", this).attr("etd");

            $("input[name=paket]").val(paket);
            $("input[name=ongkir]").val(ongkir);
            $("input[name=estimasi]").val(etd);


            $("td.hargaongkir").text("Rp" + ongkir.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));



            // Mengambil nilai product_total
            var product_total = parseFloat(<?php echo $product_total; ?>);

            // Menghitung order total
            var order_total = product_total + ongkir;
            $("td.order-total").text("Rp" + order_total.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));

            // Mengupdate nilai input hidden dengan order_total
            $("input[name=order_total]").val(order_total);
          });

          $("select[name=nama_kecamatan]").on("change", function () {
            var kec = $("option:selected", this).attr("nama_kecamatan");

            $("input[name=kecamatan]").val(kec);


          });
        }

      });
    });

  </script>

<script>
  $(document).ready(function () {
    // Fungsi untuk mengatur nilai input saat "Ship To Different Address" berubah
    function clearNonDiffInputs() {

      $("input[name=firstname]").val("");
        $("input[name=lastname]").val("");
        $("input[name=email]").val("");
        $("input[name=number]").val("");
        $("input[name=alamatlengkap]").val("");

        // Set hidden input values to empty
        $("input[name=provinsi]").val("");
        $("input[name=kota]").val("");
        $("input[name=kecamatan]").val("");
        $("input[name=kodepos]").val("");
        $("input[name=ekspedisi]").val("");
        $("input[name=paket]").val("");
        $("input[name=ongkir]").val("");
        $("input[name=estimasi]").val("");
        $("input[name=order_total]").val("");

      if ($("input[name=diff_address]").prop("checked")) {
        // Clear value for non-diff inputs
        $("input[name=fname]").val("");
        $("input[name=lname]").val("");
        $("input[name=email_address]").val("");
        $("input[name=phone]").val("");
        $("textarea[name=alamat]").val("");

        // Disable non-diff inputs
        $("input[name=fname]").prop("disabled", true);
        $("input[name=lname]").prop("disabled", true);
        $("input[name=email_address]").prop("disabled", true);
        $("input[name=phone]").prop("disabled", true);
        $("textarea[name=alamat]").prop("disabled", true);
      } else {
        // Clear value for diff inputs
        $("input[name=difffname]").val("");
        $("input[name=difflname]").val("");
        $("input[name=diffemail_address]").val("");
        $("input[name=diffphone]").val("");
        $("textarea[name=diffalamat]").val("");

        // Enable non-diff inputs
        $("input[name=fname]").prop("disabled", false);
        $("input[name=lname]").prop("disabled", false);
        $("input[name=email_address]").prop("disabled", false);
        $("input[name=phone]").prop("disabled", false);
        $("textarea[name=alamat]").prop("disabled", false);
      }
    }

    // Panggil fungsi saat halaman pertama kali dimuat
    clearNonDiffInputs();

    // Panggil fungsi saat "Ship To Different Address" berubah (dicentang/dilepas)
    $("input[name=diff_address]").on("change", function () {
      clearNonDiffInputs();
    });
  });
</script>


  <script>
    // Function to update the hidden fields
    function updateHiddenFields() {
      // Get the values from the first and last name inputs
      const firstNameInput = document.getElementById("c_fname");
      const lastNameInput = document.getElementById("c_lname");
      const phoneInput = document.getElementById("c_phone");
      const alamatInput = document.getElementById("c_address");

      // Update the values in the hidden fields
      document.getElementById("firstname").value = firstNameInput.value;
      document.getElementById("lastname").value = lastNameInput.value;
      document.getElementById("number").value = phoneInput.value;
      document.getElementById("alamatlengkap").value = alamatInput.value;
    }

    // Add event listeners to the first and last name inputs
    document.getElementById("c_fname").addEventListener("input", updateHiddenFields);
    document.getElementById("c_lname").addEventListener("input", updateHiddenFields);
    document.getElementById("c_phone").addEventListener("input", updateHiddenFields);
    document.getElementById("c_address").addEventListener("input", updateHiddenFields);


  </script>

  <script> function updateHiddenFields() {
      // Get the values from the first and last name inputs
      const firstNameInput = document.getElementById("c_fnamediff");
      const lastNameInput = document.getElementById("c_lnamediff");
      const phoneInput = document.getElementById("c_phonediff");
      const alamatInput = document.getElementById("c_addressdiff");

      // Update the values in the hidden fields
      document.getElementById("firstname").value = firstNameInput.value;
      document.getElementById("lastname").value = lastNameInput.value;
      document.getElementById("number").value = phoneInput.value;
      document.getElementById("alamatlengkap").value = alamatInput.value;
    }

    // Add event listeners to the first and last name inputs
    document.getElementById("c_fnamediff").addEventListener("input", updateHiddenFields);
    document.getElementById("c_lnamediff").addEventListener("input", updateHiddenFields);
    document.getElementById("c_phonediff").addEventListener("input", updateHiddenFields);
    document.getElementById("c_addressdiff").addEventListener("input", updateHiddenFields);

  </script>

</body>

</html>