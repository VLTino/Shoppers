<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';
$id =$_GET["id"];

if (isset($_POST["subresi"])) {
    if (resi($_POST)) {
        echo "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'paid.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal ditambahkan');
        document.location.href = 'paid.php';
        </script>";
    }
}

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        /* CSS untuk membuat div berada di tengah-tengah halaman */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(121,113,234);
        }

        .cooo {
            /* Ganti width dan height sesuai kebutuhan Anda */
            
            background-color: white;
            border-radius: 10px;
            padding: 50px;
            border: 1px solid;
        }

        /* Aturan CSS untuk layar yang lebih kecil dari 700px */
        @media screen and (max-width: 700px) {
            .cooo {
                width: 90%;
            }
        }
        @media screen and (min-width: 700px) {
            .cooo {
                width: 700px;
            }
        }
    </style>
</head>

<body>
    <div class="cooo">
        <form action="" method="post">
            <div class="form-group">
                <label for="resi">No. Resi</label>
                <input type="text" name="resi" class="form-control" id="resi" aria-describedby="emailHelp"
                    placeholder="Masukan Nomor Resi">
            </div>
            <input type="hidden" name="id" id="" value="<?= $id ?>">
            <button name="subresi" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>

