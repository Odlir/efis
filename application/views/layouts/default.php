<!DOCTYPE html>
<html lang="en">

<head>
    <title>Efis<?php echo $title_for_layout ?></title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="Phoenixcoded" />
      <!-- Favicon icon -->
      <link rel="icon" href="<?php echo base_url('files/assets/images/favicon.ico'); ?>" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/bower_components/bootstrap/css/bootstrap.min.css'); ?>">
      <!-- waves.css -->
      <link rel="stylesheet" href="<?php echo base_url('files/assets/pages/waves/css/waves.min.css'); ?>" type="text/css" media="all">
      <!-- feather icon -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/assets/icon/feather/css/feather.css'); ?>">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/assets/icon/themify-icons/themify-icons.css'); ?>">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/assets/icon/icofont/css/icofont.css'); ?>">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/assets/icon/font-awesome/css/font-awesome.min.css'); ?>">
      <!-- Switch component css -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/bower_components/switchery/css/switchery.min.css'); ?>">
      <!-- sweet alert framework -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/bower_components/sweetalert/css/sweetalert.css'); ?>">  
      <!-- jquery file upload Frame work -->
      <link href="<?php echo base_url('files/assets/pages/jquery.filer/css/jquery.filer.css'); ?>" type="text/css" rel="stylesheet" />
      <link href="<?php echo base_url('files/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css'); ?>" type="text/css" rel="stylesheet" />
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/assets/pages/data-table/css/buttons.dataTables.min.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?>">

      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/assets/css/style.css'); ?>">

      <link rel="stylesheet" type="text/css" href="<?php echo base_url('files/assets/css/pages.css'); ?>">
  </head>

  <body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
      <div class="loader-bar"></div>
  </div>
  <!-- [ Pre-loader ] end -->
  <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
          <!-- [ Header ] start -->
          <nav class="navbar header-navbar pcoded-header">
              <div class="navbar-wrapper">
                  <div class="navbar-logo">
                      <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                          <i class="feather icon-toggle-right"></i>
                      </a>
                      <a href="index.html">
                          <img class="img-fluid" height="38" width="78" src="<?php echo base_url('files/assets/images/logo_effectus.png'); ?>" alt="Theme-Logo" />
                      </a>
                  </div>
              </div>
          </nav>
          <!-- [ Header ] end -->

          <div class="pcoded-main-container">
              <div class="pcoded-wrapper">
                  <!-- [ navigation menu ] start -->
                  <nav class="pcoded-navbar">
                    <div class="pcoded-inner-navbar main-menu">
                          
                          <div class="pcoded-navigation-label">Opciones</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="">
                                  <a href="<?=site_url('Grupo')?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon">
                                      <i class="fa fa-users"></i>
                                    </span>
                                    <span class="pcoded-mtext">Grupos</span>
                                  </a>
                              </li>
                              <li class="">
                                  <a href="<?=site_url('Persona')?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon">
                                      <i class="fa fa-user"></i>
                                    </span>
                                    <span class="pcoded-mtext">Personas</span>
                                  </a>
                              </li>
                              <li class="">
                                  <a href="<?=site_url('Encuesta')?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon">
                                      <i class="fa fa-file-text"></i>
                                    </span>
                                    <span class="pcoded-mtext">Micro hábitos</span>
                                  </a>
                              </li>
                          </ul>

                          <div class="pcoded-navigation-label">Reportes</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="">
                                  <a href="<?=site_url('Reporte')?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon">
                                      <i class="fa fa-tasks"></i>
                                    </span>
                                    <span class="pcoded-mtext">Reporte de Encuestas</span>
                                  </a>
                              </li>
                          </ul>

                          <div class="pcoded-navigation-label">Usuario </div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="">
                                  <a href="<?=site_url('login/logout')?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon">
                                      <i class="fa fa-sign-out"></i>
                                    </span>
                                    <span class="pcoded-mtext">Cerrar sesión</span>
                                  </a>
                              </li>
                          </ul>
                    </div>
                  </nav>
                  <!-- [ navigation menu ] end -->
                  <div class="pcoded-content">
                      <!-- [ breadcrumb ] start -->
                      <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h4 class="m-b-10"><?php echo $module_name ?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- [ breadcrumb ] end -->
                        
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page body start -->
                                    <div class="page-body">
                                      <?php echo $oculto;?>
                                      <?php echo $content_for_layout; ?>
                                    </div>
                                </div>
                                <!-- Page body end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main-body end -->
                <div id="styleSelector">

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Warning Section Starts -->
<!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="<?php echo base_url('files/assets/images/browser/chrome.png'); ?>" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="<?php echo base_url('files/assets/images/browser/firefox.png'); ?>" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="<?php echo base_url('files/assets/images/browser/opera.png'); ?>" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="<?php echo base_url('files/assets/images/browser/safari.png'); ?>" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="<?php echo base_url('files/assets/images/browser/ie.png'); ?>" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="<?php echo base_url('files/bower_components/jquery/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('files/bower_components/jquery-ui/js/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('files/bower_components/popper.js/js/popper.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('files/bower_components/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- waves js -->
<script src="<?php echo base_url('files/assets/pages/waves/js/waves.min.js'); ?>"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?php echo base_url('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js'); ?>"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?php echo base_url('files/bower_components/modernizr/js/modernizr.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('files/bower_components/modernizr/js/css-scrollbars.js'); ?>"></script>
<!-- Validation js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

<!-- modalEffects js nifty modal window effects -->
<script type="text/javascript" src="<?php echo base_url('files/bower_components/sweetalert/js/sweetalert.min.js'); ?>"></script>

<script src="<?php echo base_url('files/assets/js/classie.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('files/assets/js/modalEffects.js'); ?>"></script>

<!-- data-table js -->
<script src="<?php echo base_url('files/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/pages/data-table/js/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/pages/data-table/js/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/pages/data-table/js/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('files/bower_components/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('files/bower_components/switchery/js/switchery.min.js'); ?>"></script>

<!-- jquery file upload js -->
<script src="<?php echo base_url('files/assets/pages/jquery.filer/js/jquery.filer.min.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/pages/filer/custom-filer.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('files/assets/pages/filer/jquery.fileuploads.init.js'); ?>" type="text/javascript"></script>

<?php echo $this->layouts->print_includes(); ?> 

<script src="<?php echo base_url('files/assets/js/pcoded.min.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/js/vertical/vertical-layout.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('files/assets/js/script.js'); ?>"></script>


<script>
    $( window ).on( "load", function() {
        $('.loader-bg').fadeOut();
    });
</script>

</body>

</html>


  