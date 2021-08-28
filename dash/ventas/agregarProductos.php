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

  $idVenta= $_GET['id'];
    if(isset($_GET["id"])){ //Saber si existe la variable
        $venta->setId($_GET["id"]);
        $venta->readVentaID();
        $total=$venta->getTotal();
        $fecha=$venta->getFecha();
    }
                                    
  $ventas=$venta->readVenta();

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/Ventas_Productos.php');


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
                                    <h4 class="card-title"> Agregar productos a la venta</h4>
                                    
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Unidades</th>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        
                                        $i=0;

                                        $palabra='unidades';
                                        $palabra2='idProducto';

                                        $ventaProduc = new Ventas_Productos('','','','');
                                        $ventaProduc->setConexion($bd);
                                        $ventaProduc->setId_venta($_GET['id']);
                                        $ventaPro=$ventaProduc->distinc();

                                        foreach($ventaPro as $ventaP) {
                                            
                                            $idP=$ventaP->getId_producto();

                                            $producto->setId($_GET["id"]);
                                            //$unidades=$ventaP->getUnidades();
                                            //$precio=$ventaP->getPrecio();

                                            $producto = new Productos('','','','','','');
                                            $producto->setConexion($bd);
                                            $producto->setId($idP);
                                            $producto->readProductoID();

                                            $nombre=$producto->getProducto();
                                            $precio=$producto->getPrecio();


                                            $ventaProduc2 = new Ventas_Productos($idP,$idVenta,'','');
                                            $ventaProduc2->setConexion($bd);
                                            $existeProducto = $ventaProduc2->existeProductoEnVentaID();

                                            //Saber si existe el producto en la venta
                                            if($existeProducto == true){
                                                $unidades = $ventaProduc2->obtenerUnidadesID();
                                            }


                                            ?>
                                            <tr>
                                                <td><?=$idP?></td>
                                                <td><?=$nombre?></td>
                                                <td>$ <?=$precio?></td>
                                                <form action="actualizarVenta.php" method="post">
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
                                        <input type="hidden" name="ventaID" value="<?=$idVenta?>">
                                        <button type="submit" class="btn btn-primary btn-fill btn-round "> Finalizar venta</button>

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