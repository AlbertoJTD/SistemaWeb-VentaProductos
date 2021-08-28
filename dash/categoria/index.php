<?php
session_start();
 $menu='categoria';
 $titulo='Categorias';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Categoria.php');
  $categoria = new Categoria('','');
  $categoria->setConexion($bd);
  $categorias=$categoria->readCategoria();

  include($ruta.'dao/Productos.php');
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
                                            <h4 class="card-title"> Tabla de categorias</h4>
                                        </div>
                                        <div class="col-md-3">

                                            <?php  

                                            if(isset($_SESSION['tipoUsuario'])){
                                               if($_SESSION['tipoUsuario'] == 1){
                                                    ?>

                                                    <a href="formCategoria.php" class="btn btn-primary btn-fill btn-round">Agregar Categoria</a>

                                                    <?php
                                                }
                                            }
                                            ?>
                                             
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Categoria</th>

                                            <?php  

                                            if(isset($_SESSION['tipoUsuario'])){
                                                if($_SESSION['tipoUsuario'] == 1){
                                                    ?>

                                                    <th colspan="2" style="text-align: center;">Acciones</th>

                                                    <?php
                                                }
                                            }
                                            ?>

                                            
                                        </thead>
                                        <tbody>


                                            <?php
                                            foreach ($categorias as $categoria) {
                                                $idCategoria=$categoria->getId();
                                                $producto= new Productos('','','','','','');
                                                $producto->setConexion($bd);

                                                $producto->setId_Categoria($idCategoria);
                                                $existe=$producto->existeCategoria();

                                            ?>
                                              <tr>
                                                <td><?=$categoria->getId()?></td>
                                                <td><?=$categoria->getCategoria()?></td>

                                                <?php  

                                                if(isset($_SESSION['tipoUsuario'])){
                                                    if($_SESSION['tipoUsuario'] == 1){
                                                        ?>

                                                        <td><a href="formCategoria.php?id=<?=$categoria->getId()?>" class="btn btn-warning btn-round btn-fill"> Editar</a></td>
                                                        <td>
                                                    <?php if($existe != true) {?>
                                                    <a href="eliminarCategoria.php?id=<?=$categoria->getId()?>" class="btn btn-danger btn-round btn-fill"> Eliminar</a>
                                                    <?php } ?>
                                                    </td>

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