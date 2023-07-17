<?php 
$array1 = [1, 2, 3];
$array2 = ['A', 'B', 'C'];

// Menggabungkan dua array menjadi satu array asosiatif
$combinedArray = array_combine($array1, $array2);

// Melakukan foreach pada array yang telah digabungkan
foreach ($combinedArray as $key => $value) {
    echo "Key: " . $key . ", Value: " . $value . "\n";
}

?>