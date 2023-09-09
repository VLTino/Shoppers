<?php
$conn = mysqli_connect("localhost", "root", "", "onlineshop");

function imgplus($data)
{
    global $conn;

    $gambar = $data["gambar"];

    $gambar = img();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO `imgheader` VALUES (NULL,'$gambar');";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



function register($data)
{

    global $conn;

    $username = stripslashes($data["username"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username

    //cek confirm password
    if ($password !== $password2) {
        echo "<script> 
            alert('Konfirmasi password salah')
            </script>";
        return false;
    }



    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO `admin` VALUES (NULL,'$username','$password')");

    return mysqli_affected_rows($conn);
}

function img()
{

    $namafile = $_FILES['gambar']['name'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
            alert('pilih gambar terlebih dahulu')
            </script>";
        return false;
    }

    // Cek ukuran file
    $ukuran_maksimum = 2 * 1024 * 1024; // 2MB dalam byte
    if ($_FILES['gambar']['size'] > $ukuran_maksimum) {
        echo "<script>
            alert('Ukuran gambar terlalu besar. Maksimum 2MB');
            </script>";
        return false;
    }

    //cek ekstensi
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script>
            alert('yang anda upload bukan gambar')
            </script>";
        return false;
    }
    //generate namafile baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;


    move_uploaded_file($tmpname, '../images/' . $namafilebaru);
    return $namafilebaru;

}

function imgedit()
{
    $namafile = $_FILES['gambar']['name'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        return false;
    }

    // Cek ukuran file
    $ukuran_maksimum = 2 * 1024 * 1024; // 2MB dalam byte
    if ($_FILES['gambar']['size'] > $ukuran_maksimum) {
        echo "<script>
            alert('Ukuran gambar terlalu besar. Maksimum 2MB');
            </script>";
        return false;
    }

    //cek ekstensi
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script>
            alert('yang anda upload bukan gambar')
            </script>";
        return false;
    }
    //generate namafile baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpname, '../images/' . $namafilebaru);
    return $namafilebaru;
}

function edithdr($data)
{
    global $conn;
    error_reporting(0);
    $gambar = $data["gambar"];

    $result = mysqli_query($conn, "SELECT `gambar` FROM `imgheader` WHERE `id`= 1");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $gambar = img();
    if (!$gambar) {
        return false;
    }

    $query = "UPDATE `imgheader` SET `gambar`='$gambar' ";
    mysqli_query($conn, $query);

    if ($gambarlama && $gambarlama != $gambar) {
        $old_file = "../images/$gambarlama";
        if (file_exists($old_file)) {
            unlink($old_file);
        }
    }

    return mysqli_affected_rows($conn);
}

function edittkshdr($data)
{
    global $conn;

    $header = htmlspecialchars($data["header"]);
    $teks = htmlspecialchars($data["teks"]);
    $link = htmlspecialchars($data["link"]);

    $query = "UPDATE `header` SET `header`='$header',`teks`='$teks', `link`='$link' WHERE `id`=1;";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function inpbnf($data)
{
    global $conn;

    $icon = $data["icon"];
    $teks = htmlspecialchars($data["teks"]);
    $header = htmlspecialchars($data["header"]);

    $query = "INSERT INTO `benefit` VALUES (NULL,'$icon','$teks','$header');";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editbnf($data)
{
    global $conn;

    $id = $data["id"];
    $icon = $data["icon"];
    $teks = htmlspecialchars($data["teks"]);
    $header = htmlspecialchars($data["header"]);

    $query = "UPDATE `benefit` SET `icon`='$icon',`teks`='$teks',`header`='$header' WHERE `id`=$id; ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deletebnf($id)
{
    global $conn;

    $query = "DELETE FROM `benefit` WHERE `id`=$id;";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function plusctg($data)
{
    global $conn;
    error_reporting(0);
    $gambar = $data["gambar"];
    $category = htmlspecialchars($data["category"]);
    $teks = htmlspecialchars($data["teks"]);

    $gambar = img();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO `category` VALUES (NULL,'$gambar','$category','$teks');";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editctg($data)
{
    global $conn;
    error_reporting(0);
    $id = $data["id"];
    $gambar = $data["gambar"];
    $category = htmlspecialchars($data["category"]);
    $teks = htmlspecialchars($data["teks"]);

    $result = mysqli_query($conn, "SELECT `gambar` FROM `category` WHERE `id`= $id");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $gambar = imgedit();
    if (!$gambar) {
        $gambar = $gambarlama;
    }

    $query = "UPDATE `category` SET `gambar`='$gambar',`category`='$category',`teks`='$teks' WHERE `id` = $id";
    mysqli_query($conn, $query);

    if ($gambarlama && $gambarlama != $gambar) {
        $old_file = "../images/$gambarlama";
        if (file_exists($old_file)) {
            unlink($old_file);
        }
    }

    return mysqli_affected_rows($conn);
}

function deletectg($id)
{
    global $conn;
    error_reporting(0);
    $result = mysqli_query($conn, "SELECT `gambar` FROM `category` WHERE `id`=$id ");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $old_file = "../images/$gambarlama";
    if (file_exists($old_file)) {
        unlink($old_file);
    }

    $query = "DELETE FROM `category` WHERE `id`=$id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);


}

function plusprd($data)
{
    global $conn;
    error_reporting(0);
    $gambar = $data["gambar"];
    $nama = htmlspecialchars($data["product"]);
    $short = htmlspecialchars($data["sabout"]);
    $about = $data["about"];
    $about = mysqli_real_escape_string($conn, $about);
    $price = htmlspecialchars($data["price"]);
    $category = htmlspecialchars($data["category"]);
    $berat = htmlspecialchars($data["berat"]);



    // Menghapus tanda titik pada angka yang masuk
    $price = str_replace('.', '', $price);

    $gambar = img();
    if (!$gambar) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["color"])) {
            $selectedColors = $_POST["color"];

            // Mengencode array "color" menjadi JSON
            $fixcolor = json_encode($selectedColors);
            $fixcolor = str_replace('[', '', $fixcolor);
            $fixcolor = str_replace(']', '', $fixcolor);
            $fixcolor = str_replace('"', '', $fixcolor);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["size"])) {
            $selectedSizes = $_POST["size"];

            // Mengencode array "size" menjadi JSON
            $fixsize = json_encode($selectedSizes);
            $fixsize = str_replace('[', '', $fixsize);
            $fixsize = str_replace(']', '', $fixsize);
            $fixsize = str_replace('"', '', $fixsize);

        }
    }

    $query = "INSERT INTO `product` VALUES (NULL,'$gambar','$nama','$short','$about','$price','$category','$fixcolor','$fixsize','$berat');";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editprd($data)
{
    global $conn;
    error_reporting(0);
    $id = $data["id"];
    $gambar = $data["gambar"];
    $nama = htmlspecialchars($data["product"]);
    $short = htmlspecialchars($data["sabout"]);
    $about = $data["about"];
    $about = mysqli_real_escape_string($conn, $about);
    $price = htmlspecialchars($data["price"]);
    $category = htmlspecialchars($data["category"]);
    $berat = htmlspecialchars($data["berat"]);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["color"])) {
            $selectedColors = $_POST["color"];

            // Mengencode array "color" menjadi JSON
            $fixcolor = json_encode($selectedColors);
            $fixcolor = str_replace('[', '', $fixcolor);
            $fixcolor = str_replace(']', '', $fixcolor);
            $fixcolor = str_replace('"', '', $fixcolor);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["size"])) {
            $selectedSizes = $_POST["size"];

            // Mengencode array "size" menjadi JSON
            $fixsize = json_encode($selectedSizes);
            $fixsize = str_replace('[', '', $fixsize);
            $fixsize = str_replace(']', '', $fixsize);
            $fixsize = str_replace('"', '', $fixsize);

        }
    }

    // Menghapus tanda titik pada angka yang masuk
    $price = str_replace('.', '', $price);

    $result = mysqli_query($conn, "SELECT `gambar` FROM `product` WHERE `id`= $id");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $gambar = imgedit();
    if (!$gambar) {
        $gambar = $gambarlama;
    }

    $query = "UPDATE `product` SET `gambar`='$gambar',`name`='$nama',`short`='$short',`about`='$about',`price`='$price',`category`='$category',`color`='$fixcolor',`size`='$fixsize',`berat`='$berat    ' WHERE `id` = $id";
    mysqli_query($conn, $query);

    if ($gambarlama && $gambarlama != $gambar) {
        $old_file = "../images/$gambarlama";
        if (file_exists($old_file)) {
            unlink($old_file);
        }
    }

    return mysqli_affected_rows($conn);
}

function deleteprd($id)
{
    global $conn;
    error_reporting(0);
    $result = mysqli_query($conn, "SELECT `gambar` FROM `product` WHERE `id`=$id ");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $old_file = "../images/$gambarlama";
    if (file_exists($old_file)) {
        unlink($old_file);
    }
    $query = "DELETE FROM `product` WHERE `id`=$id;";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function plusclr($data)
{
    global $conn;

    $color = htmlspecialchars($data["name"]);
    $code = $data["color"];

    $query = "INSERT INTO `color` VALUES (NULL,'$color','$code')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editclr($data)
{
    global $conn;

    $id = $data["id"];
    $color = htmlspecialchars($data["name"]);
    $code = $data["color"];

    $query = "UPDATE `color` SET `color`='$color',`codeclr`='$code' WHERE `id`=$id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deleteclr($id)
{
    global $conn;

    $query = "DELETE FROM `color` WHERE `id`=$id;";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function plussize($data)
{
    global $conn;

    $size = htmlspecialchars($data["size"]);

    $query = "INSERT INTO `size` VALUES (NULL,'$size')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deletesz($id)
{
    global $conn;

    $query = "DELETE FROM `size` WHERE `id`=$id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editsize($data)
{
    global $conn;

    $id = $data["id"];
    $size = htmlspecialchars($data["size"]);

    $query = "UPDATE `size` SET `size`='$size' WHERE `id`=$id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editads($data)
{
    global $conn;
    error_reporting(0);
    $header = htmlspecialchars($data["header"]);
    $teks = $data["teks"];
    $link = $data["link"];
    $show = $data["show"];
    $gambar = $data ["gambar"];
    $teks = mysqli_real_escape_string($conn, $teks);

    $result = mysqli_query($conn, "SELECT `gambar` FROM `ads` WHERE `id`= 1");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $gambar = imgedit();
    if (!$gambar) {
        $gambar = $gambarlama;
    }

    $query = "UPDATE `ads` SET `gambar`='$gambar',`header`='$header',`teks`='$teks',`link`='$link',`status`='$show' WHERE `id`=1";
    mysqli_query($conn, $query);

    if ($gambarlama && $gambarlama != $gambar) {
        $old_file = "../images/$gambarlama";
        if (file_exists($old_file)) {
            unlink($old_file);
        }
    }

    return mysqli_affected_rows($conn);

}

function price($data)
{
    global $conn;

    $price = htmlspecialchars($data["price"]);

    $query = "INSERT INTO `price` VALUES (NULL,'$price')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function changepass($data)
{

    global $conn;

    $email = stripslashes($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password1"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek email

    //cek confirm password
    if ($password !== $password2) {
        echo "<script> 
            alert('Konfirmasi password salah')
            </script>";
        return false;
    }



    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE `customer` SET `password` = '$password' WHERE `email`= '$email'");

    return mysqli_affected_rows($conn);
}



function cartplus($data)
{

    global $conn;

    $idcos = $data["id_customer"];
    $idprd = $data["product_id"];
    $jumlah = $data["jumlah"];
    $size = $data['size'];
    $color = $data['color'];


    $query = "INSERT INTO `cart` VALUES (NULL,$idcos,$idprd,$jumlah,'$color','$size')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deletecart($id)
{
    global $conn;

    $query = "DELETE FROM `cart` WHERE `id`=$id;";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function changename($data)
{
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $email = $data["email"];

    $query = "UPDATE `customer` SET `name` = '$name' WHERE `email`='$email'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function changepp($data)
{
    global $conn;
    error_reporting(0);
    $gambar = $data["gambar"];
    $email = $data["email"];

    $result = mysqli_query($conn, "SELECT `pp` FROM `customer` WHERE `email`='$email'");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['pp'];

    $gambar = imgpp();
    if (!$gambar) {
        return false;
    }

    $query = "UPDATE `customer` SET `pp`='$gambar' WHERE `email`='$email'";
    mysqli_query($conn, $query);


    if ($gambarlama && $gambarlama != $gambar) {
        $old_file = "images/$gambarlama";
        if (file_exists($old_file)) {
            unlink($old_file);
        }
    }

    return mysqli_affected_rows($conn);

}

function imgpp()
{

    $namafile = $_FILES['gambar']['name'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
            alert('pilih gambar terlebih dahulu')
            </script>";
        return false;
    }

    // Cek ukuran file
    $ukuran_maksimum = 2 * 1024 * 1024; // 2MB dalam byte
    if ($_FILES['gambar']['size'] > $ukuran_maksimum) {
        echo "<script>
            alert('Ukuran gambar terlalu besar. Maksimum 2MB');
            </script>";
        return false;
    }

    //cek ekstensi
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script>
            alert('yang anda upload bukan gambar')
            </script>";
        return false;
    }
    //generate namafile baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;


    move_uploaded_file($tmpname, 'images/' . $namafilebaru);
    return $namafilebaru;



}

function resi($data)
{
    global $conn;

    $id = $data["id"];
    $resi = $data["resi"];

    $query = "UPDATE `orders` SET `resi` = '$resi', `status` = 'dikirim' WHERE `id` = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function aboutad($data)
{
    global $conn;

    $video = $data["video"];
    $teks = $data["teks"];
    $teks = mysqli_real_escape_string($conn, $teks);

    $query = "UPDATE `about` SET `video` ='$video' , `teks` = '$teks' WHERE `id` = 1";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function storelc($data)
{
    global $conn;

    $provinsi = $data["provinsi"];
    $kota = $data["kota"];
    $kecamatan = $data["kecamatan"];
    $id_city = $data["id_city"];

    $query = "UPDATE `storelocation` SET `provinsi` = '$provinsi' , `kabupaten`='$kota' , `kecamatan`='$kecamatan' , `id_kota`='$id_city'  WHERE `id` = 1";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function konfirmasi($data)
{
    global $conn;

    $id = $data["orderid"];
    $status = "sampai";

    $query = "UPDATE `orders` SET `status` = '$status'  WHERE `id` = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ulas($data)
{
    global $conn;

    $idpr = $data["idprd"];
    $idus = $data["iduser"];
    $teks = htmlspecialchars($data["teks"]);
    $rating = $data["rating"];
    $tanggal = $data["tanggal"];

    $query = "INSERT INTO `ulasan` VALUES (NULL,$idus,$idpr,'$teks',$rating,'$tanggal')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function addteam($data)
{
    global $conn;
    error_reporting(0);
    $gambar = $data["gambar"];
    $name = htmlspecialchars($data["name"]);
    $as = htmlspecialchars($data["as"]);
    $about = $data["about"];
    $about = mysqli_real_escape_string($conn, $about);

    $gambar = img();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO `team` VALUES (NULL,'$gambar','$name','$as','$about')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function deletetm($id)
{
    global $conn;
    error_reporting(0);
    $result = mysqli_query($conn, "SELECT `gambar` FROM `team` WHERE `id`=$id ");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $old_file = "../images/$gambarlama";
    if (file_exists($old_file)) {
        unlink($old_file);
    }
    $query = "DELETE FROM `team` WHERE `id`=$id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edittm($data)
{

    global $conn;
    error_reporting(0);
    $gambar = $data["gambar"];
    $name = htmlspecialchars($data["name"]);
    $as = htmlspecialchars($data["as"]);
    $about = $data["about"];
    $id = $data["id"];
    $about = mysqli_real_escape_string($conn, $about);


    $result = mysqli_query($conn, "SELECT `gambar` FROM `team` WHERE `id`= $id");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $gambar = imgedit();
    if (!$gambar) {
        $gambar = $gambarlama;
    }

    $query = "UPDATE `team` SET `gambar`='$gambar',`name`='$name',`sebagai`='$as',`teks`='$about' WHERE `id` = $id";
    mysqli_query($conn, $query);

    if ($gambarlama && $gambarlama != $gambar) {
        $old_file = "../images/$gambarlama";
        if (file_exists($old_file)) {
            unlink($old_file);
        }
    }

    return mysqli_affected_rows($conn);
}

function contact($data)
{
    global $conn;
    $alamat = htmlspecialchars($data["alamattoko"]);
    $phone = htmlspecialchars($data["phone"]);
    $email = htmlspecialchars($data["email"]);

    $query = "UPDATE `contact` SET `alamat` = '$alamat', `phone` = '$phone', `email` = '$email' WHEER `id` = 1";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function changegender($data)
{
    global $conn;

    $email = $data["email"];
    $gender = $data["gender"];

    $query = "UPDATE `customer` SET `gender` = '$gender' WHERE `email`= '$email'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function theme($data)
{
    global $conn;
    $colorp = $data["colorp"];
    $colors = $data["colors"];
    $fontpr = $data["fontpr"];
    $fontse = $data["fontse"];

    $query = "UPDATE `colortheme` SET `colorp` = '$colorp', `colors` = '$colors', `fontpr` = '$fontpr', `fontse` = '$fontse' WHERE `id` = 1";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function strname($data)
{
    global $conn;

    $name = htmlentities($data["name"]);
    $fontstr = $data["fontstr"];

    $query = "UPDATE `storename` SET `name` = '$name', `fontstr` = '$fontstr' WHERE `id` = 1";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>