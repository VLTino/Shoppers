<?php 
$conn = mysqli_connect("localhost", "root", "", "onlineshop");

function imgplus($data)
{
    global$conn;

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

    $query = "UPDATE `header` SET `header`='$header',`teks`='$teks' WHERE `id`=1;";
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
    mysqli_query($conn,$query);
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
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function deletebnf($id)
{
    global $conn;

    $query = "DELETE FROM `benefit` WHERE `id`=$id;";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function plusctg($data)
{
    global $conn;
    error_reporting(0);
    $gambar = $data["gambar"];
    $category = htmlspecialchars($data["category"]);
    $teks = htmlspecialchars($data["teks"]);
    $link = htmlspecialchars($data["link"]);

    $gambar = img();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO `category` VALUES (NULL,'$gambar','$category','$teks','$link');";
    mysqli_query($conn,$query);
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
    $link = htmlspecialchars($data["link"]);

    $result = mysqli_query($conn, "SELECT `gambar` FROM `category` WHERE `id`= $id");
    $row = mysqli_fetch_assoc($result);
    $gambarlama = $row['gambar'];

    $gambar = imgedit();
    if (!$gambar) {
        $gambar = $gambarlama;
    }

    $query = "UPDATE `category` SET `gambar`='$gambar',`category`='$category',`teks`='$teks',`link`='$link' WHERE `id` = $id";
    mysqli_query($conn,$query);

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

    $gambar = $data["gambar"];
    $nama = htmlspecialchars($data["product"]);
    $short = htmlspecialchars($data["sabout"]);
    $about = $data["about"];
    $price = htmlspecialchars($data["price"]);
    $category = htmlspecialchars($data["category"]);
    $size = $data["size"];


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

    }
}

    $query = "INSERT INTO `product` VALUES (NULL,'$gambar','$nama','$short','$about','$price','$category','$fixcolor','$size');";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function editprd($data)
{
    global $conn;

    $id = $data["id"];
    $gambar = $data["gambar"];
    $nama = htmlspecialchars($data["product"]);
    $short = htmlspecialchars($data["sabout"]);
    $about = $data["about"];
    $price = htmlspecialchars($data["price"]);
    $category = htmlspecialchars($data["category"]);
    $size = $data["size"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["color"])) {
            $selectedColors = $_POST["color"];
    
            // Mengencode array "color" menjadi JSON
            $fixcolor = json_encode($selectedColors);

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

    $query = "UPDATE `product` SET `gambar`='$gambar',`name`='$nama',`short`='$short',`about`='$about',`price`='$price',`category`='$category',`color`='$fixcolor',`size`='$size' WHERE `id` = $id";
    mysqli_query($conn,$query);

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
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}
?>