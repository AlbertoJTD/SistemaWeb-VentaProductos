<?php
session_start();
 $menu='pedidos';
 $titulo='Pedidos';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  
  include ($ruta.'dao/Productos.php');
    $producto = new Productos('$id','$producto','$contenido','$precio','$id_categoria','$id_estado');
    $producto->setConexion($bd);
    

    //ID de la venta al que pertecen los productos
    //Variables del post
    $idPedido=$_POST['idPedido'];
    $nombre=$_POST['nombre'];
    $tel=$_POST['telefono'];
    $estadoPed=$_POST['estadoPedido'];


     if(isset($_GET["id"])){ //Saber si existe la variable
      $producto->setId($_GET["id"]);
      $producto->readProductoID();
    }
    
    $productos=$producto->readProducto();


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

    
    include($ruta.'dao/Pedidos.php');
    include($ruta.'dao/Pedidos_Productos.php');

    include($ruta.'dao/Ventas.php');
    include($ruta.'dao/Ventas_Productos.php');
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
                                    <h4 class="card-title "> El pedido ha sido actualizado</h4>
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
                                            $y=0;

                                            for($i=0; $i<$num; $i++){
                                                
                                                $unidades=$_POST['unidades'.$i];
                                                $idProducto=$_POST['idProducto'.$i];
                                                
                                                if($unidades != 0){
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


                                                    //NOTA: Si el ID del estado == 1, insertar la venta tambien en el latabla de ventas y ventas_productos


                                                     //Si el ID de estado es igual a 1, significa que ya fue entregado
                                                    if($estadoPed == 1){

                                                        if($y == 0){
                                                            $venta = new Ventas('',$total,'');
                                                            $venta->setConexion($bd);
                                                            if($venta->createVenta()){
                                                                //echo "bien";
                                                                $y++;
                                                            }else{
                                                                echo "Lo siento chavo no se pudo :c";
                                                            }

                                                            $venta2 = new Ventas('','',''); 
                                                            $venta2->setConexion($bd);
                                                            $max2=$venta2->maxID();
                                                        }

                                                        //echo "El id del producto es: $idP <br>";
                                                        //echo "El id maximo de la venta es: $max <br>";
                                                        //echo "El numero de unidades es: $unidades <br>";
                                                        $ventaProduc = new Ventas_Productos($idP,$max2,$unidades,$precio);
                                                        $ventaProduc->setConexion($bd);
                                                        if($ventaProduc->createVentaProducto()){
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


                                            //Actualizar el total de la venta
                                            //$pedido= new Pedidos($idVenta,$total,'');

                                            $pedido= new Pedidos($idPedido,$nombre,$tel,$total,'',$estadoPed);

                                            $pedido->setConexion($bd);
                                            $pedido->updatePedido();
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