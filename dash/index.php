<?php
session_start();
 $menu='dashboard';
 $titulo='Inicio';
 $ruta="../";
  include($ruta.'header/header_dashboard.php');
?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            
                                <div class="card text-info">
                                    <h2 align="center" id="titulo1">¿Qué quieres hacer hoy?</h2>
                                </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Productos</h4>
                                    <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                </div>
                                <div class="card-body ">
                                    <a href="<?=$ruta?>dash/productos/" title=""><img src="<?=$ruta?>assets/img/comida-rapida.png" alt="" with="300" height="300"></a>
                                    <hr>
                                    <div class="stats">
                                        <i class="nc-icon nc-bulb-63"></i> Haz clic para ir a los productos
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Ventas</h4>
                                    <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                </div>
                                <div class="card-body ">
                                    <a href="<?=$ruta?>dash/ventas/" title=""><img src="<?=$ruta?>assets/img/caja-registradora.png" alt="" with="300" height="300"></a>
                                    <hr>
                                    <div class="stats">
                                        <i class="nc-icon nc-bulb-63"></i>  Haz clic para ir a las ventas
                                    </div>
                                </div>
                            </div>
                        </div>


                            <?php  

                            if(isset($_SESSION['tipoUsuario'])){
                                if($_SESSION['tipoUsuario'] == 1){
                                    ?>

                                     <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card ">
                                            <div class="card-header ">
                                                <h4 class="card-title">Usuarios</h4>
                                                <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                            </div>
                                            <div class="card-body ">
                                                <a href="<?=$ruta?>dash/usuarios/" title=""><img src="<?=$ruta?>assets/img/usuarios.png" alt="" with="300" height="300"></a>
                                                <hr>
                                                <div class="stats">
                                                    <i class="nc-icon nc-bulb-63"></i>  Haz clic para ir a los usuarios
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php

                                }
                            }
                    ?>
                            
                    </div>
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>

 <?php  
  include($ruta.'footer/footer_dashboard.php');
  ?>