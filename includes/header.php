<!-- icono carrito de cotizacion -->
<div id="floatDiv">
  <a href="Cotizacion" title="Cotizacion" class="fa fa-shopping-cart iconoCarrito"></a>
    <i class="num" id="nun">0</i>

</div>
<!-- fin icono carrito de cotizacion -->



 <header class="site-header header-style-1 ">
            <!-- TOP BAR START -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="wt-topbar-right clearfix">
                            <ul class="social-bx list-inline pull-right icon-lgs">
                                <li ><a href="<?php echo $contacto['fa']; ?>" target="_blank" rel="noopener" title="Facebook" class="fa fa-facebook sombreado-icono" ></a></li>
                                <li ><a href="<?php echo $contacto['tw']; ?>" target="_blank" rel="noopener" title="twitter" class="fa fa-twitter sombreado-icono" ></a></li>
                                <li ><a href="<?php echo $contacto['you']; ?>" target="_blank" rel="noopener" title="Youtube" class="fa fa-youtube sombreado-icono" ></a></li>
                                <li ><a href="<?php echo $contacto['in']; ?>" target="_blank" rel="noopener" title="Instagram" class="fa fa-instagram sombreado-icono" ></a></li>
                            </ul>
                            <ul class="list-unstyled e-p-bx pull-right">
                                <li ><i class="fa fa-envelope sombreado-icono"></i><?php echo $contacto['correo']; ?></li>
                                <li ><i class="fa fa-phone sombreado-icono"></i><?php echo $contacto['tel1']; ?></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- MAIN BAR START -->
            <div class="sticky-header main-bar-wraper">
                <div class="main-bar bg-primary">
                    <div class="container">
                        <!-- SITE LOGO -->
                        <div class="logo-header mostion header-skew">
                            <a href="Inicio" title="Inicio" >
                                <img src="assets/images/logo.webp" width="230" height="67" alt="Logo Chamluci" title="Logo Chamluci" />
                            </a>
                        </div>
                        <!-- NAV TOGGLE BUTTON -->
                        <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- EXTRA NAV -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <button type="button" class="site-search-btn"  title="Busqueda"><i class="fa fa-search"></i></button>
                            </div>
                         </div>
                        <!-- SITE Search AREA -->
                        <div class="site-search">
                            <form action="Buscar" method="get">
                                <div class="input-group">
                                    <input name="Busqueda" type="text" class="form-control" placeholder="Buscar">
                                    <span class="input-group-btn">
                                        <button  type="submit" class="site-button"><i class="fa fa-search text-white sombreado"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- MAIN NAV -->
                        <div class="header-nav navbar-collapse collapse ">
                            <ul class=" nav navbar-nav">
                                <li>
                                    <a href="Inicio"  title="Inicio">Inicio </a>
                                </li>
                                <li>
                                    <a href="La-Empresa"  title="La Empresa">La Empresa </a>
                                </li>
                                <li>
                                    <a href="javascript:;">Productos<i class="fa fa-chevron-down"></i></a>
                                    <ul class="sub-menu">
                                        <?php 
                                        $contadorCategorias= count($categorias) ;
                                        for ($i=0; $i <$contadorCategorias ; $i++) { 
                                            $url= $categorias[$i]['id']."-".$categorias[$i]['url'];
                                         ?>
                                        <li><a href="Categoria/<?php echo $url;?>" title="<?php echo mb_strtoupper($categorias[$i]['titulo']);?>" > 
                                                <?php echo mb_strtoupper($categorias[$i]['titulo']);?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="Blog" title="Blog">Blog</a>
                                </li>
                                <li>
                                    <a href="Contacto" title="Contacto" >Contacto</a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </header>