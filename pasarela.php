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
    <meta name="keywords" content="keywords" />
    <meta name="author" content="Corporacion Chamluci S.A.C." />
    <meta name="robots" content="" />    
    <meta name="description" content="descriptions" />
    
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

    <img class="img-header" src="assets/images/solicitud.jxr"  alt="">
    <h1 class="texto-header text-white size-h1">
        Area De Cotizacion
    </h1>
</div>



<br><br>
<div class="page-content sombreados"> 
    <div class="section-full bg-white">
      <div class="container  p-t50 p-b50" >
        <div class="row "id="productosLista">
           

            <div class="col-md-12">

                    <div class="p-lr30">
                        <h4 class="text-uppercase">Cotiza </h4>
            <div class="wt-divider bg-primary text-primary icon-left"><i class="fa fa-object-ungroup"></i></div>
            <div class="m-a30 wt-box border-2" id="listaProductos">

            </div>

<div class="wt-divider bg-secondary text-secondary icon-right"><i class="fa fa-object-ungroup"></i></div>
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


                                                            <button id="" onClick="enviarMensajeCotizacion();"  class="site-button-secondry text-white button-skew z-index1 cotizar ">
                            <div  class="cotizar"> Enviar Mensaje </div><i class="fa fa-angle-right"></i> 
                        </button>
                                    
                                </div>

                            </div>

                        </form>
                        
                    </div>




            </div>


            
        </div>


<div class="row" id="noProductos">
<div class="col-sm-12">
     <div id="alerta3" style="visibility: visible;" class="alert alert-danger alert-dismissible fade in" role="alert"> 
      
      <h4>Aun no tienes productos en tu carrito para cotizar  </h4>  
      <p> 
        <a id="verProductos" href="Contacto" type="button" class="btn btn-info">Contactanos</a> 
        <a type="button" href="Inicio" class="btn btn-default">Ir al Inicio</a> 
      </p> 
    </div>

</div>  
   
  </div>



      </div>
  </div>
</div> 

<br><br>


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