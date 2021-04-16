<!DOCTYPE html>
<html lang="en">

<head>
    <title>Efis | <?php echo $encuesta->encuesta_nombre; ?></title>
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
      
      <div class="pcoded-container navbar-wrapper">
          
          <div class="pcoded-main-container">
              <div class="pcoded-wrapper">
                  <div class="pcoded-content" style="margin-left: 0px;">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h4 class="m-b-10">Micro hábito: <?php echo $encuesta->encuesta_nombre; ?> </h4>
                                            <input type="hidden" id="ep_id" value="<?php echo $persona->encuesta_persona_id; ?>" />
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
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form id="frmEncuesta">
                                                    <?php
                                                    foreach ($preguntas as $oPregunta){
                                                    ?>
                                                    <!-- Location card start -->
                                                    <div class="card job-right-header">
                                                        <div class="card-header">
                                                            <h5><?php echo $oPregunta->encuesta_pregunta_nombre; ?></h5>
                                                        </div>
                                                        <div class="card-block">
                                                            
                                                            <?php
                                                            if ($oPregunta->encuesta_pregunta_tipo_str == "CheckBox"){
                                                                foreach ($oPregunta->respuestas as $oRespuestas){
                                                            ?>
                                                                    <div class="checkbox-fade fade-in-primary">
                                                                        <label>
                                                                            <input type="checkbox" <?php echo ($oRespuestas->encuesta_pregunta_respuesta_persona_id != "0") ? "checked" : ""; ?>  name="<?php echo "respuesta_".$oRespuestas->encuesta_pregunta_respuesta_persona_id."_".$oRespuestas->encuesta_pregunta_respuesta_id ?>" value="<?php echo $oRespuestas->encuesta_pregunta_respuesta_id ?>">
                                                                            <span class="cr">
                                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                            </span>
                                                                        </label>
                                                                        <div><?php echo $oRespuestas->encuesta_pregunta_respuesta_nombre; ?></div>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($oPregunta->encuesta_pregunta_tipo_str == "RadioButton"){
                                                            ?>
                                                                    <div class="form-radio">
																		<p class="font-weight-bold">Selecciona con que frecuencia lograste alcanzar tu micro hábito</p>
																		<p>donde 1 no cumpliste el micro hábito y 5 lograste cumplir todo el micro hábito</p>
                                                            <?php foreach ($oPregunta->respuestas as $oRespuestas){ ?>
                                                                        <div class="radio radiofill radio-inline">
                                                                            <label>
                                                                                <input type="radio" <?php echo ($oRespuestas->encuesta_pregunta_respuesta_persona_id != "0") ? "checked" : ""; ?> data-id="<?php echo "respuesta_".$oRespuestas->encuesta_pregunta_respuesta_persona_id."_".$oRespuestas->encuesta_pregunta_respuesta_id ?>" name="<?php echo "respuesta_".$oRespuestas->encuesta_pregunta_id ?>" value="<?php echo $oRespuestas->encuesta_pregunta_respuesta_id ?>">
                                                                                <i class="helper"></i> <?php echo $oRespuestas->encuesta_pregunta_respuesta_nombre; ?>
                                                                                
                                                                            </label>
                                                                        </div>
                                                            <?php } ?>
                                                                    </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <!-- Location card end -->
                                                    <?php }?>
                                                    <!-- Recent Searches card start -->
                                                    <div class="card job-right-header">
                                                        <div class="card-block">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="btnResultado">Guardar resultados</button>
                                                        </div>
                                                    </div>
                                                    <!-- Recent Searches card end -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page body end -->
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript" src="<?php echo base_url('files/bower_components/sweetalert/js/sweetalert.min.js'); ?>"></script>

<?php echo '';//$this->layouts->print_includes(); ?> 

<script src="<?php echo base_url('files/assets/js/pcoded.min.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/js/vertical/vertical-layout.js'); ?>"></script>
<script src="<?php echo base_url('files/assets/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('files/assets/js/script.js'); ?>"></script>


<script>
    $( window ).on( "load", function() {
        $('.loader-bg').fadeOut();
    });

    $( "#btnResultado" ).click(function() {
        
        
        let encuesta = { 'encuesta_persona': $("#ep_id").val() }
        
        let encuesta_data = [];
        $('form#frmEncuesta input[type=checkbox]').each(function() {
            var stre = $(this).attr('name');
            var res = stre.split("_");
            let obj = { 'id_respuesta_persona' : res[1], 'id_respuesta' : res[2], 'estado': $(this).is(":checked") };
            encuesta_data.push(obj);
        });

        $('form#frmEncuesta input[type=radio]').each(function() {
            var stre = $(this).data("id"); //$(this).attr('name');
            var res = stre.split("_");
            let obj = { 'id_respuesta_persona' : res[1], 'id_respuesta' : res[2], 'estado': $(this).is(":checked") };
            encuesta_data.push(obj);
        });
        

        var dataForm = {
            'encuesta': encuesta,
            'pregunta': encuesta_data
        }

        //console.log("data", JSON.stringify(dataForm));
        //console.log("data_2", dataForm);

        $.ajax({
            url: "<?=site_url('formulario/guardar_microhabito')?>",
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                if(data.error == false){
                    swal({
                        title: "Operación completada",
                        text: "Se guardaron los datos de la encuesta correctamente.",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                }
            },
            data: JSON.stringify(dataForm)
        });
    });

</script>

</body>

</html>


