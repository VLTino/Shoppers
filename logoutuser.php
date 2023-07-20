<?php 
session_start();


// Hapus session yang ditentukan
if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);
}





header("Location: index.php");
exit;
?>