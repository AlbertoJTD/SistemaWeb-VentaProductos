<?php
session_start();
 $menu='pedidos';
 $titulo='Pedidos';
 $ruta="../../";
 include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Pedidos.php');

  $pedido = new Pedidos('','','','','','');
  $pedido->setConexion($bd);
  $pedidos=$pedido->readPedidos();


  include($ruta.'dao/EstadoPedido.php');
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
                                            <h4 class="card-title"> Tabla de pedidos</h4>
                                        </div>
                                        <div class="col-md-3">
                                             <a href="formPedido.php" class="btn btn-primary btn-fill btn-round">Registrar pedido</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Total</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            

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
                                            foreach ($pedidos as $pedido) {

                                                $idEstado=$pedido->getId_estado();

                                                //Instanciar las los estados
                                                $estado= new EstadoPedido('','');
                                                $estado->setConexion($bd);

                                                $estado->setId($idEstado);
                                                $estado->readEstadoID();

                                            ?>    
                                              <tr>
                                                <td><?=$pedido->getId()?></td>
                                                <td><?=$pedido->getNombreCliente()?></td>
                                                <td><?=$pedido->getTelefono()?></td>
                                                <td>$ <?=$pedido->getMontoFinal()?></td>
                                                <td><?=$pedido->getFecha()?></td>
                                                <td><?=$estado->getEstado()?></td>
                                                <td><a href="observarPedido.php?idV=<?=$pedido->getId()?>" class="btn btn-info btn-round btn-fill"> Ver más detalles</a></td>
                                                <td><a href="editarPedido.php?id=<?=$pedido->getId()?>" class="btn btn-warning btn-round btn-fill"> Editar</a></td>


                                                <?php  

                                                if(isset($_SESSION['tipoUsuario'])){
                                                    if($_SESSION['tipoUsuario'] == 1){
                                                        ?>

                                                        <td><a href="eliminarPedido.php?id=<?=$pedido->getId()?>" class="btn btn-danger btn-round btn-fill"> Eliminar</a></td>

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