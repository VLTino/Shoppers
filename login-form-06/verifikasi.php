<?php
require '../admins/functions.php';

global $conn;

$code = $_GET["code"];

if (isset($code)) {
    $query = $conn->query("SELECT * FROM `customer` WHERE code = '$code'");
    $result = $query->fetch_assoc();

    $conn->query("UPDATE `customer` SET `verifikasi`=1 WHERE id='".$result["id"]."' ");
    echo "<script>alert('Verifikasi Berhasil!, Silahkan Login');window.location='index.php'</script>";
}
?>