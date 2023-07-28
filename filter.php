<?php
require('admins/functions.php');

// Ambil nilai dari form
$selectedCategory = isset($_POST['category']) ? $_POST['category'] : '';
$selectedColors = isset($_POST['color']) ? $_POST['color'] : array();
$selectedSizes = isset($_POST['size']) ? $_POST['size'] : array();
$searchTerm = $_POST['search'];
$priceRange = $_POST['Price'];

// Buat klausa WHERE berdasarkan filter yang dipilih
$whereClause = '1'; // Kondisi awal untuk memastikan query tetap valid
if (!empty($selectedCategory)) {
  $whereClause .= " AND category = '$selectedCategory'";
}

if (!empty($selectedColors)) {
  $colorConditions = array();
  foreach ($selectedColors as $color) {
    $colorConditions[] = "FIND_IN_SET('$color', color) > 0";
  }
  $colorClause = implode(' OR ', $colorConditions);
  $whereClause .= " AND ($colorClause)";
}

if (!empty($selectedSizes)) {
  $sizeConditions = array();
  foreach ($selectedSizes as $size) {
    $sizeConditions[] = "FIND_IN_SET('$size', size) > 0";
  }
  $sizeClause = implode(' OR ', $sizeConditions);
  $whereClause .= " AND ($sizeClause)";
}

if (!empty($searchTerm)) {
  $whereClause .= " AND (name LIKE '%$searchTerm%')";
}

if (!empty($priceRange)) {
// Peroleh harga minimal dan maksimal dari string
$priceRange = str_replace(array('Rp', ','), '', $priceRange);
$prices = explode('-', $priceRange);
$minPrice = (int) $prices[0];
$maxPrice = (int) $prices[1];
}

// Tambahkan klausa WHERE untuk filter harga minimal dan maksimal
if (!empty($minPrice)) {
  $whereClause .= " AND price >= $minPrice";
}

if (!empty($maxPrice)) {
  $whereClause .= " AND price <= $maxPrice";
}

// Query SQL dengan filter
$query = "SELECT * FROM `product` WHERE $whereClause";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Eksekusi query dan lakukan pengolahan data

if (empty($product)) {
  echo "<p style='color:red;text-decoration: underline;' class='ml-5'>Product yang anda Cari Tidak Ada</p>";
} else {
  foreach ($product as $prd) { 
    echo "<div class='col-sm-6 col-lg-4 mb-4' data-aos='fade-up'>
      <div class='block-4 text-center border'>
        <figure class='block-4-image'>
          <a href='shop-single.php?id=".$prd['id']."'><img src='images/".$prd['gambar']."' alt='Image placeholder' class='img-fluid'></a>
        </figure>
        <div class='block-4-text p-4'>
          <h3><a href='shop-single.php?id=".$prd['id']."'>".$prd['name']."</a></h3>
          <p class='mb-0'>".$prd['short']."</p>
          <p class='text-primary font-weight-bold'>";

    $priceFromDatabase = $prd['price'];
    $formattedPrice = 'Rp ' . number_format($priceFromDatabase, 0, ',', '.');
    echo $formattedPrice;

    echo "</p>
        </div>
      </div>
    </div>";
  }
} 
?>
