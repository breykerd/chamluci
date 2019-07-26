<?php 
include 'backend/backend.php';
//llamado de las clases
$laEmpresa =new laEmpresa();
$Categorias =new Categorias();
$Productos =new Productos();


//llamado de funciones de la clases
$laempresa=$laEmpresa->Empresa();
$contacto= $laEmpresa->contacto();
$categorias= $Categorias->categorias();
$productosPie= $Productos->productosPie();

 ?>

<!DOCTYPE html>
<html lang="es">


<head>
<base href="/chamluci/" />

    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />    
    <meta name="description" content="" />
    
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
    
    <!-- PAGE TITLE HERE -->
    <title>Corporacíon Chamluci S.A.C. - Línea Institucional</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome/css/font-awesome.min.css" />
    <!-- FLATICON STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.min.css">
    <!-- ANIMATE STYLE SHEET --> 
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
    <!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.min.css">
    <!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.min.css">
    <!-- LOADER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/loader.min.css">    
    <!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
     <!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">

  
    <!-- SIDE SWITCHER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/switcher.css">    

    
    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/revolution/css/settings.css">
    <!-- REVOLUTION NAVIGATION STYLE -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/revolution/revolution/css/navigation.css">
    
   
</head>
<body>
<!-- HEADER  -->
<?php 
include 'includes/header.php';
?>
<!-- HEADER END -->

<!-- BODY  -->
<div class=" section-full ">

    <img class="img-header" src="assets/images/banner-contacto.jxr"  alt="">
    <h1 class="texto-header text-white h1-grande">
       Contacto
    </h1>
    <img class="logos-header" src="assets/images/logo-blanco.webp"  alt="">
</div>
<br><br>
<div class="page-content sombreados"> 
    <div class="section-full bg-white   ">
      <div class="container  p-t50 p-b50">
        <div class="row ">
            <div class="col-md-5">
                    <div class="col-md-12">
                        <img class="rezize" src="assets/images/contacto-1.webp"  alt="">
                    </div>

            </div>

            <div class="col-md-7">

                    <div class="p-lr30">
                        <h4 class="text-uppercase">Contactanos </h4>
            <div class="wt-divider bg-primary text-primary icon-left"><i class="fa fa-object-ungroup"></i></div>

                    </div>
                    <div class="m-a30 wt-box border-2">
                    
                        <form class="cons-contact-form" method="post" action="">
                        
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <span class="input-group-addon"><i class="fa fa-building-o text-primary" ></i></span>
                                            <input name="Ruc" id="ruc" type="text" required class="form-control" placeholder="Ruc">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user text-primary"></i></span>
                                            <input name="Nombre" id="nombre" type="text" required class="form-control" placeholder="Nombre">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope text-primary"></i></span>
                                            <input name="Correo" id="correo" type="text" required class="form-control" placeholder="Correo">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone text-primary"></i></span>
                                            <input name="Telefono" id="telefono" type="text" class="form-control" required placeholder="Telefono">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon v-align-m"><i class="fa fa-pencil text-primary"></i></span>
                                            <textarea name="mensaje" id="mensaje" rows="4" class="form-control " required placeholder="Escriba su consulta" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div id="alerta1" class="alert alert-success no-radius col-sm-12" style="position: absolute; z-index: 10">
                                  <strong>Mensaje Enviado</strong> Sera atendido a la brevedad posible
                                </div>
                                <div id="alerta2" class="alert alert-danger no-radius col-sm-12" style="position: absolute; z-index: 11">
                                  <strong>Error</strong> Problemas con el envio comuniqiese con la central
                                </div>
                                                            <button id="" onClick="enviarMensajeContacto();"  class="site-button-secondry text-white button-skew z-index1 cotizar ">
                            <div  class="cotizar"> Enviar Mensaje </div><i class="fa fa-angle-right"></i> 
                        </button>
                                    
                                </div>

                            </div>

                        </form>
                        
                    </div>




            </div>


            
        </div>
      </div>
  </div>
</div>

<br><br>





<div class="page-content "> 
    <div class="section-full bg-white   ">
      <div class="container  p-t50 p-b50">
        <div class="row ">

            <div class="col-md-4 col-sm-6 ">

                <div class="wt-icon-box-wraper bx-style-2 m-t80 m-b30 p-a30 center bg-gray">
                    <div class="wt-icon-box-sm text-secondary bg-white  bdr-2 m-b20">
                        <span class="icon-cell "><i class="fa fa-phone"></i></span>
                    </div>
                    <br>
                    <div class="icon-content p-t40">
                        <h5 class="wt-tilte text-uppercase">Central</h5>
                        <p><?php echo $contacto['tel1']; ?> </p>
                    </div>
                </div>
                <div class="wt-icon-box-wraper bx-style-2 m-t80 m-b30 p-a30 center bg-gray">
                    <div class="wt-icon-box-sm text-secondary bg-white  bdr-2 m-b20">
                        <span class="icon-cell "><i class="fa fa-whatsapp"></i></span>
                    </div>
                     <br>
                    <div class="icon-content p-t40">
                        <h5 class="wt-tilte text-uppercase">Whatsapp</h5>
                        <p><?php echo $contacto['tel2']; ?> </p>
                    </div>
                </div>
                <div class="wt-icon-box-wraper bx-style-2 m-t80 m-b30 p-a30 center bg-gray">
                    <div class="wt-icon-box-sm text-secondary bg-white  bdr-2 m-b20">
                        <span class="icon-cell "><i class="fa fa-envelope-o"></i></span>
                    </div>
                     <br>
                    <div class="icon-content p-t40">
                        <h5 class="wt-tilte text-uppercase">Email</h5>
                        <p><?php echo $contacto['correo']; ?></p>
                    </div>
                </div>


                <div class="wt-icon-box-wraper bx-style-2 m-t80 m-b30 p-a30 center bg-gray">
                    <div class="wt-icon-box-sm text-secondary bg-white  bdr-2 m-b20">
                        <span class="icon-cell "><i class="fa fa-clock-o"></i></span>
                    </div>
                    <br>
                    <div class="icon-content p-t40">
                        <h5 class="wt-tilte text-uppercase">Central</h5>
                        <p><?php echo $contacto['horario']; ?></p>
                    </div>
                </div>
            </div>
           <div class="col-md-8 col-sm-6 ">

                <div class="wt-icon-box-wraper bx-style-2 m-t80 m-b30 p-a30 center bg-gray">
                    <div class="wt-icon-box-sm text-secondary bg-white  bdr-2 m-b20">
                        <span class="icon-cell "><i class="fa fa-map-marker"></i></span>
                    </div>
                    <br>
                    <div class="icon-content p-t40">
                        <h5 class="wt-tilte text-uppercase">Direccion</h5>
                        <p><?php echo $contacto['direccion']; ?></p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.951333937369!2d-76.96395768860738!3d-12.046869491467234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c687e8f34931%3A0xfc6d9c8f72b65227!2sCORPORACION+CHAMLUCI+SAC!5e0!3m2!1ses!2spe!4v1487283263242" width="100%" height="725" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>

            </div>

        </div>

 

    </div>
</div>
</div>


<div class="section-full p-t30 banner-resize" >
                <div class="overlay-main"></div>
                <div class="container">
                    <div class="section-head">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                                <div class="container">

                    <div class="row p-t30">

                        <div class="col-md-6 col-sm-3 m-b30">

                            <div class="p-a30 text-white text-center bdr-3">

                                <div class="m-b20">

                                    <div class="icon-cell text-white"> <img src="<?php echo $urlImg.$contacto['img_bcp']; ?>"></div>

                                </div>

                                <div class="font-20 font-weight-800 m-b5"><?php echo $contacto['t_bcp1']; ?></div>

                                 <div class="font-20 font-weight-800 m-b5"><?php echo $contacto['t_bcp2']; ?></div>

                                <span><?php echo $contacto['t_bcp3']; ?></span> </div>

                        </div>

                        <div class="col-md-6 col-sm-3 m-b30">

                            <div class="p-a30 text-white text-center bdr-3">

                                <div class="m-b20">

                                    <div class="icon-cell text-white"> <img src="<?php echo $urlImg.$contacto['img_bbva']; ?>"> </div>

                                </div>

                                <div class="font-20 font-weight-800 m-b5"><?php echo $contacto['t_bbva_1']; ?></div>

                                <div class="font-20 font-weight-800 m-b5"><?php echo $contacto['t_bbva_2']; ?></div>

                                <span><?php echo $contacto['t_bbva_3']; ?></span> </div>

                        </div>

                        

                    </div>

                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br><br><br>












<!-- BODY END -->








<!-- FOOTER  -->
<?php 
include 'includes/fooder.php';
?>
<!-- FOOTER END -->

        <!-- BUTTON FLOATING  -->
        <a href="https://api.whatsapp.com/send?phone=51947153316&text=&source=&data=" target="_black"><button class="whatsapp"  ><i class=" fa fa-whatsapp"></i></button></a>
        <button class="scroltop" ><i class=" fa fa-arrow-up"></i></button>
        <!-- BUTTON FLOATING END  -->




    <!-- JAVASCRIPT  FILES ========================================= --> 
<script   src="assets/js/jquery-1.12.4.min.js"></script><!-- JQUERY.MIN JS -->
<script   src="assets/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->

<script   src="assets/js/bootstrap-select.min.js"></script><!-- FORM JS -->
<script   src="assets/js/jquery.bootstrap-touchspin.min.js"></script><!-- FORM JS -->

<script   src="assets/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->

<script   src="assets/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script   src="assets/js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script   src="assets/js/waypoints-sticky.min.js"></script><!-- COUNTERUP JS -->


<script   src="assets/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->

<script   src="assets/js/stellar.min.js"></script><!-- PARALLAX BG IMAGE   --> 
<script   src="assets/js/scrolla.min.js"></script><!-- ON SCROLL CONTENT ANIMTE   -->

<script   src="assets/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script   src="assets/js/switcher.js"></script><!-- SWITCHER FUCTIONS  -->
<!-- REVOLUTION JS FILES -->

<script  src="assets/js/Revolution.js"></script>



<script   src="assets/js/function.js"></script><!--  FUCTIONS  -->

</body>
</html>	
