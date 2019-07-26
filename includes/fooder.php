  <footer class="site-footer footer-dark">
            <!-- COLL-TO ACTION START -->
 
            <!-- FOOTER BLOCKES START -->  
            <div class="footer-top overlay-wraper">
                <div class="overlay-main bg-black" ></div>
                <div class="container">
                    <div class="row">
                        <!-- ABOUT COMPANY -->
                        <div class="col-md-3 col-sm-6 text-center">  
                            <div class="widget widget_about">
                                <h4 class="">Redes Sociales</h4>
                                <div class="wt-divider bg-primary text-primary icon-left "><i class="fa fa-object-ungroup"></i></div>
                               
                                <div class="widget-post-bx p-tb30">
                                        <a  href="<?php echo $contacto['fa']; ?>" target="_blank" rel="noopener" aria-label="facebook"><div class="icon-sm text-white bdr-1 p-tb5 sombreado">
                                            <i class="fa fa-facebook "> </i>
                                        </div></a>
                                        <a  href="<?php echo $contacto['tw']; ?>" target="_blank" rel="noopener" aria-label="twitter"><div class="icon-sm text-white bdr-1 p-tb5 sombreado">
                                            <i class="fa fa-twitter "></i>
                                        </div></a>
                                        <a  href="<?php echo $contacto['you']; ?>" target="_blank" rel="noopener" aria-label="youtube"><div class="icon-sm text-white bdr-1 p-tb5 sombreado    ">
                                            <i class="fa fa-youtube "></i>
                                        </div></a>
                                        <a  href="<?php echo $contacto['in']; ?>" target="_blank" rel="noopener" aria-label="instagram"><div class="icon-sm text-white bdr-1 p-tb5 sombreado">
                                            <i class="fa fa-instagram "></i>
                                        </div></a>
                                </div>


                                
                                <div class="logo-footer clearfix p-w100">
                                    <a href=""><img class="" src="assets/images/logo.webp"  alt="logo-footer-Chamluci" title="logo-footer-Chamluci" /></a>
                                </div>
                                
                            </div>
                        </div> 
                        <!-- RESENT POST -->
                        <div class="col-md-4 col-sm-6">
                            <div class="widget recent-posts-entry-date">
                                <h4 class="">Productos Destacados</h4>
                                <div class="wt-divider bg-primary text-primary icon-left"><i class="fa fa-object-ungroup"></i></div>

                                <div class="widget-post-bx">
                                    
  <?php 
$contador =2;
for ($i=0; $i <$contador ; $i++) { 
 ?> <br>
                 <div class="widget-post-bx bdr-1 bdr-gray-dark p-tb5 p-lr5 clearfix">                 
                <div class="widget-post clearfix ">
                  <div class="dez-post-media">



                   <img 
                   class="lazy" src="" 
                        data-src="<?php echo $urlImg.$productosPie[$i]['img1']; ?>" 
                        data-srcset="<?php echo $urlImg.$productosPie[$i]['img1']; ?>" 
                   title="<?php echo $productosPie[$i]['titulo']; ?>" 
                   alt="<?php echo $productosPie[$i]['titulo']; ?>" 
                   width="200"
                    height="143" 
                    rel="noopener">

                </div>
                  <div class="dez-post-info">
                    <div class="dez-post-header">
                      <h6 class="post-title text-uppercase"><p class="colll" ><?php echo $productosPie[$i]['titulo']; ?></p></h6>
                    </div>
                    <div class="dez-post-meta">
                      <ul>
                        <li class="post-author "><a class="text-primary grande" href="Producto/<?php echo $productosPie[$i]['id'].'-'.$productosPie[$i]['url']; ?>" title="<?php echo $productosPie[$i]['titulo']; ?>" > Ver más <br> &nbsp; </a></li>
                      </ul>
                    </div>
                  </div>
                </div></div>
<?php } ?>

                                </div>
                            </div>
                        </div>      

                        <!-- NEWSLETTER -->
                        <div class="col-md-5 col-sm-6">
                                <h4 class="">Informacion</h4>
                                <div class="wt-divider bg-primary text-primary icon-left"><i class="fa fa-object-ungroup"></i></div>
                       <div class="col-md-12 col-sm-6 p-tb5">
                           <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb5 p-lr5 clearfix">
                                <div class="icon-sm text-primary">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="icon-content">
                                    <p><?php echo $contacto['direccion']; ?></p>
                                </div>
                           </div>
                        </div>
                       <div class="col-md-12 col-sm-6 p-tb5 ">
                           <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb5 p-lr5 clearfix ">
                                <div class="icon-sm text-primary">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="icon-content">
                                    <p class="m-b0"> <?php echo $contacto['tel1']; ?></p>
                                </div>
                           </div>
                       </div>
                       <div class="col-md-12 col-sm-6 p-tb5">
                           <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb5 p-lr5 clearfix">
                                <div class="icon-sm text-primary">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="icon-content">
                                    <p class="m-b0"><?php echo $contacto['correo']; ?></p>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-12 col-sm-6 p-tb5">
                           <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb5 p-lr5 clearfix">

                                <div class="icon-sm text-primary">
                                    <i class="fa fa-whatsapp "></i>
                                </div>
                                <div class="icon-content">
                                    <p class="m-b0"><?php echo $contacto['tel2']; ?></p>
                                </div>
                            </div>
                        </div>

   
                        </div>
                    </div>

                </div>
            </div>
            <!-- FOOTER COPYRIGHT -->
            <div class="footer-bottom overlay-wraper">
                <div class="overlay-main bg-black"></div>
                <div class="container p-t30">
                    <div class="row">
                        <div class="wt-footer-bot-left">
                            <span class=" text-white">© 2019 Corporacion Chamluci. Todos Los Derechos Reservados. Realizado Por Tecnoblack.</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>