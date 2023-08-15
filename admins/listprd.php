<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

$orders = query("SELECT * FROM `orders` ORDER BY `id` DESC LIMIT 3");
$category = query("SELECT * FROM `category`");
$size = query("SELECT * FROM `size`");
$color = query("SELECT * FROM `color`");

if (isset($_POST["prd"])) {
    if (plusctg($_POST)) {
        echo "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'product.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal ditambahkan');
        document.location.href = 'product.php';
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


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
            <li class="nav-item">
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
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-shopping-bag"></i>
                    <span>Product</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Section:</h6>
                        <a class="collapse-item active" href="listprd.php">List Product</a>
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
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionSidebar">
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
                            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." 
                                aria-label="Search" aria-describedby="basic-addon2">
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
                        <h1 class="h3 mb-0 text-gray-800">Category</h1>
                    </div>
                    <h5>List Product</h5>

                    <form action="" method="post">
                        Category 
                        <select class="form-control" aria-label="Default select example" name="category">
        <option value="none" <?= (isset($_POST['category']) && $_POST['category'] === 'none') ? 'selected' : ''; ?>>none</option>
        <?php foreach ($category as $ctg):?>
            <option value="<?= $ctg["category"]; ?>" <?= (isset($_POST['category']) && $_POST['category'] === $ctg["category"]) ? 'selected' : ''; ?>><?= $ctg["category"]; ?></option>
        <?php endforeach; ?>
    </select><br>
                            Color <br>
                            <?php foreach ($color as $clr):?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="color[]" id="<?= $clr["color"]; ?>" value="<?= $clr["color"]; ?>" <?= isset($_POST['color']) && in_array($clr["color"],$_POST['color']) ? 'checked' : '';?>>
                                <label class="form-check-label" for="<?= $clr["color"]; ?>"><?= $clr["color"]; ?></label>
                            </div>
                            <?php endforeach; ?>
                            <br>
                            Size <br>
                            <?php foreach ($size as $sz):?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="size[]" id="<?= $sz["size"]; ?>" value="<?= $sz["size"]; ?>"
                                <?= isset($_POST['size']) && in_array($sz["size"],$_POST['size']) ? 'checked' : '';?>>
                                <label class="form-check-label" for="<?= $sz["size"]; ?>"><?= $sz["size"]; ?></label>
                            </div>
                            <?php endforeach; ?><br>
                            Search <br>
    <input type="text" name="search" class="form-control"><br>
                            <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                    </form>
                    <?php
// Periksa apakah form dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter'])) {
    // Ambil nilai dari form
    $selectedCategory = $_POST['category'];
    $selectedColors = isset($_POST['color']) ? $_POST['color'] : array();
    $selectedSizes = isset($_POST['size']) ? $_POST['size'] : array();
    $searchTerm = $_POST['search'];

    // Buat klausa WHERE berdasarkan filter yang dipilih
    $whereClause = '1 = 1'; // Kondisi awal untuk memastikan query tetap valid
    if ($selectedCategory !== 'none') {
        $whereClause .= " AND category = '$selectedCategory'";
    }

    if (!empty($selectedColors)) {
        $colorConditions = array();
        foreach ($selectedColors as $color) {
            $colorConditions[] = "FIND_IN_SET('$color', color) > 0";
        }
        $colorClause = implode(' OR ', $colorConditions);
        $whereClause .= " AND ($colorClause)";
    }

    if (!empty($selectedSizes)) {
        $sizeConditions = array();
        foreach ($selectedSizes as $size) {
            $sizeConditions[] = "FIND_IN_SET('$size', size) > 0";
        }
        $sizeClause = implode(' OR ', $sizeConditions);
        $whereClause .= " AND ($sizeClause)";
    }

    if (!empty($searchTerm)) {
        $whereClause .= " AND (name LIKE '%$searchTerm%')";
    }    

    // Query SQL dengan filter
    $query = "SELECT * FROM `product` WHERE $whereClause";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Eksekusi query dan lakukan pengolahan data
    
    // ...
}

if (!isset($_POST['filter'])) {
    $query = "SELECT * FROM `product` WHERE 1=1";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>



                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Short</th>
                                <th scope="col">About Product</th>
                                <th scope="col">Category</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Berat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($product as $prd): ?>
                                <tr>
                                    <td>
                                        <?= $i++; ?>
                                    </td>
                                    <td><img src="../images/<?= $prd["gambar"]; ?>" alt="" srcset="" style="width:200px;">
                                    </td>
                                    <td>
                                        <?= $prd["name"]; ?>
                                    </td>
                                    <td>
                                        <?php $priceFromDatabase = $prd["price"];
                                        $formattedPrice = "Rp " . number_format($priceFromDatabase, 0, ',', '.');
                                        echo $formattedPrice; ?>
                                    </td>
                                    <td>
                                        <?= $prd["short"]; ?>
                                    </td>
                                    <td>
                                        Hidden
                                    </td>
                                    <td>
                                        <?= $prd["category"]; ?>
                                    </td>
                                    <td>
                                        <?= $prd["color"]; ?>
                                    </td>
                                    <td>
                                        <?= $prd["size"]; ?>
                                    </td>
                                    <td>
                                        <?= $prd["berat"]; ?>
                                    </td>
                                    <td>
                                    <a href="editprd.php?id=<?= $prd["id"];?>" class="btn-circle btn-success btn-sm"><i
                                                class="fas fa-pen"></i></a>
                                        <a onclick="return confirm('Apakah kamu yakin ingin mengapus ini?')" href="deleteprd.php?id=<?= $prd["id"];?>" class="btn-circle btn-danger btn-sm"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; VLTino 2021</span>
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