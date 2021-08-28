<?php
session_start();
 $menu='ventas';
 $titulo='Ventas';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Ventas.php');
  $venta = new Ventas('','','');
  $venta->setConexion($bd);
  $ventas=$venta->readVenta();
?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <div class="row">
                                        <div class="col-md-9 ">
                                            <h4 class="card-title"> Tabla de ventas</h4>
                                        </div>
                                        <div class="col-md-3">
                                             <a href="formVenta.php" class="btn btn-primary btn-fill btn-round">Registrar venta</a>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Total</th>
                                            <th>Fecha</th>

                                            <?php  

                                            if(isset($_SESSION['tipoUsuario'])){
                                                if($_SESSION['tipoUsuario'] == 1){
                                                    ?>

                                                    <th colspan="3" style="text-align: center;">Acciones</th>

                                                    <?php
                                                }else{

                                                    ?>
                                                    <th colspan="2" style="text-align: center;">Acciones</th>
                                                    <?php

                                                }
                                            }
                                            ?>

                                            
                                        </thead>
                                        <tbody>


                                            <?php
                                            foreach ($ventas as $venta) {?>
                                              <tr>
                                                <td><?=$venta->getId()?></td>
                                                <td>$ <?=$venta->getTotal()?></td>
                                                <td>  <?=$venta->getFecha()?></td>
                                                <td><a href="observarVenta.php?idV=<?=$venta->getId()?>" class="btn btn-info btn-round btn-fill"> Ver más detalles</a></td>
                                                <td><a href="editarVenta.php?id=<?=$venta->getId()?>" class="btn btn-warning btn-round btn-fill"> Editar</a></td>

                                                <?php  

                                                if(isset($_SESSION['tipoUsuario'])){
                                                  if($_SESSION['tipoUsuario'] == 1){
                                                        ?>

                                                        <td><a href="eliminarVenta.php?id=<?=$venta->getId()?>" class="btn btn-danger btn-round btn-fill"> Eliminar</a></td>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                                
                                              </tr>
                                            <?php } ?>


                                        </tbody>
                                    </table>
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