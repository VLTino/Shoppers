<?php
require '../admins/functions.php';


// Query untuk mengambil warna dari database
$colorp = "SELECT colorp FROM colortheme WHERE id = 1"; // Sesuaikan dengan query Anda
$colors = "SELECT colors FROM colortheme WHERE id = 1"; // Sesuaikan dengan query Anda

$resultcolorp = $conn->query($colorp);

if ($resultcolorp->num_rows > 0) {
    $row = $resultcolorp->fetch_assoc();
    $colorp = $row["colorp"];
}

$resultcolors = $conn->query($colors);

if ($resultcolors->num_rows > 0) {
    $row = $resultcolors->fetch_assoc();
    $colors = $row["colors"];
}


// Set header untuk CSS
header("Content-type: text/css");
?>
input[type="checkbox"] {
accent-color: <?php echo $colorp; ?>;
}

input[type="radio"] {
accent-color: <?php echo $colorp; ?>;
}

.form-control:active, .form-control:focus {
    border-color: <?php echo $colorp; ?>;
}


a {
    color: <?php echo $colorp; ?>;
}

a:hover {
    color: <?php echo $colorp; ?>;
}

.text-primaryc {
    color: <?php echo $colorp; ?>;
}

.site-navbar .site-top-icons ul li a.site-cart .count {
    color: <?php echo $colors; ?>;
    background: <?php echo $colorp; ?>;
}

.btn-primary {
    color: <?php echo $colors; ?>;
    background-color: <?php echo $colorp; ?>;
    border-color: <?php echo $colorp; ?>;
}

.btn-primary:hover {
    color: <?php echo $colors; ?>;
    background-color: <?php echo $colorp; ?>;
    border-color: <?php echo $colorp; ?>;
}

.site-blocks-1 .icon span {
    color:<?php echo $colorp; ?>;
}

.site-section-heading.text-center:before {
    background-color: <?php echo $colorp; ?>;
}

.block-5 ul li:before {
    color:<?php echo $colorp; ?>;
}

.site-navbar .site-navigation .site-menu .active > a {
    color: <?php echo $colorp; ?>; 
}

.site-section-heading:before {
    background:<?php echo $colorp; ?>;
}  

.category {
    color:<?php echo $colorp; ?>;
}

.site-block-27 ul li.active a, .site-block-27 ul li.active span {
    color: <?php echo $colors; ?>;
    background: <?php echo $colorp; ?>;
}

#slider-range .ui-slider-range {
    background-color: <?php echo $colorp; ?>; 
}

#slider-range .ui-slider-handle {
    background: <?php echo $colorp; ?>;
}

.border-primaryc {
    border-color:<?php echo $colorp; ?>!important;
}

.site-mobile-menu .site-nav-wrap li.active > a {
    color: <?php echo $colorp; ?>;
}

.site-mobile-menu .site-nav-wrap a:hover {
    color: <?php echo $colorp; ?>; 
}

.site-navbar .site-navigation .site-menu > li > a:hover {
    color: <?php echo $colorp; ?>; 
}


.custom-button {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: <?php echo $colorp; ?>;
    border-radius: 4px;
    color: <?php echo $colors; ?>;
}

.btn-outline-primary {
    color: <?php echo $colorp; ?>;
    background-color: transparent;
    background-image: none;
    border-color: <?php echo $colorp; ?>;
}

.btn-outline-primary:hover {
    color: white;
    background-color: <?php echo $colorp; ?>;
    background-image: none;
    border-color: <?php echo $colorp; ?>;
}