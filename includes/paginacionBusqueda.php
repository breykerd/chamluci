
<?php 
require("../backend/conection.php");
$mysqli= new Conexion();
//incluir el archivo de paginación
include 'paginacionBus.php'; 


//las variables de paginación
if (isset($_GET['page'])) {
	$page =$_GET['page'];
}else{
	$page = 1;
}
//las variables de paginación
if (isset($_GET['busqueda'])) {
    $buscar =$_GET['busqueda'];
}

$per_page = 12; //la cantidad de registros que desea mostrar

$adjacents  = 4; //brecha entre páginas después de varios adyacentes

$offset = ($page - 1) * $per_page;

//Cuenta el número total de filas de la tabla*/

$resultado=$mysqli->query("SELECT * FROM productos WHERE titulo like '%$buscar%'" );

$countQuery =$resultado->num_rows;

		$total_pages = ceil($countQuery/$per_page);

		$reload = 'articulos.php';

		//consulta principal para recuperar los datos

		$productos = $mysqli->query("SELECT * FROM productos WHERE titulo like '%$buscar%'  ORDER BY id DESC LIMIT $offset,$per_page");

		if ($total_pages>0){

			?>




<?php
$cant=0;
while($mos = mysqli_fetch_array($productos)){
?> 

		<div class="col-md-3 col-sm-6 ">
            <div class="dez-box m-b30 ">
                <div class="dez-media"> 
                    <a href="Producto/<?php echo $mos['id'].'-'.$mos['url'];?>"> 
<?php 
$contador =9;
for ($i=1; $i <=$contador ; $i++) { 
if($mos['img_principal']==$i) {
?>
                        <img src="<?php echo $urlImg.$mos['img'.$i];?>"  alt="">
<?php };};?>
                    </a>
                    <div class="dez-info-has skew-has ">
                        <a href="Producto/<?php echo $mos['id'].'-'.$mos['url'];?>" class="m-b15 site-button blue  m-r15" type="button">Detalles</a>
                    </div>
                </div>
                <div class="p-a10">
                    <h3 class="dez-title text-uppercase tama p-height-1 h5">
                        <a href="Producto/Producto/<?php echo $mos['id'].'-'.$mos['url'];?>"><?php echo $mos['titulo'];?></a>
                    </h3>
                    <div class="text-center" >
                        <input type="hidden" id="idCotizar<?php echo $cant;?>" value="<?php echo $mos['id'];?>">
                        <a id="cotizar<?php echo $cant;?>" 
	onClick="compararArrays(<?php echo $mos['id']; ?>)" class="site-button-secondry text-white button-skew z-index1 cot<?php echo $mos['id']; ?>">
                            <div  class="cotizar"> Cotizar </div><i class="fa fa-angle-right"></i> 
                        </a>
                        <a id="agregado<?php echo $cant;?>" class="site-button productosAgregado" >AGREGADO</a>


                        <?php $cant++; ?>
                    </div>
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
