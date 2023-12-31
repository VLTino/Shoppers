<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

$store = query("SELECT * FROM `storename`");
$orders = query("SELECT * FROM `orders` ORDER BY `id` DESC LIMIT 3");
$colorp = "SELECT colorp FROM colortheme WHERE id = 1"; // Sesuaikan dengan query Anda
$colors = "SELECT colors FROM colortheme WHERE id = 1"; // Sesuaikan dengan query Anda
$fontpr = "SELECT fontpr FROM colortheme WHERE id = 1"; // Sesuaikan dengan query Anda
$fontse = "SELECT fontse FROM colortheme WHERE id = 1"; // Sesuaikan dengan query Anda

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

$resultfontse = $conn->query($fontse);

if ($resultfontse->num_rows > 0) {
    $row = $resultfontse->fetch_assoc();
    $fontse = $row["fontse"];
}

$resultfontpr = $conn->query($fontpr);

if ($resultfontpr->num_rows > 0) {
    $row = $resultfontpr->fetch_assoc();
    $fontpr = $row["fontpr"];
}

if (isset($_POST["theme"])) {
    if (theme($_POST)) {
        echo "<script>
        alert('data berhasil diedit');
        document.location.href = 'admins.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal diedit');
        document.location.href = 'admins.php';
        </script>";
    }
}

if (isset($_POST["strname"])) {
    if (strname($_POST)) {
        echo "<script>
        alert('data berhasil diedit');
        document.location.href = 'admins.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal diedit');
        document.location.href = 'admins.php';
        </script>";
    }
}

$fonts = array(
    "Phudu",
    "Roboto",
    "Open Sans",
    "ADLaM Display",
    "Black Ops One",
    "Qwitcher Grypen",
    "Roboto Slab",
    "Dancing Script",
    "Pacifico",
    "Yellowtail",
    "Lobster",
    "PT Serif",
    "Nunito",
    "Mukta"
);

?>
<?php
// Inisialisasi tanggal awal dan akhir dengan nilai default atau nilai dari input
// Hitung tanggal 7 hari sebelum sekarang
$defaultStartDate = date('Y-m-d', strtotime('-7 days'));
$defaultEndDate = date('Y-m-d');

// Set tanggal awal dan akhir dengan nilai default
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : $defaultStartDate;
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : $defaultEndDate;


// Ubah format tanggal sesuai dengan format yang diinginkan (YYYY-MM-DD)
$startDate = date('Y-m-d', strtotime($startDate));
$endDate = date('Y-m-d', strtotime($endDate));


// Query untuk mengambil data penjualan per hari dalam rentang tanggal yang diinginkan
$query = "SELECT DATE(order_date) AS tanggal, COUNT(*) AS jumlah_pesanan, SUM(orders_total) AS total_uang 
          FROM orders 
          WHERE status NOT IN ('unpaid', 'expired') 
          AND DATE(order_date) BETWEEN '$startDate' AND '$endDate'
          GROUP BY DATE(order_date)";

$result = mysqli_query($conn, $query);

// Buat array asosiatif untuk menyimpan jumlah pesanan per hari
// Buat array asosiatif untuk menyimpan jumlah pesanan, total uang, dan tanggal
$data = array();

// Inisialisasi tanggal awal dan akhir
$currentDate = new DateTime($startDate);
$endDateObj = new DateTime($endDate);

while ($currentDate <= $endDateObj) {
    $tanggal = $currentDate->format('Y-m-d');
    
    // Inisialisasi jumlah pesanan dan total uang menjadi 0
    $jumlah_pesanan = 0;
    $total_uang = 0;
    
    // Cek apakah tanggal ini ada dalam hasil query
    foreach ($result as $row) {
        if ($row['tanggal'] == $tanggal) {
            $jumlah_pesanan = $row['jumlah_pesanan'];
            $total_uang = $row['total_uang'];
            break;
        }
    }
    
    // Tambahkan tanggal, jumlah pesanan, dan total uang ke dalam array data
    $data[] = array('tanggal' => $tanggal, 'jumlah_pesanan' => $jumlah_pesanan, 'total_uang' => $total_uang);
    
    // Tambahkan 1 hari ke tanggal awal
    $currentDate->modify('+1 day');
}

// Hitung total pesanan dan total uang dari hasil query
$totalPesanan = array_sum(array_column($data, 'jumlah_pesanan'));
$totalUang = array_sum(array_column($data, 'total_uang'));

// Tutup koneksi database
mysqli_close($conn);

// Ubah data menjadi format JSON
$json_data = json_encode($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VLT Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="spectrum/dist/spectrum.css">
    <link rel="stylesheet" type="text/css" href="spectrum/docs/docs.css">
    <link rel="stylesheet" type="text/css" href="spectrum/docs/highlight/styles/default.css">
    <link rel="stylesheet" type="text/css" href="spectrum/docs/highlight/styles/monokai-sublime.css">
    <script type="text/javascript" src="spectrum/docs/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="spectrum/dist/spectrum.js"></script>
    <script type='text/javascript' src='spectrum/docs/toc.js'></script>
    <script type='text/javascript' src='spectrum/docs/docs.js'></script>
    <script type='text/javascript' src='spectrum/docs/highlight/highlight.pack.js'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&family=Black+Ops+One&family=Dancing+Script&family=Lobster&family=Open+Sans&family=PT+Serif&family=Pacifico&family=Phudu&family=Qwitcher+Grypen&family=Roboto&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">VLT Admin <sup>77</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admins.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Homepage</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Section:</h6>
                        <a class="collapse-item" href="header.php">Header</a>
                        <a class="collapse-item" href="benefit.php">Benefit</a>
                        <a class="collapse-item" href="ads.php">Ads</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
                    aria-controls="collapseFour">
                    <i class="fas fa-fw fa-book"></i>
                    <span>About</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Section:</h6>
                        <a class="collapse-item" href="aboutad.php">Edit About</a>
                        <a class="collapse-item" href="listteam.php">List Team</a>
                        <a class="collapse-item" href="addteam.php">Add Team</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-shopping-bag"></i>
                    <span>Product</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Section:</h6>
                        <a class="collapse-item" href="listprd.php">List Product</a>
                        <a class="collapse-item" href="product.php">Add Product</a>
                        <a class="collapse-item" href="category.php">Category</a>
                        <a class="collapse-item" href="color.php">Color</a>
                        <a class="collapse-item" href="size.php">Size</a>

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
                    aria-controls="collapseThree">
                    <i class="fas fa-fw fa-coins"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Section:</h6>
                        <a class="collapse-item" href="unpaid.php">Belum Dibayar</a>
                        <a class="collapse-item" href="paid.php">Dibayar</a>
                        <a class="collapse-item" href="send.php">Dikirim</a>
                        <a class="collapse-item" href="done.php">Selesai</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-fw fa-phone"></i>
                    <span>Contact</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="store.php">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Store Location</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form method="post" action="listprd.php"
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="hidden" name="category" id="" value="none">
                            <input type="text" name="search" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="filter">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                       <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php foreach ($orders as $ord): ?>
                                <a class="dropdown-item d-flex align-items-center" href="invoicead.php?id=<?= $ord["id"] ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-shopping-bag text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?= $ord["order_date"] ?></div>
                                        <span class="font-weight-bold">Order by <?= $ord["firstname"]." ".$ord["lastname"] ?></span>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                                
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h1 class="font-weight-bold text-center" style="color:black;">Selamat Datang Admin!</h1>
                        </div>
                    </div>

                      <!-- Form untuk memilih tanggal awal dan akhir -->
    <form method="POST" action="">
        <label for="start_date">Tanggal Awal:</label>
        <input type="date" id="start_date" name="start_date" value="<?php echo $startDate; ?>">

        <label for="end_date">Tanggal Akhir:</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo $endDate; ?>">

        <input type="submit" value="Tampilkan Grafik">
    </form>
    <div>
    <?php
    // Format total uang ke dalam Rupiah
    $formattedTotalUang = number_format($totalUang, 0, ',', '.'); // 0 desimal, koma sebagai pemisah ribuan, titik sebagai pemisah desimal

    // Tampilkan total pesanan dan total uang dalam format Rupiah
    echo '<h2 style="color:black;">Total Pesanan: ' . $totalPesanan . '</h2>';
    echo '<h2 style="color:black;">Total Uang: Rp ' . $formattedTotalUang . '</h2>';
    ?>
</div>
    <!-- Buat elemen untuk grafik -->
    <canvas id="myChart"></canvas>

    <script>
        // Ambil data dari PHP dan ubah menjadi variabel JavaScript
        // Ambil data dari PHP dan ubah format tanggal menjadi "dd/mm/yyyy"
var salesData = <?php echo json_encode(array_map(function($row) {
    return [
        'tanggal' => date('d/m/y', strtotime($row['tanggal'])),
        'jumlah_pesanan' => $row['jumlah_pesanan']
    ];
}, $data)); ?>;


        // Siapkan label tanggal dan jumlah pesanan
        var labels = [];
        var totalSales = [];

        for (var i = 0; i < salesData.length; i++) {
            labels.push(salesData[i].tanggal);
            totalSales.push(salesData[i].jumlah_pesanan);
        }

        // Buat grafik
// Temukan jumlah pesanan terbanyak
var maxPesanan = Math.max.apply(Math, totalSales);

// Menambahkan 5 untuk memberikan ruang kosong di bagian atas grafik
var suggestedMax = maxPesanan + 7;

// Buat grafik
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line', // Jenis grafik (line chart)
    data: {
        labels: labels, // Label sumbu X (tanggal)
        datasets: [{
            label: 'Jumlah Pesanan',
            data: totalSales, // Data jumlah pesanan
            backgroundColor: '#4e73df', // Warna area grafik
            borderColor: '#4e73df', // Warna garis grafik
            borderWidth: 3 // Lebar garis grafik
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                suggestedMax: suggestedMax, // Mengatur nilai maksimum sesuai dengan jumlah pesanan terbanyak
                precision: 0, // Mengatur angka desimal pada label sumbu Y menjadi 0
                stepSize: 1 // Mengatur interval langkah sumbu Y menjadi 1
            }
        }
    }
});


    </script>

                    <div class="shopname mb-5 mt-5">
                        <h3>Store</h3>
                        <?php foreach ($store as $str): ?>
                        <form action="" method="post">
                        <div class="form-group">
                            Store Name <br>
                            <input type="text" name="name" id="" class="form-control" value="<?= $str["name"]; ?>">
                            Font <br>
                            <select class="form-control" name="fontstr">
                                <?php foreach ($fonts as $font): ?>
                                    <option value="<?php echo $font; ?>" style="font-family:<?php echo $font; ?>" <?php if ($font == $str["fontstr"]) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary m-0" name="strname">Edit</button>
                        </form>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="setting">
                        <h3>Theme</h3>

                        <form action="" method="post">
                        Color Primary <br>
                            <input id="colorpicker" name="colorp" type="text" value="<?= $colorp; ?>" /><br>
                            <script>
                                $("#colorpicker").spectrum({
                                    color: ""
                                });
                            </script>
                        Color Secondary <br>
                            <input id="colorpicker2" name="colors" type="text" value="<?= $colors; ?>"/><br>
                            <script>
                                $("#colorpicker2").spectrum({
                                    color: ""
                                });
                            </script>
                            <div class="form-group">
                                Font Primary
                                <select class="form-control" name="fontpr">
                            <?php foreach ($fonts as $font): ?>
                                <option value="<?php echo $font; ?>" style="font-family:<?php echo $font; ?>" <?php if ($font == $fontpr) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                Font Secondary
                                <select class="form-control" name="fontse">
                                    <?php foreach ($fonts as $font): ?>
                                        <option value="<?php echo $font; ?>" style="font-family:<?php echo $font; ?>" <?php if ($font == $fontse) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" name="theme" class="btn btn-primary m-0">Set</button>
                        </form>
                    </div>

                    <!-- Content Row -->

                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>