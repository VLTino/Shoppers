<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: f39965e7eae6f0ebbcbea6c800553c08"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $array_response = json_decode($response,TRUE);
    $dataprovinsi = $array_response["rajaongkir"]["results"];
    
    echo "<option> Pilih Provinsi </option>";

    foreach ($dataprovinsi as $key => $prov) {
      echo "<option value='".$prov["province_id"]."' id_provinsi='".$prov["province_id"]."'>";
      echo $prov["province"];
      echo "</option>";
    }
  }