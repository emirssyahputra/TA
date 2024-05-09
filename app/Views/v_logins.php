<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Siswa</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<script>
    $(document).ready(function () {
        <?php if (session()->getFlashdata('error')): ?>
            showNotification('<?php echo session()->getFlashdata('error'); ?>', 'error');
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            showNotification('<?php echo session()->getFlashdata('success'); ?>', 'success');
        <?php endif; ?>

        function showNotification(message, type) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr[type](message);
        }
    });
</script>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h2">SMPN 10 BANDAR LAMPUNG</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login Sebagai Siswa</p>

      <form action="<?php echo site_url('logins/cek'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
      
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?php echo site_url('Lupa'); ?>">Lupa password? Reset password </a>
      </p>
      <p class="mb-0">
        <a href="<?php echo site_url('Register'); ?>" class="text-center">Belum punya akun? Register</a>
      </p>
      <p class="mb-0">
        <a href="<?php echo site_url('Loging'); ?>" class="text-center">Login sebagai guru</a>
      </p>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url().'plugins/jquery/jquery.min.js'?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url().'plugins/bootstrap/js/bootstrap.bundle.min.js'?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url().'js/adminlte.min.js'?>"></script>

</body>
</html>
