<?php 
require ('functions.php');
// Proses untuk mendapatkan nilai maxPrice dari database atau sumber data lainnya
$maxPrice = "SELECT * FROM product ORDER BY price DESC LIMIT 1;
" ;
$result = mysqli_query($conn, $maxPrice);

// Ambil data nilai maksimum harga
$maxHarga = 0;
if ($row = mysqli_fetch_assoc($result)) {
    $maxHarga = $row['price'];
}

// Tutup conn database
mysqli_close($conn);

// Mengirimkan data nilai maksimum harga dalam respons HTTP dengan header JSON
header('Content-Type: application/json');
echo json_encode($maxHarga);
?>
