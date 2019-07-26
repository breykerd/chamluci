<?php 
include 'backend/backend.php';
//llamado de las clases
$laEmpresa =new laEmpresa();
$Categorias =new Categorias();
$Productos =new Productos();
$Blog =new Blog();



//llamado de funciones de la clases
$laempresa=$laEmpresa->Empresa();
$contacto= $laEmpresa->contacto();
$categorias= $Categorias->categorias();
$productosDestacados= $Productos->productosDestacados();
$productosPie= $Productos->productosPie();
$blog= $Blog->blog();


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

    <img class="img-header" src="assets/images/blog.jxr"  alt="">
    <h1 class="texto-header text-white h1-grande">
       Blog
    </h1>
    <img class="logos-header" src="assets/images/logo-blanco.webp"  alt="">
</div>


 <div class="section-full p-t80 p-b50 ">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="row" >             
                    <!-- BLOG GRID START -->
                    <div class="portfolio-wrap wt-blog-grid-2" id="destinoBlog">




                        </div>
                    </div>
                </div>

<div class="col-md-4 bg-white ">
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
                                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCorporacion-Chamluci-SAC-657265237665077%2F&tabs=timeline&width=330&height=350&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="338" height="350"  scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                                           
                                                           
                                </div>
                            </div>
                                                    
                            <div id="twitter" class="tab-pane">
                                <div class="widget-post-bx">
                                    <div class="widget-post clearfix bg-gray">
                                                  <a class="twitter-timeline " data-lang="es" data-width="338" data-height="350" data-theme="dark" href="https://twitter.com/CHAMLUCI">Tweets by CHAMLUCI</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>              
                                                                
                                    </div>
                                    
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
        </div>
                                    <!-- 4. OUR GALLERY  -->
        <div class="widget widget_gallery mfp-gallery productos-interes ">
            <h4 >Productos De Interes</h4>
            <div class="wt-divider bg-primary text-primary icon-left"><i class="fa fa-object-ungroup"></i></div>
    <div class="widget-post clearfix bg-gray">
<?php 
    $contadorproducto= 6 ;
    for ($i=0; $i <$contadorproducto ; $i++) { 
?>
<div class="col-xs-6 col-lg-6 p-t20 p-b20 ">
    <div class="dez-post-media text-center">
        <a href="<?php echo 'Producto/'.$productosDestacados[$i]['id'].'-'.$productosDestacados[$i]['url']; ?>" title="<?php echo $productosDestacados[$i]['titulo']; ?>">
            <img src="<?php echo $urlImg.$productosDestacados[$i]['img1']; ?>"  alt="" >
        </a>         
    </div>
</div>
                
                    
<?php } ?>


        </div> 
    </aside>
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