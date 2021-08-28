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

  $idPedido= $_GET['id'];
    if(isset($_GET["id"])){ //Saber si existe la variable
        $pedido->setId($_GET["id"]);
        $pedido->readPedidoID();
        //$total=$pedido->getTotal();
        //$fecha=$pedido->getFecha();
    }
                                    
  $pedidos=$pedido->readPedidos();

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/Pedidos_Productos.php');


//include($ruta.'dao/Productos.php');
  
  $producto = new Productos('','','','','','');
  $producto->setConexion($bd);
  $productos=$producto->readProducto();


?>
            
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title "> Agregar productos al pedido</h4>
                                    
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Contenido</th>
                                            <th>Precio</th>
                                            <th>id_categoria</th>
                                            <th>Unidades</th>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        
                                        $i=0;

                                        $palabra='unidades';
                                        $palabra2='idProducto';

                                        $pedidoProduc = new Pedidos_Productos('','','','');
                                        $pedidoProduc->setConexion($bd);
                                        $pedidoProduc->setId_pedido($_GET['id']);
                                        $pedidoPro=$pedidoProduc->distinc();

                                        foreach($pedidoPro as $pedidoP) {
                                            
                                            $idP=$pedidoP->getId_producto();

                                            $producto->setId($_GET["id"]);
                                            //$unidades=$ventaP->getUnidades();
                                            //$precio=$ventaP->getPrecio();

                                            $producto = new Productos('','','','','','');
                                            $producto->setConexion($bd);
                                            $producto->setId($idP);
                                            $producto->readProductoID();

                                            $nombre=$producto->getProducto();
                                            $precio=$producto->getPrecio();
                                            $contenido=$producto->getContenido();
                                            $categoria=$producto->getId_Categoria();

                                            //Nota: Instanciar a las categorias y obtener su nombre


                                            $pedidoProduc2 = new Pedidos_Productos($idP,$idPedido,'','');
                                            $pedidoProduc2->setConexion($bd);
                                            $existeProducto = $pedidoProduc2->existeProductoEnPedidoID();

                                            //Saber si existe el producto en la venta
                                            if($existeProducto == true){
                                                $unidades = $pedidoProduc2->obtenerUnidadesID();
                                            }


                                            ?>
                                            <tr>
                                                <td><?=$idP?></td>
                                                <td><?=$nombre?></td>
                                                <td><?=$contenido?></td>
                                                <td>$ <?=$precio?></td>
                                                <td><?=$categoria?></td>
                                                <form action="actualizarPedido.php" method="post">
                                                    <td>
                                                        <input class="form-control" type="number" min="0" 
                                                        <?php  
                                                        //Si existe aigna el numero de unidades
                                                        if($existeProducto == true){
                                                            ?> 
                                                            value="<?=$unidades?>"
                                                      <?php //Si no existe, entonces se coloca un 0
                                                           }else{  ?> 
                                                            value="0"
                                                    <?php   } ?> 
                                                        name="<?=$palabra.$i?>"> 
                                                    
                                                        <input type="hidden" name="<?=$palabra2.$i?>" 
                                                            value="<?=$idP?>">
                                                    </td>
                                              </tr>
                                            
                                            <?php
                                                $i++;
                                            
                                        }

?>


                                        </tbody>
                                    </table>
                                        <input type="hidden" name="i" value="<?=$i?>">
                                        <input type="hidden" name="pedidoID" value="<?=$idPedido?>">
                                        <button type="submit" class="btn btn-primary btn-fill btn-round "> Finalizar pedido</button>

                                    </form>


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