<?php
session_start();
 $menu='usuarios';
 $titulo='Usuarios';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Usuarios.php');
  $usuario = new Usuarios('','','','','','','');
  $usuario->setConexion($bd);
  $usuarios=$usuario->readUsuarios();

  include($ruta.'dao/TipoUsuario.php');
?>

<?php  

  if($_SESSION['tipoUsuario'] == 1){
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
                                            <h4 class="card-title"> Tabla de usuarios</h4>
                                        </div>
                                        <div class="col-md-3">
                                             <a href="formUsuario.php" class="btn btn-primary btn-fill btn-round ">Agregar usuario</a>
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellido paterno</th>
                                            <th>Apellido materno</th>
                                            <th>Usuario</th>
                                            <!-- <th>Contrase&ntilde;a</th> -->
                                            <th>Tipo usuario</th>
                                            <th colspan="2" style="text-align: center;">Acciones</th>
                                        </thead>
                                        <tbody>


                                            <?php
                                            foreach ($usuarios as $usuario) {
                                                $idU=$usuario->getId_tipoUsuario();

                                                //Instanciar los tipos de usuario
                                                $tipo = new TipoUsuario('','');
                                                $tipo->setConexion($bd);

                                                $tipo->setId($idU);
                                                $tipo->readTipoUsuarioID();

                                            ?>

                                              <tr>
                                                <td><?=$usuario->getId()?></td>
                                                <td><?=$usuario->getNombre()?></td>
                                                <td><?=$usuario->getApellidoP()?></td>
                                                <td><?=$usuario->getApellidoM()?></td>
                                                <td><?=$usuario->getUsuario()?></td>
                                                <!-- <td><?=$usuario->getContra()?></td> -->
                                                <td><?=$tipo->getTipoUsuario()?></td>
                                                <td><a href="formUsuario.php?id=<?=$usuario->getId()?>" class="btn btn-warning btn-round btn-fill"> Editar</a></td>
                                                
                                                <?php  

                                                if(isset($_SESSION['id'])){
                                                    if($_SESSION['id'] == $usuario->getId()){
                                                        ?>
                                                        <td></td>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <td>
                                                            <a href="eliminarUsuario.php?id=<?=$usuario->getId()?>" class="btn btn-danger btn-round btn-fill"> Eliminar</a>
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
    <?php }else{
            
        ?>
        <div class="jumbotron alert-danger">
            <h1 class="display-4">¡Error!</h1>
            <hr class="my-4">
            <h3>No tienes permisos para ver esta sección</i></h3>
            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/" role="button">Regresar al menú principal</a>
        </div>
        <?php

    } ?>

           
        </div>
    </div>

 <?php  
  include($ruta.'footer/footer_dashboard.php');
  ?>