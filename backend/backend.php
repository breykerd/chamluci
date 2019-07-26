<?php 
setlocale(LC_TIME,"es_ES");
//incluir Conexion a base de datos
include 'conection.php';
$mysqli= new Conexion();




//clase que busca la informacion de la empresa y de contacto


class laEmpresa extends Conexion
{
	    public function Empresa()
    {
        $mysqli= new Conexion();
        $resultadoLaEmpresa=$mysqli->query("SELECT * FROM laempresa");
        return $resultadoEmpresa=$resultadoLaEmpresa->fetch_assoc();
        $resultadoEmpresa->free();
    }
    	    public function contacto()
    {
        $mysqli= new Conexion();
        $resultadoContacto=$mysqli->query("SELECT * FROM contaco ");
        return $resultadoDeContacto=$resultadoContacto->fetch_assoc();
        $resultadoDeContacto->free();
    }
}

// clase que busca los sliders del index

class sliders extends Conexion
{
 public function slider()
    {
        $mysqli= new Conexion();
        $resultadoslider=$mysqli->query("SELECT * FROM slider ");
        while($resultadosliders=$resultadoslider->fetch_assoc())
        {
            $listasliders[]=$resultadosliders;
        };
        return $listasliders;
        $listasliders->free();
    }


}


//class que controla todos los datos de las Categorias
class Categorias extends Conexion
{
	 public function categorias()
    {
        $mysqli= new Conexion();
        $resultadocategorias=$mysqli->query("SELECT * FROM categorias ");
        while($resultadocategoria=$resultadocategorias->fetch_assoc())
        {
            $listacategorias[]=$resultadocategoria;
        };
        return $listacategorias;
        $listacategorias->free();
    }
     public function datosCategoria($idCategoria)
    {
        $mysqli= new Conexion();
        $resultadoCategoriaUnica=$mysqli->query("SELECT * FROM categorias WHERE id= '$idCategoria' ");
        return $resultadoCategoriaU=$resultadoCategoriaUnica->fetch_assoc();
        $resultadoCategoriaU->free();
    }


}



//class que controla todos los datos de la Productos
class Productos extends Conexion
{
	 public function productosDestacados()
    {
        $mysqli= new Conexion();
        $resultadoProductos=$mysqli->query("SELECT * FROM productos WHERE destacado_inicio=1");
        while($resultadoProducto=$resultadoProductos->fetch_assoc())
        {
            $listaProductos[]=$resultadoProducto;
        };
        return $listaProductos;
        $listaProductos->free();
    }

	 public function productosPie()
    {
        $mysqli= new Conexion();
        $resultadoProductos=$mysqli->query("SELECT * FROM productos WHERE destacado_footer=1");
        while($resultadoProducto=$resultadoProductos->fetch_assoc())
        {
            $listaProductos[]=$resultadoProducto;
        };
        return $listaProductos;
        $listaProductos->free();
    }
     public function datosProducto($idProducto)
    {
        $mysqli= new Conexion();
        $resultadoProductoUnico=$mysqli->query("SELECT * FROM productos WHERE id= '$idProducto' ");
        return $resultadoProductoU=$resultadoProductoUnico->fetch_assoc();
        $resultadoProductoU->free();
    }
         public function productosDestacadosCategoria($idCategoria)
    {
        $mysqli= new Conexion();
        $resultadoProductosCategoria=$mysqli->query("SELECT * FROM productos WHERE id_cate='$idCategoria'");
        while($resultadoProductoCategoria=$resultadoProductosCategoria->fetch_assoc())
        {
            $listaProductosCategoria[]=$resultadoProductoCategoria;
        };
        return $listaProductosCategoria;
        $listaProductosCategoria->free();
    }
}


//class que controla todos los datos del Blog

class Blog extends Conexion
{
	 public function blog()
    {
        $mysqli= new Conexion();
        $resultadoBlog=$mysqli->query("SELECT * FROM blog");
        while($resultadoblog=$resultadoBlog->fetch_assoc())
        {
            $listaBlog[]=$resultadoblog;
        };
        return $listaBlog;
        $listaBlog->free();
    }

    public function blogReciente()
    {
        $mysqli= new Conexion();
        $resultadoBlogRecientes=$mysqli->query("SELECT * FROM blog order by id desc");
        while($resultadoBlogReciente=$resultadoBlogRecientes->fetch_assoc())
        {
            $listaBlogReciente[]=$resultadoBlogReciente;
        };
        return $listaBlogReciente;
        $listaBlogReciente->free();
    }

      public function blogIndividual($id)
    {
        $mysqli= new Conexion();
        $resultadoBlogIndividual=$mysqli->query("SELECT * FROM blog where id='$id' ");
        return $resultadoblogIndividual=$resultadoBlogIndividual->fetch_assoc();
        $resultadoblogIndividual->free();
    }
}


//funciones en switch y case

if (isset($_GET['funcion'])){
    $funcion=$_GET['funcion'];
 $funcion;
}else{
    $funcion='lol';
};

switch ($funcion) {
    //busca los productos para carritos

        case "ProductosParaCarrito":
        if (isset($_POST['id'])) {
            $id=$_POST['id'];
        }
            $datosProducto = $mysqli->query("SELECT * FROM productos WHERE id='$id'" );
                $ProductosParaCarrito=mysqli_fetch_assoc($datosProducto);
                echo json_encode($ProductosParaCarrito);

        break;
//guarda el correo de suscripcion
        case "suscribirse":
        if (isset($_GET['correo'])) {
            $correo=$_GET['correo'];
        }
        $fecha=date('Y-m-d');
        $hora=date('H:i');

                $datosProducto = $mysqli->query("INSERT INTO correos (id, nombre, correo, hora, fecha)
VALUES (null, '0', '$correo','$hora','$fecha')");
           

        break;

//envia el mensaje de el area de cotizacion

  case "envioMensaje":
        $codigo= substr(str_shuffle(str_repeat('0123456789',5)),0,7);
     
             if (isset($_POST['idProductos'])) {
                $idProductos=$_POST['idProductos'];
            }
            if (isset($_POST['valores'])) {
                $valores=$_POST['valores'];
            }
            if (isset($_POST['datosFormulario'])) {
                $datosFormulario=$_POST['datosFormulario'];
            }
            $cantidad=count($idProductos);



$to = "ventas@corporacionchamluci.com";
$subject = "Área Cotización - Corporación Chamluci SAC  ";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From:Corporacion Chamluci SAC-Area Cotizacion <ventas@corporacionChamluci.com>". "\r\n";
$headers .="Cc:".$datosFormulario[2]."\r\n";
  $mensaje="
<html lang='es'>
<table align='center'>
    <tr>
        <td>

<!-- Tabla Titulo -->   
<table width='800' style='text-align:center;border-collapse:collapse;font-size:18px; font-family:Century Gothic;border: silver;' >
<tr>
    
    <td style=' width:700px;font-family:Century Gothic; margin:0 auto;font-weight: bold; background-color:#d6de70'>
        <center>
            <h1 style='text-align:center;font-size: 20px;display:inline;'>Solicitud de Cotización <a href='www.corporacionChamluci.com' style='text-decoration: none; color:#008be0;'>Corporacion Chamluci </a> </h1> <img  width='80' src='https://corporacionchamluci.com/imagen.png' width='100%' alt='Logo Corporacion Chamluci'>
        </center>
    </td>
    </tr>

<tr>
    <td style='font-family:Century Gothic;font-weight: bold; border-top:1px solid #eee; padding:5px; width:800px; margin:0 auto; text-align:center; border:#00a8eb 1px solid; background-color:#00a8eb;color:#fff' colspan='2'>
        Código de Operación: ".$codigo."
    </td>

</tr>

<!-- Fin Tabla Titulo -->

<!-- tabla Datos Cliente -->
<table  align='center' style='text-align:center;border-collapse:collapse;font-size:15px;font-family:Arial'  width='800' >
<tbody>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;' align='center'><br> Ruc:<br><br></td>
<td width='650' align='center' style='background-color:#e7eaec; border:silver 1px solid;'><br> ".$datosFormulario[0]." <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Nombre:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br>  ".$datosFormulario[1]." <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Correo:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br> <a href='mailto: ".$datosFormulario[2]."' target='_blank'> ".$datosFormulario[2]."</a> <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Teléfono:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br>  ".$datosFormulario[3]." <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Mensaje:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br>  ".$datosFormulario[4]." <br><br></td>
</tr>
</tbody>
</table>
<!-- Fin Tabla Datos Cliente -->

<!-- tabla Productos -->
<table  align='center' width='800' border='1' style='text-align:center;border-collapse:collapse;font-size:18px; font-family:Century Gothic;border: silver 1px;' cellpadding='8'>

<tr bgcolor='#eee'>
<td width='150'><b>Imagen</b></td>
<td width='200'><b>Nombre de Producto</b></td>

<td width='70'><b>Cantidad</b></td>

</tr>


            ";
            for ($i=0; $i < $cantidad; $i++) { 
                $datosProducto = $mysqli->query("SELECT * FROM productos WHERE id='$idProductos[$i]'" );
                $ProductosCotizacion=mysqli_fetch_assoc($datosProducto);
                $mensaje.= "<tr>
                <td width='140'> <img  width='80' src='https://corporacionchamluci.com/adminchamluci/img/".$ProductosCotizacion['img1']."' width='100%'> </td>
<td width='580'>".$ProductosCotizacion['titulo']."</td>
<td width='70'> ".$valores[$i]." </td></tr>";
            }

$mensaje.="


</table>
<!-- Fin Tabla Productos -->
</td>
    </tr>
</table>    
<center>
    <br>
    <a href='http://corporacionchamluci.com'>https://corporacionchamluci.com</a>
</center>
</html>
";
 echo $mensaje;

if(mail($to, $subject, $mensaje, $headers)){
    echo"mensaje enviado";
};
        break;




case "envioMensajeContacto":
        $codigo= substr(str_shuffle(str_repeat('0123456789',5)),0,7);
     
           
            if (isset($_POST['datosFormulario'])) {
                $datosFormulario=$_POST['datosFormulario'];
            }



$to = "ventas@corporacionchamluci.com";
$subject = "Área Cotización - Corporación Chamluci SAC  ";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From:Corporacion Chamluci SAC-Area Cotizacion <ventas@corporacionChamluci.com>". "\r\n";
$headers .="Cc:".$datosFormulario[2]."\r\n";
 
  $mensaje="
<html lang='es'>
<table align='center'>
    <tr>
        <td>

<!-- Tabla Titulo -->   
<table width='800' style='text-align:center;border-collapse:collapse;font-size:18px; font-family:Century Gothic;border: silver;' >
<tr>
    
    <td style=' width:700px;font-family:Century Gothic; margin:0 auto;font-weight: bold; background-color:#d6de70'>
        <center>
            <h1 style='text-align:center;font-size: 20px;display:inline;'>Solicitud de Cotización <a href='www.corporacionChamluci.com' style='text-decoration: none; color:#008be0;'>Corporacion Chamluci </a> </h1> <img  width='80' src='https://corporacionchamluci.com/imagen.png' width='100%' alt='Logo Corporacion Chamluci'>
        </center>
    </td>
    </tr>

<tr>
    <td style='font-family:Century Gothic;font-weight: bold; border-top:1px solid #eee; padding:5px; width:800px; margin:0 auto; text-align:center; border:#00a8eb 1px solid; background-color:#00a8eb;color:#fff' colspan='2'>
        Código de Operación: ".$codigo."
    </td>

</tr>

<!-- Fin Tabla Titulo -->

<!-- tabla Datos Cliente -->
<table  align='center' style='text-align:center;border-collapse:collapse;font-size:15px;font-family:Arial'  width='800' >
<tbody>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;' align='center'><br> Ruc:<br><br></td>
<td width='650' align='center' style='background-color:#e7eaec; border:silver 1px solid;'><br> ".$datosFormulario[0]." <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Nombre:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br>  ".$datosFormulario[1]." <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Correo:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br> <a href='mailto: ".$datosFormulario[2]."' target='_blank'> ".$datosFormulario[2]."</a> <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Tel茅fono:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br>  ".$datosFormulario[3]." <br><br></td>
</tr>
<tr>
<td width='150' style='font-weight: bold;background-color:#008be0; border:silver 1px solid;color:#fff;'  align='center'><br> Mensaje:<br><br></td>
<td width='650' align='center'  style='background-color:#e7eaec; border:silver 1px solid;'><br>  ".$datosFormulario[4]." <br><br></td>
</tr>
</tbody>
</table>
<!-- Fin Tabla Datos Cliente -->


</td>
    </tr>
</table>    
<center>
    <br>
    <a href='http://corporacionchamluci.com'>https://corporacionchamluci.com</a>
</center>
</html>
";
 echo $mensaje;

if(mail($to, $subject, $mensaje, $headers)){
    echo"mensaje enviado";
};
        break;



}


 ?>


