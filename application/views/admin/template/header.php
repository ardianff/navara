<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NAVARA</title>
  <link rel="shortcut icon" href="<?=base_url('assets/')?>logo/logo.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/')?>plugins/fontawesome-free/css/all.min.css">


  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/')?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/admin/')?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/admin/')?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/')?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/')?>plugins/daterangepicker/daterangepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/admin/')?>dist/css/adminlte.min.css">
  <style type="text/css">
    .jedatombol {
      margin:2px;
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-white" style="background-color:#633d3b;font-weight:bold;">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img style="width:40px;height:30px;" src="<?=base_url('assets/')?>logo/logo.png" alt="Pemkot Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">NAVARA</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?=site_url('dashboard')?>" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('home')?>" class="nav-link">Kendaraan</a>
          </li>
          <?php if ($this->session->userdata('rule')!='pemakai') { ?>
            <li class="nav-item">
              <a href="<?=site_url('rekap')?>" class="nav-link">Rekap Laporan</a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('admin/user')?>" class="nav-link">User</a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('servis')?>" class="nav-link">Detail Service</a>
            </li>
          <?php } ?>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-sign-out-alt"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header" style="font-weight:bold;"><?=$this->session->userdata('rule');?></span>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('home/profile')?>" class="dropdown-item">
              <?=$this->session->userdata('name');?>
            </a>
            <div class="dropdown-divider"></div>
                <a href="<?=site_url('auth/logout')?>" class="dropdown-item dropdown-footer">KELUAR</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
