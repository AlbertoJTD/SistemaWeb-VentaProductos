<?php
 session_start();
 $menu='productos';
 $titulo='Productos';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Productos.php');
  
  $producto = new Productos('','','','','','');
  $producto->setConexion($bd);
  $productos=$producto->readProducto();

  include($ruta.'dao/Categoria.php');
  include($ruta.'dao/EstadoProducto.php');
  include($ruta.'dao/Ventas_Productos.php');


  //include($ruta.'dao/Categoria.php');
  $categoria = new Categoria('','');
  $categoria->setConexion($bd);
  $categorias=$categoria->readCategoria();


  //Buscar productos
  $categoria=$_POST['categoria'];
  $nombre=$_POST['buscar'];

  //Si ambas variables se mantienen en false, significa que tienen un valor
  $categoriaVacia=false;
  $nombreVacio=false;


  //No se selecciono ningun valor
  if($categoria == 'vacio' && $nombre == ''){
    //echo "Ambos estan vacios<br>";
    $categoriaVacia=true;
    $nombreVacio=true;
  }

  //Solo el nombre tiene un valor
  if($categoria == 'vacio' ){
    //echo "La categoria esta vacia<br>";
    $categoriaVacia=true;
  }

  //Solo se ha seleccionado una categoria
  if($nombre == ''){
    //echo "El nombre esta vacio";
    $nombreVacio=true;
  }

?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header alert-info">
                                    

                                            <?php  
                                            //No tienen valor 1
                                            if($categoriaVacia == true && $nombreVacio == true){
                                                ?>
                                                <h4 class="card-title" style="text-align: center;"> <strong>Búsqueda de productos</strong></h4>
                                                <?php

                                            //Ambas tienen un valor 2
                                            }else if($categoriaVacia == false && $nombreVacio == false){

                                                ?>
                                                <h4 class="card-title" style="text-align: center;"> <strong>Búsqueda de productos</strong></h4>
                                                <h5 class="card-title"> <strong>Categoria = </strong>  <?=$categoria?></h5>
                                                <h5 class="card-title"> <strong>Nombre = </strong> <?=$nombre?></h5>
                                                <?php

                                            //Solo la categoria tien un valor 3
                                            }else if($categoriaVacia == false && $nombreVacio == true){

                                                ?>
                                                <h4 class="card-title" style="text-align: center;"><strong>Búsqueda de productos</strong></h4>
                                                <h5 class="card-title"> <strong>Categoria = </strong> <?=$categoria?></h5>
                                                <?php

                                            //Solo el nombre tiene un valor 4
                                            }else if($categoriaVacia == true && $nombreVacio == false){

                                                ?>
                                               <h4 class="card-title" style="text-align: center;"><strong>Búsqueda de productos</strong></h4>
                                                <h5 class="card-title"><strong>Nombre = </strong> <?=$nombre?></h5>
                                                <?php

                                            }
                                            ?>
                                   
                                </div>

                                <?php 
                                //No tienen valor 1
                                if($categoriaVacia == true && $nombreVacio == true){
                                    ?>

                                    <div class="jumbotron alert-warning">
                                        <h1 class="display-4">¡Error!</h1>
                                        <hr class="my-4">
                                        <h3>No se ha seleccionado una categoria o se ha escrito un nombre</h3>
                                        <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                    </div>

                                    <?php
                                //Ambas tienen un valor 2
                                }else if($categoriaVacia == false && $nombreVacio == false){


                                //Solo la categoria tien eun valor 3
                                }else if($categoriaVacia == false && $nombreVacio == true){


                                //Solo el nombre tiene un valor 4
                                }else if($categoriaVacia == true && $nombreVacio == false){

                                }
                                
                                ?>
                                
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Contenido</th>
                                            <th>Precio</th>
                                            <th>Categoria</th>
                                            <th>Estado</th>
                                            
                                        </thead>
                                        <tbody>


                                            <?php
                                            foreach ($productos as $producto) {
                                                $idC=$producto->getId_Categoria();

                                                //Instanciar las categorias
                                                //$categoria = new Categoria('','');
                                                $categoria->setConexion($bd);

                                                $categoria->setId($idC);
                                                $categoria->readCategoriaID();


                                                //Instanciar los estados
                                                $idE=$producto->getId_Estado();
                                                $estado = new EstadoProducto('','');
                                                $estado->setConexion($bd);

                                                $estado->setId($idE);
                                                $estado->readEstadoID();


                                                //Instanciar los venta_productos
                                                $idProduc=$producto->getId();
                                                $ventaProduc = new Ventas_Productos('','','','');
                                                $ventaProduc->setConexion($bd);

                                                $ventaProduc->setId_producto($idProduc);
                                                $existe=$ventaProduc->existeProducto();

                                            ?>


                                              <tr>
                                                <td><?=$producto->getId()?></td>
                                                <td><?=$producto->getProducto()?></td>
                                                <td><?=$producto->getContenido()?></td>
                                                <td>$ <?=$producto->getPrecio()?></td>
                                                <td> <?=$categoria->getCategoria()?></td>
                                                <td> <?=$estado->getEstado()?></td>
                                                
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