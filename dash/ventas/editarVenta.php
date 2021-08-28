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
?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header " style="background-color: #B1E7FC;">
                                    <h3 class="card-title " style="text-align: center; font-weight: 600;"><strong> <i>Detalles de venta</i> </strong> </h3>
                                    <h4> <strong style="font-weight: 600;">ID: </strong>   <?=$_GET['id']?>  <br>
                                     <strong style="font-weight: 600;">Total de la venta: </strong>  $ <?=$total?> <br>
                                    <strong style="font-weight: 600;">Fecha y hora: </strong>  <?=$fecha?> </h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Productos</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
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
                                        $ventaPro=$ventaProduc->readVentaProductoID();

                                        foreach($ventaPro as $ventaP) {
                                            
                                            $idP=$ventaP->getId_producto();
                                            $unidades=$ventaP->getUnidades();
                                            $precio=$ventaP->getPrecio();

                                            $producto = new Productos('','','','','','');
                                            $producto->setConexion($bd);
                                            $producto->setId($idP);
                                            $producto->readProductoID();

                                            $nombre=$producto->getProducto();
                                            //$precio=$producto->getPrecio();

                                            $subtotal= $precio * $unidades;
                                            
                                            ?>
                                            <tr>
                                                <td><?=$nombre?></td>
                                                <td>$ <?=$precio?></td>
                                                <td>$ <?=$subtotal?></td>
                                                <form action="listaProducto2.php" method="post">
                                                    <td>
                                                        <input class="form-control" type="number" min="0" value="<?=$unidades?>" 
                                                        name="<?=$palabra.$i?>"> 
                                                    
                                                        <input type="hidden" name="<?=$palabra2.$i?>" 
                                                            value="<?=$producto->getId()?>">
                                                    </td>
                                              </tr>
                                            
                                            <?php
                                                $i++;
                                            
                                        }
                                        ?>
                                        

                                        </tbody>
                                    </table>
                                        <input type="hidden" name="i" value="<?=$i?>">
                                        <input type="hidden" name="idVen" value="<?=$idVenta?>">
                                        <button type="submit" class="btn btn-primary btn-fill btn-round "> Finalizar edicion</button>

                                    </form>
                                    <!--<input type="hidden" name="i" value="<?=$i?>">
                                        <button type="submit" class="btn btn-warning btn-fill btn-round "> Agregar más productos</button>-->
                                        <a href="agregarProductos.php?id=<?=$idVenta?>" class="btn btn-warning btn-round btn-fill"> Agregar más productos</a></td>
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