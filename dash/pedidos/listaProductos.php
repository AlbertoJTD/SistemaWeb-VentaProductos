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
    
     if(isset($_GET["id"])){ //Saber si existe la variable
      $producto->setId($_GET["id"]);
      $producto->readProductoID();
    }
    
    $productos=$producto->readProducto();


     //Variables del formulario
    $nombreCliente = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $idEstado = 2;

    //Saber si se ha seleccionado un producto o no
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
                                    <h4 class="card-title"> Productos seleccionados</h4>
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
                                            for($i=0; $i<$num; $i++){
                                                //echo "El valor de i es: ".$num;
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

                                            //$sinProductos=0;
                                            $x=0;
                                            $y=0;

                                            for($i=0; $i<$num; $i++){
                                                //echo "El valor de i es: ".$num;
                                                $unidades=$_POST['unidades'.$i];
                                                $idProducto=$_POST['idProducto'.$i];
                                                
                                                if($unidades != 0){
                                                    $producto->setId($idProducto);  
                                                    $producto->readProductoID();

                                                    //$nombre=$producto->getProducto();
                                                    $precio=$producto->getPrecio();

                                                    $subtotal=$precio * $unidades;

                                                    //echo "El subtotal es: $subtotal <br>";
                                                    //$total=$total+$subtotal;

                                                    $idP=$producto->getId();
                                                    ?>
                                                    <tr>
                                                        <td><?=$producto->getProducto()?></td>
                                                        <td><?=$unidades?></td>
                                                        <td>$ <?=$producto->getPrecio()?></td>
                                                        <td>$ <?=$subtotal?></td>
                                                    </tr>

                                                    
                                                    <?php
                                                    if($x == 0){
                                                        $pedido = new Pedidos('',$nombreCliente,$telefono,$total,'',$idEstado);
                                                        $pedido->setConexion($bd);
                                                        if($pedido->createPedido()){
                                                            //echo "bien";
                                                            $x++;
                                                        }else{
                                                            echo "Lo siento chavo no se pudo :c";
                                                        }

                                                        $pedido2 = new Pedidos('','','','','',''); 
                                                        $pedido2->setConexion($bd);
                                                        $max=$pedido2->maxID();
                                                    }



                                                    //echo "El id del producto es: $idP <br>";
                                                    //echo "El id maximo del pedido es: $max <br>";
                                                    //echo "El numero de unidades es: $unidades <br>";
                                                    //echo "El precio es: $precio <br>";
                                                    
                                                    $pedidoProduc = new Pedidos_Productos($idP,$max,$unidades,$precio);
                                                    $pedidoProduc->setConexion($bd);

                                                    if($pedidoProduc->createPedidoProducto()){
                                                        //echo "bien";
                                                    }else{
                                                        echo "Algo salio mal";
                                                    }




                                                    //Si el ID de estado es igual a 1, significa que ya fue entregado
                                                    if($idEstado == 1){

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






                                                }
                                            }

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

                                <?php }else{ ?>
                                    <div class="jumbotron alert-warning">
                                          <h1 class="display-4">¡Ha ocurrido un error!</h1>
                                          <hr class="my-4">
                                          <h4>No se ha seleccionado ningún producto, te sugerimos seleccionar al menos un producto.</p>
                                          <a class="btn btn-primary btn-lg" href="formPedido.php" role="button">Regresar al pedido</a>
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