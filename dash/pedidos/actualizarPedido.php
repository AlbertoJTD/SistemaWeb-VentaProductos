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

  $idPedido= $_POST['pedidoID'];
    if(isset($_GET["id"])){ //Saber si existe la variable
        $pedido->setId($_GET["id"]);
        $pedido->readPedidoID();
        $total=$pedido->getTotal();
        $fecha=$pedido->getFecha();
    }
                                    
  $pedidos=$pedido->readPedidos();

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/Pedidos_Productos.php');

 //include ($ruta.'dao/Productos.php');
    $producto = new Productos('$id','$producto','$contenido','$precio','$id_categoria','$id_estado');
    $producto->setConexion($bd);

  //Saber si existen unidades de un producto o no
    $estado=false;
    $cantidad=0;
    $num=$_POST['i'];

    for($i=0; $i<$num; $i++){
        $unidades=$_POST['unidades'.$i];
        if($unidades == 0){
            $cantidad++;
        }
    }
    

    //Cambia a true cuando las todos los productos tienen como unidades 0
    if($cantidad == $num){
        $estado=true;
    }


?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                
                                <?php
                                //Si es falso, significa que existe al menos 1 producto seleccionado
                                 if($estado ==  false) {?>
                                <div class="card-header ">
                                    <h4 class="card-title"> El pedido ha sido actualizado</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Producto</th>
                                            <th>Unidades</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $num=$_POST['i'];
                                            $total = 0;

                                            //Obtener el total de la venta
                                            for($i=0; $i<$num; $i++){
                                                $unidades=$_POST['unidades'.$i];
                                                $idProducto=$_POST['idProducto'.$i];
                                                
                                                if($unidades != 0){
                                                    $producto->setId($idProducto);  
                                                    $producto->readProductoID();

                                                    $precio=$producto->getPrecio();
                                                    $subtotal=$precio * $unidades;

                                                    $total=$total+$subtotal;
                                                }
                                            }

                                            //
                                            for($i=0; $i<$num; $i++){
                                                
                                                $unidades=$_POST['unidades'.$i];
                                                $idProducto=$_POST['idProducto'.$i];
                                                
                                                if($unidades != 0){


                                                    $pedidoProduc2 = new Pedidos_Productos($idProducto,$idPedido,'','');
                                                    $pedidoProduc2->setConexion($bd);
                                                    //Saber si existe el producto en la venta
                                                    $existeProducto = $pedidoProduc2->existeProductoEnPedidoID();

                                                    //Si existen, entonces actualiza la tabla
                                                    if($existeProducto == true){

                                                        $producto->setId($idProducto);  
                                                        $producto->readProductoID();

                                                        $precio=$producto->getPrecio();

                                                        $subtotal=$precio * $unidades;

                                                        $idP=$producto->getId();
                                                        ?>
                                                        <tr>
                                                            <td><?=$producto->getProducto()?></td>
                                                            <td><?=$unidades?></td>
                                                            <td>$ <?=$producto->getPrecio()?></td>
                                                            <td>$ <?=$subtotal?></td>
                                                        </tr>

                                                        
                                                        <?php

                                                        //Obtener el id de la venta y sobre ese mismo actualizar la tabla de ventas_productos

                                                        $pedidoProduc = new Pedidos_Productos($idP,$idPedido,$unidades,'');
                                                        $pedidoProduc->setConexion($bd);
                                                        if($pedidoProduc->updatePedidoProducto()){
                                                            //echo "bien";
                                                        }else{
                                                            echo "Algo salio mal";
                                                        }

                                                    }else{
                                                        
                                                        //Si no existe,entonces se debe de insertar el nuevo registro en la tabla pedidos_productos

                                                        $producto->setId($idProducto);  
                                                        $producto->readProductoID();

                                                        $precio=$producto->getPrecio();

                                                        $subtotal=$precio * $unidades;

                                                        $idP=$producto->getId();

                                                        ?>
                                                        <tr>
                                                            <td><?=$producto->getProducto()?></td>
                                                            <td><?=$unidades?></td>
                                                            <td>$ <?=$producto->getPrecio()?></td>
                                                            <td>$ <?=$subtotal?></td>
                                                        </tr>

                                                        
                                                        <?php

                                                        $pedidoProduc = new Pedidos_Productos($idP,$idPedido,$unidades,$precio);
                                                        $pedidoProduc->setConexion($bd);
                                                        if($pedidoProduc->createPedidoProducto()){
                                                            //echo "bien";
                                                        }else{
                                                            echo "Algo salio mal";
                                                        }

                                                    }


                                                //Si la unidad es igual a 0, entonces eliminar ese producto de la venta
                                                }else if($unidades == 0){

                                                    //obtener el id producto y el id de la venta

                                                    $pedidoProduc = new Pedidos_Productos($idProducto,$idPedido,'','');
                                                    $pedidoProduc->setConexion($bd);
                                                    if($pedidoProduc->deletePedidoProducto()){
                                                        //echo "bien";
                                                    }else{
                                                        echo "Algo salio mal";
                                                    }
                                                }
                                            }


                                            //Actualizar el total deLpedido
                                            //$pedido= new Pedidos($idPedido,$total,'');

                                            $pedido= new Pedidos($idPedido,'','',$total,'','');

                                            $pedido->setConexion($bd);
                                            $pedido->updatePedidoMontoFinal();
                                            ?>
                                            <?php if($total != 0){ ?>
                                               <tr class="">
                                                    <td colspan="3" class="" align="right"><b>El total es de: </b></td>
                                                    <td class=""><b>$ <?=$total?></b></td>
                                                </tr>
                                           <?php }?>
                                        </tbody>

                                    </table>

                                        
                                    </div>

                                <?php }else{ 

                                        for($i=0; $i<$num; $i++){
                                            $idProducto=$_POST['idProducto'.$i];
                                                        //obtener el id producto y el id de la venta

                                            $pedidoProduc = new Pedidos_Productos($idProducto,$idPedido,'','');
                                            $pedidoProduc->setConexion($bd);
                                            if($pedidoProduc->deletePedidoProducto()){
                                                //echo "bien";
                                            }else{
                                                echo "Algo salio mal";
                                            }
                                            //}
                                        }

                                        $pedido = new Pedidos($idPedido,'','','','','');
                                        $pedido->setConexion($bd);
                                        
                                        if($pedido->deletePedido()){
                                            //echo "bien";
                                            //$x++;
                                        }else{
                                            echo "Lo siento chavo no se pudo :c";
                                        }

                                        ?>

                                        <div class="jumbotron alert-success">
                                              <h1 class="display-4">¡Éxito!</h1>
                                              <hr class="my-4">
                                              <h4>Se ha borrado la venta</p>
                                              <a class="btn btn-primary btn-lg" href="index.php" role="button">Regresar al menú principal</a>
                                        </div>
                            <?php } ?>

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