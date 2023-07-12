<?php

$provinsi_terpilih = $_POST["id_provinsi"];
require 'rajaongkirdb.php';

$namaprovinsi = query("SELECT `province_name` FROM `tb_ro_provinces` WHERE `province_id`= $provinsi_terpilih ");
$datakota = query("SELECT * FROM `tb_ro_cities` WHERE `province_id`= $provinsi_terpilih");
  
  echo "<option> Pilih Kabupaten/Kota </option>";

  foreach ($datakota as $key => $kota) {
    echo "<option value='' city_id='".$kota["city_id"]."' nama_provinsi='".$namaprovinsi."' nama_kota='".$kota["city_name"]."' codepost='".$kota["postal_code"]."'>";
    echo $kota["city_name"];
    echo "</option>";
  }
?>