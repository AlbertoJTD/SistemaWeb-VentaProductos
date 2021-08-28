<?php
session_start(); 
 $menu='ventas';
 $titulo='Ventas';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Productos.php');
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
                                    <h3 class="card-title"><?=isset($_GET["id"])?"Editar":"Registrar"?> venta</h3>
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

                                            foreach ($productos as $producto) {
                                                //Instanciar las categorias
                                                //$categoria = new Categoria('','');
                                                

                                                ?>
                                              <tr>
                                                <td><?=$producto->getId()?></td>
                                                <td><?=$producto->getProducto()?></td>
                                                <td>$ <?=$producto->getPrecio()?></td>
                                                <form action="listaProducto.php" method="POST">
                                                    <td>
                                                        <input class="form-control" type="number" min="0" value="0" 
                                                        name="<?=$palabra.$i?>"> 
                                                    
                                                        <input type="hidden" name="<?=$palabra2.$i?>" 
                                                            value="<?=$producto->getId()?>">
                                                    </td>
                                              </tr>
                                                
                                                
                                            <?php 

                                                $i++;
                                            } ?>


                                        </tbody>
                                    </table>
                                        <input type="hidden" name="i" value="<?=$i?>">
                                        <button type="submit" class="btn btn-primary btn-fill btn-round "> Visualizar venta</button>

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