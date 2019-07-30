<?php 
include 'backend/backend.php';
//llamado de las clases
$laEmpresa =new laEmpresa();
$Categorias =new Categorias();
$Productos =new Productos();


//optenemos el id de la categoria o producto segun sea el caso de la url donde nos encontremos
//optengo url relativa
$urlRelativo=$_SERVER['REQUEST_URI'];

//realizo explode a la url para optener el string donde se encuentra agregada el numero de categoria
$url=explode('/', $urlRelativo);


//luego a ese string le realizo otro explode pero esta ves con un delimitador diferente para optener  la id de la categoria
$idRelativo=explode('-', $url[3]);
// luego ese elemento donde se encuentra el id de la categoria lo guardo en una variable para poder manejarlo mejor
$idProducto= $idRelativo[0];

//llamado de funciones de la clases
$laempresa=$laEmpresa->Empresa();
$contacto= $laEmpresa->contacto();
$categorias= $Categorias->categorias();
$productosPie= $Productos->productosPie();
$DatosProducto= $Productos->datosProducto($idProducto);

$idCategoria= $DatosProducto['id_cate'];

$datosCategoria=$Categorias->datosCategoria($idCategoria);
$productosDestacadosCategoria=$Productos->productosDestacadosCategoria($idCategoria);
$urlProducto=$DatosProducto['id'].'-'.$DatosProducto['url'];




 ?>
<!DOCTYPE html>
<html lang="es">

<head>
<base href="/chamluci/" />

    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?php echo $DatosProducto['keywords']; ?>" />
    <meta name="author" content="" />
    <meta name="robots" content="" />    
    <meta name="description" content="<?php echo $DatosProducto['description']; ?>" />
    
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
    <img class="img-header" src="<?php echo $urlImg.$datosCategoria['img_header']; ?>"  alt="">
    <h1 class="texto-header text-white size-h1">
        <?php echo $datosCategoria['titulo']; ?>
       
    </h1>
</div>
<br><br>
<div class="page-content sombreados"> 
    <div class="section-full bg-white   ">
      <div class="container  p-t50 p-b50">
        <div class="row ">
            <div class="col-md-5">
                                       <a href="javascript:history.back()" class="site-button blue-full button-skew m-l20"><i class="fa fa-chevron-left"></i><span>Atrás</span></a> 

                                       


               <!--Fade slider-->
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
<?php 
$contador =9;
for ($i=1; $i <=$contador ; $i++) { 
    if ($DatosProducto['img'.$i]==null) {
       }else{  
?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" 
                        class="<?php if($DatosProducto['img_principal']==$i){?>active<?php }?>"></li>
<?php }} ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
<?php 
$contador =9;
for ($i=1; $i <=$contador ; $i++) { 
    if ($DatosProducto['img'.$i]==null) {
       }else{  
?>
                    <!-- Wrapper for slides -->
                    
                        <div class="item <?php if($DatosProducto['img_principal']==$i){?>active<?php }?>">
                            <img src="<?php echo $urlImg.$DatosProducto['img'.$i]; ?>" alt="<?php echo $DatosProducto['titulo']; ?>">

                        </div>

                    
<?php }} ?></div>
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>
            </div>

            <div class="col-md-1">
            </div>
            <div class="col-md-6">
                <h1 class="size-h2">
                    <?php echo $DatosProducto['titulo']; ?>
                </h1>
                <p class="text-gray">
                    <?php echo $DatosProducto['detalle']; ?>
                </p>
                
                <div class="p-b30 p-t20 col-md-5 col-sm-12">
                         <input type="hidden" id="idCotizar0" value="<?php echo $DatosProducto['id'];?>">
                        <a id="cotizar0" 
    onClick="compararArrays(<?php echo $DatosProducto['id'];?>)" class="site-button-secondry text-white button-skew z-index1 cot<?php echo $DatosProducto['id']; ?>">
                            <div  class="cotizar"> Cotizar </div><i class="fa fa-angle-right"></i> 
                        </a>
                        <a id="agregado0" class="site-button productosAgregado" >AGREGADO</a>
                </div>
                <div class="col-md-7 col-sm-12">
                <h3 class="text-gray ">
                    Compartelo 
                    <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https://corporacionchamluci.com/Producto/<?php echo $urlProducto; ?>','_blank', 'width=500,height=400');" class="bg-transparent border-primary text-primary"><i class=" fa fa-facebook-square fa-lg "></i></button>
                    <button onclick="window.open('https://twitter.com/home?status=https://corporacionchamluci.com/Producto/<?php echo $urlProducto; ?>','_blank', 'width=500,height=400');" class="bg-transparent border-primary text-primary"><i class=" fa fa-twitter fa-lg "></i></button>
                    <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https://corporacionchamluci.com/Producto/<?php echo $urlProducto; ?>','_blank', 'width=500,height=400');" class="bg-transparent border-primary text-primary"><i class=" fa fa-instagram fa-lg "></i></button>
                </h3>
                
            </div>
            </div>

            
        </div>
      </div>
  </div>
</div>

<br><br>
            
<div class="page-content"> 
    <div class="section-full bg-white p-b70">
      <div class="container"> 

<div class="col-md-12">
                <h3 class="text-gray text-center">
                    Cualquier duda, Contactenos <a href="https://api.whatsapp.com/send?phone=51947153316&text=&source=&data=" target="_black"><button class="bg-transparent border-primary text-primary"><i class=" fa fa-whatsapp fa-lg "></i></button></a>
                </h3>
            </div>
<div class="section-content text-center ">
    <div class="row">
<?php 
$cant=1;
$contador =4;
for ($i=0; $i <$contador ; $i++) { 
$urlPorductoCategoria= $productosDestacadosCategoria[$i]['id'].'-'.$productosDestacadosCategoria[$i]['url'];
 ?>
 
        <div class="col-md-3 col-sm-6">
            <div class="dez-box m-b30">
                <div class="dez-media"> 
                    <a href="Producto/<?php echo $urlPorductoCategoria; ?>"> 
                        <img src="<?php echo $urlImg.$productosDestacadosCategoria[$i]['img1']; ?>"  alt="">
                    </a>
                    <div class="dez-info-has skew-has  ">
                        <a href="Producto/<?php echo $urlPorductoCategoria; ?>" class="m-b15 site-button blue  m-r15" type="button">Informacion</a href="producto">
                    </div>
                </div>
                <div class="p-a10">
                    <h3 class="dez-title text-uppercase  p-height-1  tama h5">
                        <a href="Producto/<?php echo $urlPorductoCategoria; ?>"><?php echo $productosDestacadosCategoria[$i]['titulo']; ?></a>
                    </h3>
                    <div >
                        <input type="hidden" id="idCotizar<?php echo $cant; ?>" value="<?php echo $productosDestacadosCategoria[$i]['id'];?>">
                        <a id="cotizar<?php echo $cant;?>" 
    onClick="compararArrays(<?php echo $productosDestacadosCategoria[$i]['id']; ?>)" class="site-button-secondry text-white button-skew z-index1 cot<?php echo $productosDestacadosCategoria[$i]['id']; ?>">
                            <div  class="cotizar"> Cotizar </div><i class="fa fa-angle-right"></i> 
                        </a>
                        <a id="agregado<?php echo $cant;?>" class="site-button productosAgregado" >AGREGADO</a>
                        <?php $cant++ ?>
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