<?php
if (isset($_GET["status"])) {
  $status = $_GET["status"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <button onclick="window.location='tes.php'">All</button>
  <button onclick="window.location='tes.php?status=bayar'">bayar</button>
  <?php if (isset($status)) {
   echo $status; 
  } ?>  

</body>
</html>
