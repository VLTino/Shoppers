<?php 
require ('functions.php');
// Proses untuk mendapatkan nilai maxPrice dari database atau sumber data lainnya
$minPrice = "SELECT * FROM product ORDER BY price ASC LIMIT 1;
" ;
$result = mysqli_query($conn, $minPrice);

// Ambil data nilai maksimum harga
$minHarga = 0;
if ($row = mysqli_fetch_assoc($result)) {
    $minHarga = $row['price'];
}

// Tutup conn database
mysqli_close($conn);

// Mengirimkan data nilai maksimum harga dalam respons HTTP dengan header JSON
header('Content-Type: application/json');
echo json_encode($minHarga);
?>
