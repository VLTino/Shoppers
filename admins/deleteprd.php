<?php

require 'functions.php';

$id = $_GET["id"];

if ( deleteprd($id) > 0) {
    echo "<script>
        alert('data berhasil dihapus');
        document.location.href = 'listprd.php';
        </script>";
} else {
    echo "<script>
        alert('data gagal dihapus');
        document.location.href = 'listprd.php';
        </script>";
}

?>