<?php

require 'rajaongkirdb.php';

$dataprovinsi = query("SELECT * FROM `tb_ro_provinces`");
    
    echo "<option> Pilih Provinsi </option>";

    foreach ($dataprovinsi as $key => $prov) {
      echo "<option value='".$prov["province_id"]."' id_provinsi='".$prov["province_id"]."'>";
      echo $prov["province_name"];
      echo "</option>";
    }
  
  ?>