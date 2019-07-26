<?php 
require("../backend/conection.php");
$mysqli= new Conexion();
//incluir el archivo de paginación
include 'paginacionB.php'; 

//las variables de paginación
if (isset($_GET['page'])) {
	$page =$_GET['page'];
}else{
	$page = 1;
}

$per_page = 4; //la cantidad de registros que desea mostrar

$adjacents  = 4; //brecha entre páginas después de varios adyacentes

$offset = ($page - 1) * $per_page;

//Cuenta el número total de filas de la tabla*/

$resultado=$mysqli->query("SELECT * FROM blog " );

$countQuery =$resultado->num_rows;

		$total_pages = ceil($countQuery/$per_page);

		$reload = 'articulos.php';

		//consulta principal para recuperar los datos

		$blogs = $mysqli->query("SELECT * FROM blog ORDER BY id DESC LIMIT $offset,$per_page");

		if ($total_pages>0){

			?>




<?php
$cant=0;
while($blog = mysqli_fetch_array($blogs)){
    $caracteres= 200;
$textoRecortado=substr($blog['detalle'], 0, $caracteres).'...';
?> 
       <!-- COLUMNS 1 -->
                        <div class="post masonry-item col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <div class="blog-post blog-grid date-style-3 date-skew ">
                                
                                <div class="wt-post-media wt-img-effect zoom-slow">
                                    <a href="Blog/<?php echo $blog['id'].'-'.$blog['url']; ?>">
                                        <img src="<?php echo $urlImg.$blog['img']; ?>" alt="">
                                    </a>
                                </div>
                                    
                                    <div class="wt-post-info  p-a30 p-b15  bg-gray">
                                
                                        <div class="wt-post-title ">
                                            <h6 class="post-title p-height-2"><a href="Blog/<?php echo $blog['id'].'-'.$blog['url']; ?>"> <?php echo $blog['titulo']; ?></a></h6>
                                        </div>
                                        
                                        <div class="wt-post-meta ">
                                          <ul>
                                            <li class="post-date"> <i class="fa fa-object-ungroup"></i> </li>

                                          </ul>
                                        </div>
                                        
                                        <div class="wt-post-text p-height-3">
                                            <p><?php echo $textoRecortado; ?></p> 
                                        </div>
                                    <a href="Blog/<?php echo $blog['id'].'-'.$blog['url']; ?>" class="site-button-secondry text-white button-skew z-index1 cotizar ">
                            <div  class="cotizar"> Leer Mas </div><i class="fa fa-angle-right"></i> 
                        </a>

                                        
                                    </div>
                                    
                                </div>
                            </div>




<?php
}
?>



     <div class="col-md-12 text-center">
     	<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
        
    </div>













<?php
} else {
?>
<div class="alert alert-warning alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>Aviso!!!</h4> No hay datos para mostrar 
</div>
<?php
}
?>





