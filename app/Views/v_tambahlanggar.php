<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Bimbingan Konseling</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('logins/logout'); ?>" role="button">
                        <i class="fas fa-sign-out-alt">Logout</i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="img/logosmp.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light" style="font-size: 80%;">SMPN 10 Bandar Lampung</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a class="d-block">Emirssyah Putra</a>
                        <a class="d-block">Guru BK</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="<?php echo site_url('Dashboardg');?>" class="nav-link ">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo site_url('datasiswakelas');?>" class="nav-link ">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Data Siswa
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo site_url('datalanggarkelas');?>" class="nav-link active">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Data Pelanggaran
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo site_url('Pengajuan');?>" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Data Guru BK
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('Pengajuan');?>" class="nav-link" style="font-size: 90%;">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    Cetak Riwayat Pelanggaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('Pengajuan');?>" class="nav-link" style="font-size: 90%;">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Daftar Surat Pemanggilan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('Pengajuan');?>" class="nav-link">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>
                                    Import Data Siswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo site_url('Pengajuan');?>" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    Jadwal Bimbingan
                                </p>
                            </a>
                        </li>
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
                            <h1 class="m-0">Tambah Data Pelanggaran Siswa</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Pelanggaran Siswa</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div>
                    <form class="forms-sample" method="post" action="">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Pelanggaran</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" name="pelanggaran"
                                placeholder="Pelanggaran" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Tanggal</label>
                            <input type="Date" class="form-control" name="tanggal" placeholder="Tanggal" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPoin">Poin</label>
                            <div class="password-container">
                                <input type="text" class="form-control" name="poin" placeholder="Poin" value="" required
                                    style="padding-right: 50px;">
                            </div>
                        </div>
                        <a class="btn btn-danger btn-icon-text" href="<?php echo site_url('Dashboard'); ?>">Batal</a>
                        <button type="submit" class="btn btn-warning btn-icon-text">Simpan</button>
                    </form>

                </div>
                <!-- /.container-fluid -->
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>SMPN 10 Bandar Lampung</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?php echo base_url().'plugins/jquery/jquery.min.js'?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url().'plugins/bootstrap/js/bootstrap.bundle.min.js'?>"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'js/adminlte.min.js'?>"></script>


    <!-- OPTIONAL SCRIPTS -->
    <script src="<?php echo base_url().'plugins/chart.js/Chart.min.js'?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().'dist/js/demo.js'?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url().'dist/js/pages/dashboard3.js'?>"></script>
</body>

</html>