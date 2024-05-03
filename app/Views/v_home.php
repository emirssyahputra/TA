<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
================================================== -->
  <meta charset="utf-8">
  <title>SMPN 10 Bandar Lampung</title>

  <!-- Mobile Specific Metas
================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

  <!-- Favicon
================================================== -->
  <link rel="icon" type="image/png" href="img/logosmp.png">

  <!-- CSS
================================================== -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?= base_url('plugins/bs/bootstrap.min.css'); ?>">
   <!-- FontAwesome -->
   <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Animation -->
  <link rel="stylesheet" href="<?= base_url('plugins/animate-css/animate.css'); ?>">
  <!-- slick Carousel -->
  <link rel="stylesheet" href="<?= base_url('plugins/slick/slick.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('plugins/slick/slick-theme.css'); ?>">
  <!-- Colorbox -->
  <link rel="stylesheet" href="<?= base_url('plugins/colorbox/colorbox.css'); ?>">
  <!-- Template styles-->
  <link rel="stylesheet" href="<?= base_url('css/home.css'); ?>">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.accordion-button').click(function() {
        var thisButton = $(this);
        var targetCollapse = $(this).attr('data-bs-target');

        $('.accordion-button').not(thisButton).addClass('collapsed');
        $('.collapse').not(targetCollapse).removeClass('show');

        thisButton.toggleClass('collapsed');
        $(targetCollapse).toggleClass('show');
      });
    });
  </script>

</head>
<body>
  <div class="body-inner">

    <div id="top-bar" class="top-bar">
        
    </div>

<!-- Header start -->
<header id="header" class="header-web">
  <div class="site-navigation">
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                
                <div class="logo">
                    <a class="d-block" href="<?php echo site_url('/');?>">
                      <img loading="lazy" src="<?= base_url('img/logosmp.png'); ?>">
                      <span>SMPN 10 Bandar Lampung</span>
                    </a>
                </div><!-- logo end -->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div id="navbar-collapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav ml-auto align-items-center">
                      <li class="header-get-a-quote">
                          <a class="btn btn-primary" href="<?php echo site_url('Logins');?>">LOGIN</a>
                      </li>
                    </ul>
                </div>
              </nav>
          </div>
          <!--/ Col end -->
        </div>
        <!--/ Row end -->
    </div>
    <!--/ Container end -->

  </div>
  <!--/ Navigation end -->
</header>
<!--/ Header end -->

<div class="banner-carousel banner-carousel-1 mb-0">
  <div class="banner-carousel-item" style="background-image:url(img/slider-main/Home.jpg)">
    <div class="slider-content text-right">
    </div>
  </div>

  <div class="banner-carousel-item" style="background-image:url(img/slider-main/Home.jpg)">
    <div class="slider-content text-right">
    </div>
  </div>

  <div class="banner-carousel-item" style="background-image:url(img/slider-main/Home.jpg)">
    <div class="slider-content text-right">
    </div>
  </div>
</div>

  <!-- Javascript Files
  ================================================== -->
  <!-- initialize jQuery Library -->
  <script src="<?php echo base_url().'plugins/jquery/jquery.min.js'?>"></script>
  <!-- Bootstrap jQuery -->
  <script src="<?php echo base_url().'plugins/bs/bootstrap.min.js'?>"></script>
  <!-- Slick Carousel -->
  <script src="<?php echo base_url().'plugins/slick/slick.min.js'?>"></script>
  <script src="<?php echo base_url().'plugins/slick/slick-animation.min.js'?>"></script>
  <!-- Color box -->
  <script src="<?php echo base_url().'plugins/colorbox/jquery.colorbox.js'?>"></script>
  <!-- shuffle -->
  <script src="<?php echo base_url().'plugins/shuffle/shuffle.min.js'?>"></script>


  <!-- Google Map API Key-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
  <!-- Template custom -->
  <script src="<?php echo base_url().'js/script.js'?>"></script>

  </div><!-- Body inner end -->
  </body>

  </html>