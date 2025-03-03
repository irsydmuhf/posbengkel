<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BengkelKu-Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="/assets/plugins/sweetalert2/sweetalert2.min.css">
    </link>
    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>

    <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="/assets/dist/img/bengkel.png" alt="Bengkel Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">BengkelKu</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Mas Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url('Admin') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= $menu == 'transaksi' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= $menu == 'transaksi' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    Transaksi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('TransaksiMasuk/dataMasuk') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('TransaksiKeluar') ?>" class="nav-link <?= $submenu == 'keluar' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?= $menu == 'masterdata' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= $menu == 'masterdata' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Master Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Part') ?>" class="nav-link <?= $submenu == 'part' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Part</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Jasa') ?>" class="nav-link <?= $submenu == 'jasa' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jasa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Kategori') ?>" class="nav-link <?= $submenu == 'kategori' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Satuan') ?>" class="nav-link <?= $submenu == 'satuan' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Satuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Pelanggan') ?>" class="nav-link <?= $submenu == 'pelanggan' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pelanggan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Supplier') ?>" class="nav-link <?= $submenu == 'supplier' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Supplier</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('User') ?>" class="nav-link <?= $submenu == 'user' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Setting') ?>" class="nav-link <?= $menu == 'setting' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><i class="<?= $icon ?>"></i> <?= $judul ?> <?= $subjudul?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"><?= $judul ?></a></li>
                                <li class="breadcrumb-item active"><?= $subjudul ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- ISI CONTENT -->
                        <?php
                        if ($page) {
                            echo view($page);
                        }
                        ?>
                        <!-- CONTENT SELESAI -->
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <!-- <div class="float-right d-none d-sm-inline">
                Anything you want
            </div> -->
            <!-- Default to the left -->
            <strong>Point of Sale &copy; <a href="https://instagram.com/irsydmuhf/">Irsyad Muhamad Firdaus</a>.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>
    <!-- <script>
        $(document).ready(function() {
            $("#kategori").change(function() {
                var selectedCategory = $("#kategori option:selected").text().toLowerCase();

                if (selectedCategory === "jasa") {
                    $("#harga_beli").hide().val(0).prop("readonly", true); // Harga beli jadi 0 & tidak bisa diedit
                    $("#stok-container").hide(); // Sembunyikan stok
                    $("#satuan-container").hide(); // Sembunyikan stok
                } else {
                    $("#harga_beli").prop("readonly", false); // Bisa diedit
                    $("#stok-container").show(); // Tampilkan stok
                    $("#satuan-container").show(); // Tampilkan stok
                }
            });
        });
    </script> -->
</body>

</html>