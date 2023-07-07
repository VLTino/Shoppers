<?php 
require('admins/functions.php');
// Mendapatkan nilai filter dari permintaan POST
$category = $_POST['category'];
$Price = $_POST['Price'];
$color = isset($_POST['color']) ? $_POST['color'] : array();
$size = isset($_POST['size']) ? $_POST['size'] : array();

// Membangun kueri SQL berdasarkan filter yang dipilih
$sql = "SELECT * FROM product WHERE 1=1";
$categoryString = !empty($category) ? implode("','", $category) : '';
  var_dump($category);
if ($category != '0') {
    $categoryString = "'" . implode("','", $category) . "'";
    $sql .= " AND category IN ($categoryString)";
}else {
    $sql = "SELECT * FROM product WHERE 1=1";
}
  
if (!empty($Price)) {
    $priceRange = explode(" - ", $Price);
    $minPrice = intval(str_replace(array('Rp', ','), '', $priceRange[0]));
    $maxPrice = intval(str_replace(array('Rp', ','), '', $priceRange[1]));
    $sql .= " AND price >= $minPrice AND price <= $maxPrice";
}


  
if (!empty($color)) {
    $colorString = "'" . implode("','", $color) . "'";
    $sql .= " AND color IN ($colorString)";
}
  
if (!empty($size)) {
    $sizeString = "'" . implode("','", $size) . "'";
    $sql .= " AND size IN ($sizeString)";
}
  
// Menjalankan kueri SQL dan menghasilkan tampilan produk
$result = $conn->query($sql);
echo $sql;


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-sm-6 col-lg-4 mb-4' data-aos='fade-up'>
                <div class='block-4 text-center border'>
                  <figure class='block-4-image'>
                    <a href='shop-single.php'><img src='images/" . $row['gambar'] . "' alt='Image placeholder' class='img-fluid'></a>
                  </figure>
                  <div class='block-4-text p-4'>
                    <h3><a href='shop-single.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></h3>
                    <p class='mb-0'>" . $row['short'] . "</p>
                    <p class='text-primary font-weight-bold'>";

        $priceFromDatabase = $row['price'];
        $formattedPrice = 'Rp ' . number_format($priceFromDatabase, 0, ',', '.');
        echo $formattedPrice;

        echo "</p>
                  </div>
                </div>
              </div>";
    }
} else {
    echo "<p style='color:red;text-decoration: underline;' class='ml-5'>Product yang anda Cari Tidak Ada</p>";
    echo $sql;
}
$conn->close();
?>
