<?php
session_start();
 $menu='ventas';
 $titulo='Ventas';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Ventas.php');
  $venta = new Ventas('','','','','');
  $venta->setConexion($bd);

  $idVenta= $_POST['ventaID'];
    if(isset($_GET["id"])){ //Saber si existe la variable
        $venta->setId($_GET["id"]);
        $venta->readVentaID();
        $total=$venta->getTotal();
        $fecha=$venta->getFecha();
    }
                                    
  $ventas=$venta->readVenta();

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/Ventas_Productos.php');

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
                                    <h4 class="card-title"> La venta ha sido actualizada</h4>
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


                                                    $ventaProduc2 = new Ventas_Productos($idProducto,$idVenta,'','');
                                                    $ventaProduc2->setConexion($bd);
                                                    //Saber si existe el producto en la venta
                                                    $existeProducto = $ventaProduc2->existeProductoEnVentaID();

                                                    //Si existen entonces actualiza la tabla
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

                                                        $ventaProduc = new Ventas_Productos($idP,$idVenta,$unidades,'');
                                                        $ventaProduc->setConexion($bd);
                                                        if($ventaProduc->updateVentaProducto()){
                                                            //echo "bien";
                                                        }else{
                                                            echo "Algo salio mal";
                                                        }

                                                    }else{
                                                        
                                                        //Si no existe,entonces se debe de insertar el nuevo registro en la tabla ventas_productos

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

                                                        $ventaProduc = new Ventas_Productos($idP,$idVenta,$unidades,$precio);
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

                                                    $ventaProduc = new Ventas_Productos($idProducto,$idVenta,'','');
                                                    $ventaProduc->setConexion($bd);
                                                    if($ventaProduc->deleteProductoVenta()){
                                                        //echo "bien";
                                                    }else{
                                                        echo "Algo salio mal";
                                                    }
                                                }
                                            }


                                            //Actualizar el total de la venta
                                            $venta= new Ventas($idVenta,$total,'');
                                            $venta->setConexion($bd);
                                            $venta->updateVenta();
                                            ?>
                                            <?php if($total != 0){ ?>
                                               <tr class="">
                                                    <td colspan="3" class="" align="right"><b>El total es de: </b></td>
                                                    <td class=""><b>$ <?=$total?></b></td>
                                                </tr>
                                           <?php }?>
                                        </tbody>

                                    </table>

                                        <div class="col-md-5">
                                                <br>
                                                <h3>Dinero recibido: </h3>
                                                <form action="cambio.php" method="post" accept-charset="utf-8">
                                                    <input type="number" name="pago" min="<?=$total?>" value="" class="form-control" placeholder="$ Dinero" required>
                                                    <br>

                                                
                                                    <input type="hidden" name="total" value="<?=$total?>">
                                                    <button type="submit" name="" class="btn btn-primary btn-fill btn-round"> Finalizar venta</button>
                                                </form>
                                        </div>
                                    </div>

                                <?php }else{ 

                                        for($i=0; $i<$num; $i++){
                                            $idProducto=$_POST['idProducto'.$i];
                                                        //obtener el id producto y el id de la venta

                                            $ventaProduc = new Ventas_Productos($idProducto,$idVenta,'','');
                                            $ventaProduc->setConexion($bd);
                                            if($ventaProduc->deleteProductoVenta()){
                                                //echo "bien";
                                            }else{
                                                echo "Algo salio mal";
                                            }
                                            //}
                                        }

                                        $venta = new Ventas($idVenta,'','');
                                        $venta->setConexion($bd);
                                        
                                        if($venta->deleteVenta()){
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