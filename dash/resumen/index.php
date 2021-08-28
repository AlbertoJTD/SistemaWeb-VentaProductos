<?php
session_start();
 $menu='resumen';
 $titulo='Resumen';
 $ruta="../../";
 include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/Usuarios.php');
  include($ruta.'dao/Ventas.php');
?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            
                                <div class="card text-info">
                                    <h2 align="center" id="titulo1">Recuento de lo que se ha hecho..</h2>
                                </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Productos Registrados</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/productos/" title=""><img src="<?=$ruta?>assets/img/comida-rapida.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class="">

                                            <?php 
                                            $producto= new Productos('','','','','','');
                                            $producto->setConexion($bd);
                                            $totalProductos=$producto->totalProductos();
                                             ?>

                                             <h3 style="color: #0D198A;"><?=$totalProductos?> producto(s)</h3>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Ventas Realizadas</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/ventas/" title=""><img src="<?=$ruta?>assets/img/caja-registradora.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class=" ">

                                             <?php 
                                            $venta= new Ventas('','','');
                                            $venta->setConexion($bd);
                                            $totalventas=$venta->totalVentas();
                                             ?>

                                              <h3 style="color: #0D198A;"><?=$totalventas?> venta(s)</h3>
                                        </div>
                                    </div>
                                </div>
                        </div>

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Usuarios registrados</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a 
                                            <?php  
                                            if(isset($_SESSION['tipoUsuario'])){
                                                if($_SESSION['tipoUsuario'] == 1){
                                                    ?>
                                                    href="<?=$ruta?>dash/usuarios/" 
                                                    <?php
                                                }else{
                                                    ?>
                                                    href="#" 
                                                    <?php
                                                }
                                            }


                                            ?>href="<?=$ruta?>dash/usuarios/" 

                                            title=""><img src="<?=$ruta?>assets/img/usuarios.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class="">

                                             <?php 
                                            $usuario= new Usuarios('','','','','','','');
                                            $usuario->setConexion($bd);
                                            $totalusuarios=$usuario->totalUsuarios();
                                             ?>

                                             <h3 style="color: #0D198A;"><?=$totalusuarios?> usuario(s)</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>

 <?php  
  include($ruta.'footer/footer_dashboard.php');
  ?>