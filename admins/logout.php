<?php 
session_start();


// Hapus session yang ditentukan
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}





header("Location: index.php");
exit;
?>