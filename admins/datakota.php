<?php

$provinsi_terpilih = $_POST["id_provinsi"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=".$provinsi_terpilih,
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
  $datakota = $array_response["rajaongkir"]["results"];
  
  echo "<option> Pilih Kabupaten/Kota </option>";

  foreach ($datakota as $key => $kota) {
    echo "<option value='' city_id='".$kota["city_id"]."' nama_provinsi='".$kota["province"]."' nama_kota='".$kota["city_name"]."' tipe='".$kota["type"]."' codepost='".$kota["postal_code"]."'>";
    echo $kota["type"]." ";
    echo $kota["city_name"];
    echo "</option>";
  }
}