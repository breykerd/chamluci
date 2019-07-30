 //verifica carrito y sevisa la resolucion para cargar una imagen adecuada al cargar la pantalla

  $(document).ready(function () {
      verificarCarrito();
      resolucion();

    });
// revisa los botones para colocarlos en el estado adecuado
  window.onload=botones();

//ejecuta en diferentes intervalos de tiempo las funciones luego de cargar la pagina
setTimeout('datosCategorias(1);',700);
setTimeout('paginarBlog(1);',700); 
setTimeout('numeroPagina();',1000); 
setTimeout('paginarBusqueda(1);',700);

//revisa si la variable numero actual esta declarada para colocarse en la pagina adecueda
 if (sessionStorage.numeroActual) {
paginarProductos(sessionStorage.numeroActual); 
}else{
    console.log('hola')
}

//esta funcion controla los aspectos basicos del slider

  


    var tpj = jQuery;
    var revapi1014;
	
    tpj(document).ready(function() {
        if (tpj("#rev_slider_1014_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_1014_1");
        } else {
            revapi1014 = tpj("#rev_slider_1014_1").show().revolution({
                sliderType: "standard",
                dottedOverlay: "none",
                delay: 5000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    mouseScrollReverse: "default",
                    onHoverStop: "off",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "hermes",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: false,
                        tmp: '<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div>	<div class="tp-arr-titleholder">{{title}}</div>	</div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 0,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 0,
                            v_offset: 0
                        }
                    }
                },
                viewPort: {
                    enable: true,
                    outof: "pause",
                    visible_area: "100%",
                    presize: false
                },
                responsiveLevels: [1240, 1024, 778, 480],
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: [1240, 1240, 1240, 800],
                gridheight: [700, 700, 700, 700],
                lazyType: "none",
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 2000,
                    levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 47, 48, 49, 50, 51, 55],
                    type: "mouse",
                },
                shadow: 0,
                spinner: "off",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    });


//funcion que mueve el icono de el carrito en la pantalla
$(document).ready(function(){
                 $(window).scroll(function () {
                    set = $(document).scrollTop()+"px"; 

                    $('#floatDiv').animate({top:set},{duration:1000,queue:false});

                });

            });


//funcion de deteccion de resolucion
function resolucion(){
      if (screen.width < 480) {
        var pantalla = 1;
    }else{
        var pantalla = 2;
    }
    categoria=$("#categoria").val();
    $.ajax({
            url:'backend/backend.php?categoria='+categoria
            ,success:function(data){
                datos= JSON.parse(data); 
                console.log(datos);
                if (screen.width < 480) {
                $("#img1").attr("src","assets/images/test.jxr");
                }
            },error:function(data){
        $('#destino').text('error');


      }
      })
}

//funcion que mantiene el n de pagina para el boton atras
function numeroPagina(){
 numeroDePagina=$('#numeroActual').val();
 sessionStorage.numeroPagina=numeroDePagina;
}

//optiene el id de la categoria de el url donde se encuentra 
//al cargar la pagina por primera ves optiene el valor de la pagina 1 para agregarselo a la funcion de paginar productos
//aparte de eso ejecuta la funcion paginar productos


function datosCategorias(page){
var pathname = window.location.pathname;
var direccionArray = pathname.split("/");
if (direccionArray[2]=="Categoria") {
var url = direccionArray[3].split("-");
var id = url[0];
paginarProductos(id,page);  
}

};

//esta funcion se encarga de paginar e inprimir los productos segun sea la categoria y la pagina que se le pase
function paginarProductos(id,page){
    
        $.ajax({
            url:'includes/paginacionProductos.php?idc='+id+'&page='+page
            ,success:function(data){
                $("#destino").html(data);
                $("#loader").html("");
                    //$("html,body").animate({ scrollTop : $("#destino").offset().left  }, 1500 );
                     botones();
            },error:function(data){
        $('#destino').text('error');


      }

        })
};

//funcion que coloca los botones en cotizar o agregado segun sea su estado 
//se ejecuta al cargar la pagina y al dar click en agregar
function botones(){
    if (sessionStorage.productos!=undefined) {
var producto= sessionStorage.productos.split(",");
var pathname = window.location.pathname;
var direccionArray = pathname.split("/");
var contador;
if (direccionArray[2]=='Categoria') {
    contador=16;
}else if(direccionArray[2]=='Producto'){
    contador=12
}else{
    contador=12;
}
for(var i =0; i < contador;i++){
    
var valorCampo=  $('#idCotizar'+i).val();
    for(var j =0; j < producto.length;j++){
         if(valorCampo == producto[j]){
            k=i+1;
                        $("#agregado"+i).show();
                        $("#cotizar"+i).hide();
                        $("#agregado"+i).css({
                            "visibility": "visible",
                            "background-color": "#008adf",
                            "color": "#fff"
                        });
                                
             break;
         }else{
            $("#cotizar"+i).show();
            $("#agregado"+i).hide();

    }
    }
    delete valorCampo;
    delete k;
    }
iconoCarro();
}else{
    $("#nun").html("0");
}
};



//compara los arrays para ver si ya el producto esta en el carrito
// de no estarlo lo agrega
function compararArrays(idProducto){
var producto=[idProducto];
if (sessionStorage.productos!=undefined) {
var productos= sessionStorage.productos.split(",");
}else{
    agregarCarrito(idProducto);
}
var encuentra = false;

for(var i =0; i < producto.length;i++){
    encuentra = false;
    for(var j =0; j < productos.length;j++){
         if(producto[i] == productos[j]){
             encuentra = true;
             break;
         }
    }
    if(!encuentra){
       agregarCarrito(idProducto);
       break;
    }
}
};

//funcion que agrega el producto al carrito si este no a sido incluido anteriormente
function agregarCarrito(idProducto){
    if (sessionStorage.productos!=undefined) {
var producto= sessionStorage.productos.split(",");

producto.push(idProducto);
var producto= producto.join();
sessionStorage.productos = producto;

    }else{

var idProductos = [idProducto];
var productos= idProductos.join();
sessionStorage.productos = productos;
    }
    botones();
};

//funcion que se encarga de contar los productos de el carrito y agregar el numero al icono
function iconoCarro(){
if (sessionStorage.productos!=undefined) {
    var nProductos= sessionStorage.productos.split(",");
    var cantidadProductos =nProductos.length;
    $("#nun").html(cantidadProductos);

}else{
    $("#nun").html('0');
}
};



//esta funcion se encarga de paginar e inprimir los productos segun sea la categoria y la pagina que se le pase
function paginarBlog(page){
    
        $.ajax({
            url:'includes/paginacionBlog.php?page='+page
            ,success:function(data){
                $("#destinoBlog").html(data);
                     botones();
            },error:function(data){
        $('#destino').text('error');


      }

        })
};

//esta funcion se encarga de paginar e inprimir los productos segun sea la categoria y la pagina que se le pase
function paginarBusqueda(page){
    var URLactual = window.location;
    texto = URLactual.search;
    busquedaPrevia= texto.split("=", 2);
    busqueda=busquedaPrevia[1];

        $.ajax({
            url:'includes/paginacionBusqueda.php?busqueda='+busqueda+'&page='+page
            ,success:function(data){
                $("#destinoBusqueda").html(data);
                     botones();
            },error:function(data){
        $('#destinoBusqueda').text('error');


      }

        })
};


//esta funcion muestra los productos agregados al carrito en el area de cotizacion

function mostrarProductosCarrito(){

var estructura = '<div class="row m-b30  eliminado listaProducto1">'+
      '<div class="col-md-1 col-lg-1 col-sm-1 col-xs-12"><img  src="adminchamluci/img/imagen" alt=""></div>'+
        '<div class="col-md-11 col-lg-11 col-sm-11 col-xs-12  text-primary listaProducto2" >'+
          '<div class="col-md-7 col-lg-7 col-sm-7 col-xs-12 text-gray listaProducto3">titulo</div>'+
            '<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 text-gray listaProducto4">'+
              '<center>'+
                'CANTIDAD &nbsp; '+  
                  '<input class="listaProducto5" type="text" autocomplete="off" id="cantidad" onkeyup="cambiarValor(id);"   value="1" size="5"  />'+
                    '<input type="hidden" id="idhidden" value="1">'+
              '</center>'+
            '</div>'+
            '<div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 ">'+
              '<center>'+
                '<button onclick="eliminarProducto(id);" class="site-button btn" id="">'+
                  'ELIMINAR'+
                '</button>'+
              '</center>'+
            '</div>'+
        '</div>'+   
    '</div>';


var nProductos= sessionStorage.productos.split(",");
var cantidadProductos =nProductos.length;
for (i = 0; i < cantidadProductos; i++) {

var id=nProductos[i];
$.ajax({
    type: "post",
    url: "backend/backend.php?funcion=ProductosParaCarrito",
    data: "id="+id,
    success: function(data){ 
            datosC= JSON.parse(data); 
estructura2 = estructura.replace('imagen', datosC['img1']);
estructura2 = estructura2.replace('titulo', datosC['titulo']);
estructura2 = estructura2.replace('cantidad', 'cantidad-'+datosC['id']);
estructura2 = estructura2.replace('idhidden', 'idhidden-'+datosC['id']);
estructura2 = estructura2.replace('cambiarValor(id);', 'cambiarValor('+datosC['id']+');');
estructura2 = estructura2.replace('eliminarProducto(id);', 'eliminarProducto('+datosC['id']+');');
$('#listaProductos').append(estructura2);
    }
    });
};
};

function cambiarValor(id){
    var valor=$('#cantidad-'+id).val();
    $('#idhidden-'+id).val(valor);
    
}
//funcion para visualisar si hay o no productos en el carrito
function verificarCarrito(){
    if (sessionStorage.productos!=undefined) {
        mostrarProductosCarrito();
            $("#productosLista").show();
            $("#noProductos").hide();
    }else{
            $("#noProductos").show();
            
            $("#productosLista").hide();
    }
          

};


function eliminarProducto(id){
    var nProductos= sessionStorage.productos.split(",");
    id=id.toString();
    var index = nProductos.indexOf(id);
    if (index > -1) {
   nProductos.splice(index, 1);
}
var productos= nProductos.join();
sessionStorage.productos = productos;
if (sessionStorage.productos == "") {
    sessionStorage.clear();
    iconoCarro();
}
$('#listaProductos').empty();
verificarCarrito();
iconoCarro();
}


function ocultaralerta1(){
    var alerta1 = document.getElementById('alerta1');
    alerta1.style.visibility = 'hidden';
}

function ocultaralerta2(){
    var alerta2 = document.getElementById('alerta2');
    alerta2.style.visibility = 'hidden';
}


function suscribirse(){
  var correo= $('#suscribete').val();

  if (isValidEmail(correo)) {
    var alerta1 = document.getElementById('alerta1');

    $.ajax({
            url:'backend/backend.php?funcion=suscribirse&correo='+correo
            ,success:function(data){
               alerta1.style.visibility = 'visible';
               setTimeout('ocultaralerta1();',2000);
            },error:function(data){


      }

        });


}else{

     var alerta1 = document.getElementById('alerta2');
alerta2.style.visibility = 'visible';
setTimeout('ocultaralerta2();',2000);


}

}

function isValidEmail(mail) { 
  return /^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail); 
}


//envio de manse de el area de cotizacion
function enviarMensajeCotizacion(){
var nProductos= sessionStorage.productos.split(",");
var cantidadProductos =nProductos.length;
var valores= new Array();
var datosFormulario= new Array();

for (i = 0; i < cantidadProductos; i++) {
    valores.push($('#idhidden-'+nProductos[i]).val());
    
}
datosFormulario.push($('#ruc').val());
datosFormulario.push($('#nombre').val());
datosFormulario.push($('#correo').val());
datosFormulario.push($('#telefono').val());
datosFormulario.push($('#mensaje').val());


$.ajax({
    type: "post",
    url: "backend/backend.php?funcion=envioMensaje",
    data: {"idProductos":nProductos,"valores":valores,"datosFormulario":datosFormulario},
    success: function(data){ 
           
            var alerta1 = document.getElementById('alerta1');
            alerta1.style.visibility = 'visible';
            setTimeout('ocultaralerta1();',3000);
             limpiarCampos();

    },error:function(data){ 
            var alerta2 = document.getElementById('alerta2');
            alerta2.style.visibility = 'visible';
            setTimeout('ocultaralerta2();',3000);
    }
    });

}
//envio de mensaje de el area de contacto
function enviarMensajeContacto() {

var datosFormulario= new Array();


datosFormulario.push($('#ruc').val());
datosFormulario.push($('#nombre').val());
datosFormulario.push($('#correo').val());
datosFormulario.push($('#telefono').val());
datosFormulario.push($('#mensaje').val());

$.ajax({
    type: "post",
    url: "backend/backend.php?funcion=envioMensajeContacto",
    data: {"datosFormulario":datosFormulario},
    success: function(data){ 

            var alerta1 = document.getElementById('alerta1');
            alerta1.style.visibility = 'visible';
            setTimeout('ocultaralerta1();',3000);
            limpiarCampos();

    },error:function(data){ 

            var alerta2 = document.getElementById('alerta2');
            alerta2.style.visibility = 'visible';
            setTimeout('ocultaralerta2();',3000); 
           
   }
    });
}

// carga diferida de imagenes 
document.addEventListener("DOMContentLoaded", function() {
  var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

  if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.srcset = lazyImage.dataset.srcset;
          lazyImage.classList.remove("lazy");
          lazyImageObserver.unobserve(lazyImage);
          console.log('se ejecuto')
        }
      });
    });

    lazyImages.forEach(function(lazyImage) {
      lazyImageObserver.observe(lazyImage);
    });
  } else {
    // Possibly fall back to a more compatible method here
  }
});







//esta funcion limpia los campos de el area de cotizacion
function limpiarCampos(){
$('#ruc').val('');
$('#nombre').val('');
$('#correo').val('');
$('#telefono').val('');
$('#mensaje').val('');
vaciarCarrito();
}


//esta funcion vacia el carrito y dispara la alerta si se ejecuta bien o mal el envio
function vaciarCarrito(){
sessionStorage.clear();
iconoCarro();
};

