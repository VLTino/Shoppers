<?php

require 'functions.php';

$id = $_GET["id_cart"];

if ( deletecart($id) > 0) {
    header("Location: ../cart.php");
    exit(); 
} else {
    echo "<script>
        alert('data gagal dihapus');
        document.location.href = '../cart.php';
        </script>";
}

?>