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

$detalles=$laempresa['detalle'];
//procesamiento de descripcion de la empresa
// se divide el contenido de la variable a partir de el simbolo |
$subDescripciones = explode ("|", $detalles, 2);
 ?>
<!DOCTYPE html>
<html lang="es">


<!-- Mirrored from thewebmax.com/constrot/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Mar 2019 17:07:54 GMT -->
<head>

	<!-- META -->
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="<?php echo $laempresa['titulo']; ?>">
    <meta name="keywords" content="<?php echo $laempresa['keywords']; ?>" />
    <meta name="author" content="Corporacíon Chamluci S.A.C." />
    <meta name="robots" content="" />    
    <meta name="description" content="<?php echo $laempresa['description']; ?>" />
    
    
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

    <img class="img-header" src="assets/images/empresa.jxr"  alt="">
    <h1 class="texto-header text-white">
        Nosotros Somos
    </h1>
    <img class="logos-header" src="assets/images/logo-blanco.webp"  alt="">
</div>

<div class=" section-full p-t150 p-b50">
    <div class="container"> 
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <img class="rezize" src="assets/images/empresa.webp"  alt="">
                    </div>
                    <div class="col-md-12">
                        <h2 class="p-t50">
                            Expertos en productos de línea institucional
                        </h2>
                        <p class="text-justify h4">
                            
                        <?php echo $subDescripciones[0]; ?>
 
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-1"> 
            </div>
            <div class="col-md-4 text-center">
                <aside  class="side-bar">
        <div class="widget bg-white  recent-posts-entry">
            <h4 >Redes Sociales</h4>
            <div class="wt-divider bg-primary text-primary icon-left"><i class="fa fa-object-ungroup"></i></div>
                <div class="section-content">
                    <div class="wt-tabs tabs-default border">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#facebook">Facebook</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#twitter">Twitter</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="facebook" class="tab-pane active ">
                                <div class="widget-post-bx">
                                    <div class="widget-post clearfix bg-gray">
                                        <iframe title=" Facebook"src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCorporacion-Chamluci-SAC-657265237665077%2F&tabs=timeline&width=330&height=580&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="338" height="580"  scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                                           
                                                           
                                </div>
                            </div>
                                                    
                            <div id="twitter" class="tab-pane">
                                <div class="widget-post-bx">
                                    <div class="widget-post clearfix bg-gray">
                                                  <a class="twitter-timeline " data-lang="es" data-width="338" data-height="580" data-theme="dark" href="https://twitter.com/CHAMLUCI" >Tweets Por CHAMLUCI</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>              
                                                                
                                    </div>
                                    
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
        </div>
                                    <!-- 4. OUR GALLERY  -->

    </aside>


               
            </div>
        </div> 
        <div class="row">
            <div class="col-md-12">
                <div class="wt-divider bg-primary text-primary icon-left">
                <i class="fa fa-object-ungroup"></i>
            </div>
            <div class="section-head text-center">
                <h1 >Esta es la lista de nuestra amplia variedad de productos </h1> 
            </div>
            <div class="wt-divider bg-secondary text-secondary icon-right">
                <i class="fa fa-object-ungroup"></i>
            </div>
            </div>
            <div class="col-sm-12 p-l30">
               <p class="text-justify h3">
                                        <?php echo $subDescripciones[1]; ?>

            </p> 
            </div>
            
            
        </div>
    </div>
</div>








<!-- BODY END -->

<!-- FOOTER  -->
<?php 
include 'includes/fooder.php';
?>
<!-- FOOTER END -->

        <!-- BUTTON FLOATING  -->
        <a href="https://api.whatsapp.com/send?phone=51947153316&text=&source=&data=" target="_black" rel="noopener"><button class="whatsapp"  ><i class=" fa fa-whatsapp"></i></button></a>
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