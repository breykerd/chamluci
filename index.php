<?php 
include 'backend/backend.php';
//llamado de las clases
$laEmpresa =new laEmpresa();
$Categorias =new Categorias();
$sliders =new sliders();
$Productos =new Productos();



//llamado de funciones de la clases
$laempresa=$laEmpresa->Empresa();
$contacto= $laEmpresa->contacto();
$categorias= $Categorias->categorias();
$slider= $sliders->slider();
$productosDestacados= $Productos->productosDestacados();
$productosPie= $Productos->productosPie();

 ?>



<!DOCTYPE html>
<html lang="es">
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
   
    <!-- OWL CAROUSEL STYLE SHEET -->
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.min.css">
    <!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/loader.min.css">    
    <link rel="stylesheet" type="text/css" href="assets/css/switcher.css">    

    <!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

  
    <!-- SIDE SWITCHER STYLE SHEET -->
   
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
  
       
            <!-- SLIDER START -->
            <div class="main-slider style-two default-banner">
                <div class="tp-banner-container">
                    <div class="tp-banner" >
                        <!-- START REVOLUTION SLIDER 5.4.1 -->
                        <div id="rev_slider_1014_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="typewriter-effect" data-source="gallery">
                           <div id="rev_slider_1014_1" class="rev_slider "  data-version="5.4.1">
                                <ul>

                                        <?php 
                                        $contadorSlider= count($slider) ;
                                        for ($i=0; $i <$contadorSlider ; $i++) { 
                                         ?>
                                    <!-- SLIDE X -->    
                                    <li data-index="rs-<?php echo $i; ?>000" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power3.easeIn" data-easeout="Power2.easeOut" data-masterspeed="default"  data-thumb="<?php echo $urlImg.$slider[$i]['img']; ?>"  data-rotate="0"  data-saveperformance="off"  data-title="Slide <?php echo $i; ?>">
                                    
                                        <!-- MAIN IMAGE -->
                                        <img src="<?php echo $urlImg.$slider[$i]['img']; ?>"  alt=""  data-bgposition="center bottom" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina/>
                                        <!-- LAYERS -->

                                        <!-- LAYER NR. 2 [ for title ] -->
                                        <div class="tp-caption tp-resizeme" 
                                        id="slide-100-layer-<?php echo $i; ?>" 
                                        data-x="['left','left','left','left']" data-hoffset="['30','30','30','100']" 
                                        data-y="['top','top','top','top']" data-voffset="['200','200','200','200']"  
                                        data-fontsize="['60','60','60','50']"
                                        data-lineheight="['70','70','70','60']"
                                        data-width="['700','700','700','700']"
                                        data-height="['none','none','none','none']"
                                        data-whitespace="['normal','normal','normal','normal']"
                                        data-type="text" 
                                        data-responsive_offset="on" 
                                        data-frames='[
                                        {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'
                                        >
                                        <span class="text-uppercase text-white sombra"><?php echo $slider[$i]['t1'].$slider[$i]['t2']; ?></span>
                                        </div>

                                        <!-- LAYER NR. 4 [ for readmore botton ] -->
                                        <div class="tp-caption tp-resizeme"     
                                        id="slide-100-layer-4"                      
                                        data-x="['left','left','left','left']" 
                                        data-hoffset="['30','30','30','100']" 
                                        data-y="['top','top','top','top']" 
                                        data-voffset="['430','430','450','500']"  
                                        data-type="text" 
                                        data-responsive_offset="on"
                                        data-frames='[ 
                                        {"from":"y:100px(R);opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'>
                                        <a href="<?php echo $slider[$i]['url']; ?>" class="site-button button-lg skew-icon-btn m-r15">Ver más <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </li>
<?php } ?>        

                                    
                                   
                                </ul>
                           </div>
                        </div>
                        <!-- END REVOLUTION SLIDER -->
                    </div>
                </div>
            </div>
            <!-- SLIDER END -->

                        <!-- OUR VALUE SECTION START -->           
            <div class="section-full overlay-wraper" >
                <div class="overlay-main" style="opacity:1; background-color:#a1c3e4;" ></div>
                <div class="container">
                     <div class="row"> 
                        <div class="col-md-7 p-t15 p-b30 support-skew">
                             <div style="z-index:2; position:relative;">
                                <div class="col-md-12 p-tb15">
                                    <div class="wt-icon-box-wraper left ">
                                        <div class="icon-md text-black">
                                                <i class="fa fa-clipboard"></i>
                                            
                                        </div>
                                        <div class="icon-content text-black">
                                            <h5 class="wt-tilte text-uppercase m-b5 ">Recibe nuestras ofertas</h5>
                                            <p >Esta al tanto de nuestros nuevos productos</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-5 p-t50 ">
                            <div class="">
                                <div class="newsletter-bx">
                                    <div class="input-group p-b30">
                                        <div class="row">
                                            <div class="col-md-8" style="">
                                                
                                                    <input name="Suscribir" aria-label="suscribirses" id="suscribete" class="form-control" placeholder="Escriba su email" type="email">
                                               
                                                <div id="alerta1" class="alert alert-success no-radius col-sm-12" style="position: absolute; z-index: 10">
                                  <strong>Registrado</strong> Pronto recibira nuestras promociones
                                </div>
                                <div id="alerta2" class="alert alert-danger no-radius col-sm-12" style="position: absolute; z-index: 11">
                                  <strong>Error</strong> Ingrese un correo valido
                                </div>
                                                 
                                            </div>
                                            <div class="col-md-1 aparecer"> &nbsp;</div>
                                          
                                            <div class="col-md-4">
                                                <button type="button" onclick="suscribirse();" name="Suscribe"  class="site-button">Envianos <i class="fa fa-angle-double-right "></i></button> 

                                            </div>
                                            

                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                     </div>
                </div>
             </div>
            <!-- OUR VALUE SECTION  END -->
<div class="page-content"> 
    <div class="section-full bg-white p-t100 p-b70">
      <div class="container"> 
        <div class="section-head text-center">
            <h1 class="text-uppercase h2">Productos Principales</h1>
            <div class="wt-separator-outer">
                <div class="wt-separator  ">
                    <span class="separator-left bg-primary"></span>
                    <i class="text-primary fa fa-pied-piper-pp fa-2x"></i>
                    <span class="separator-right bg-primary"></span>
                </div>
            </div>   
        </div>


 
<div class="section-content text-center ">
    <div class="row">
<?php 
    $contadorproducto= 8 ;
    for ($i=0; $i <$contadorproducto ; $i++) { 
?>
        <div class="col-md-3 col-sm-6">
            <div class="dez-box m-b30">
                <div class="dez-media"> 
                    <a href="#" title="Imagen"> 
                        <img class="lazy" src="assets/images/loading.webp" 
                        data-src="<?php echo $urlImg.$productosDestacados[$i]['img1']; ?>" 
                        data-srcset="<?php echo $urlImg.$productosDestacados[$i]['img1']; ?>"  
                        title="<?php echo $productosDestacados[$i]['titulo']; ?>" 
                        alt="<?php echo $productosDestacados[$i]['titulo']; ?>">
                    </a>
                    <div class="dez-info-has skew-has">
                        <a href="<?php echo 'Producto/'.$productosDestacados[$i]['id'].'-'.$productosDestacados[$i]['url']; ?>" title="<?php echo $productosDestacados[$i]['titulo']; ?>" class="m-b15 site-button blue  m-r15" type="button">Detalles</a>
                    </div>
                </div>
                <div class="p-a10">
                    <h3 class="dez-title text-uppercase p-height-1 tama h5">
                        <a href="<?php echo 'Producto/'.$productosDestacados[$i]['id'].'-'.$productosDestacados[$i]['url']; ?>" title="<?php echo $productosDestacados[$i]['titulo']; ?>"><?php echo $productosDestacados[$i]['titulo']; ?></a>
                    </h3>
                    <div class="" >
                        <input type="hidden" id="idCotizar<?php echo $i;?>" value="<?php echo $productosDestacados[$i]['id'];?>">
                        <a id="cotizar<?php echo $i;?>" 
    onClick="compararArrays(<?php echo $productosDestacados[$i]['id']; ?>)" class="site-button-secondry text-white button-skew z-index1 cot<?php echo $productosDestacados[$i]['id']; ?>">
                            <div  class="cotizar"> Cotizar </div><i class="fa fa-angle-right"></i> 
                        </a>
                        <a id="agregado<?php echo $i;?>" class="site-button productosAgregado" >AGREGADO</a>


                    </div>
                </div>
            </div>
        </div>
<?php } ?>        
    </div>
</div>
        


     </div>
  </div>
    </div>  


<div class="section-full p-t20 banner-resize" >
                <div class="overlay-main"></div>
                <div class="container">
                    <div class="section-head">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2 class="text-uppercase text-white p-b30 m-a0 p-t15">variedad de productos</h2>
                                <img class="desaparecer" src="assets/images/logos.webp" alt=" Logos de productos" title=" Logos-descriptivos">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<div class=" section-full p-t150 p-b50">
    <div class="container">
      
    <div class="row">
        <div class="col-md-6">

              <img class="lazy" src="" 
                        data-src="assets/images/Nosotros.webp" 
                        data-srcset="assets/images/Nosotros.webp"  
                        alt="sobre Nosotros" title="sobre Nosotros">
        </div>
        <div class="col-md-1">
            
        </div>
        <div class="col-md-5">
                    <div class="wt-divider bg-primary text-primary icon-left"><i class="fa fa-object-ungroup"></i></div>
                    <div class="section-head text-center">
                            <h1 >Sobre Nosotros</h1>
                        
                    </div>
                    <h3>
                       Somos una Empresa Importadora y Comercializadora de productos de línea 
institucional e implementos de limpieza que desea colocarse a su disposición 
y se una alternativa de solución a sus requerimientos, encargándonos de sus 
necesidades de forma integral. 
                    </h3>

                    <div class="wt-divider bg-secondary text-secondary icon-right"><i class="fa fa-object-ungroup"></i></div> 

        </div>
    </div> 
</div>
</div>
<!-- FOOTER  --> <!-- BUTTON TOP START -->
        <a href="https://api.whatsapp.com/send?phone=51947153316&text=&source=&data=" target="_black"><button class="whatsapp" title="Whatsapp"  ><i class=" fa fa-whatsapp"></i></button></a>
        <button class="scroltop" name="Subir" aria-label="Subir" ><i class=" fa fa-arrow-up"></i></button>
<?php 
include 'includes/fooder.php';
?>
<!-- FOOTER END -->
       
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
<script   src="assets/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->

<script   src="assets/js/scrolla.min.js"></script><!-- ON SCROLL CONTENT ANIMTE   -->

<!-- REVOLUTION JS FILES -->

<script  src="assets/js/Revolution.js"></script>
<script   src="assets/js/function.js"></script><!--  FUCTIONS  -->

</body>
</html>