<?php

$kota_terpilih = $_POST["id_kota"];
require 'rajaongkirdb.php';


$datakecamatan = query("SELECT * FROM `tb_ro_subdistricts` WHERE `city_id`= $kota_terpilih");
  
  echo "<option> Pilih Kecamatan </option>";

  foreach ($datakecamatan as $key => $kecamatan) {
    echo "<option value='' nama_kecamatan='".$kecamatan["subdistrict_name"]."'>";
    echo $kecamatan["subdistrict_name"];
    echo "</option>";
  }
?>