<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST["sbmc1"])) {
    if (inpbnf($_POST)) {
        echo "<script>
        alert('data berhasil ditambah');
        document.location.href = 'benefit.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal ditambah');
        document.location.href = 'benefit.php';
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

    <title>Admin - LandingPage</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vanilla-icon-picker-main/www/icon-picker.css">
    <!-- Icon picker themes -->
    <link rel="stylesheet" href="vanilla-icon-picker-main/dist/themes/default.min.css">
    <link rel="stylesheet" href="vanilla-icon-picker-main/dist/themes/bootstrap-5.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
            <li class="nav-item">
                <a class="nav-link" href="admins.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Homepage</span>
                </a>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Section:</h6>
                        <a class="collapse-item" href="header.php">Header</a>
                        <a class="collapse-item active" href="benefit.php">Benefit</a>
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


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
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
                    <h3>Input Content-1/Masalah</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            Icon
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="icon-picker" class="form-label">Choose icon</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"></span>
                                            <input type="text" id="icon-picker" class="form-control" name="icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            Header
                            <input type="text" name="header" id="" class="form-control" required><br>
                            Teks
                            <input type="text" name="teks" id="" class="form-control" required><br>
                            <button type="submit" name="sbmc1" class="btn btn-primary">Submit</button>
                        </div>
                    </form>




                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white col-12">
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

        <script src="vanilla-icon-picker-main/dist/icon-picker.min.js"></script>
        <script src="vanilla-icon-picker-main/www/index.js"></script>

</body>

</html>