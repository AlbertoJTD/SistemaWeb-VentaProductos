<?php
session_start();
    $menu='usuarios';
    $titulo='Usuarios';
    $ruta="../../";
    include($ruta.'config/Precarga.php');
    include ($ruta.'header/header_dashboard.php');

    include($ruta.'dao/Usuarios.php');
    $usuario = new Usuarios('$id','$nombre','$apellidoP','$apellidoM','$usuario','$contra','$id_tipoUsuario');
    $usuario->setConexion($bd);
    $usuarios=$usuario->readUsuarios();

    $estado=false;

    if(isset($_GET["id"])){ //Saber si existe la variable
      $usuario->setId($_GET["id"]);
      $usuario->readusuarioID();
      $busca=$usuario->getId_tipoUsuario();
      $estado=true;
    }


    include($ruta.'dao/TipoUsuario.php');
    $tipo = new TipoUsuario('','');
    $tipo->setConexion($bd);

    if(isset($_GET["id"])){
        $tipo->setId($busca);
        $tipo->readTipoUsuarioID();
    }
    $tipos=$tipo->readTipoUsuario();

     ?>
     <?php  

  if($_SESSION['tipoUsuario'] == 1){
                    ?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-header">
                                    <h3 class="card-title"><?=isset($_GET["id"])?"Editar":"Agregar"?> Usuario</h3>
                                </div>
                                <div class="card-body">
                                    <form 
                                    action="<?=isset($_GET['id'])?'editarUsuario.php':'agregarUsuario.php'?>" method="post">
                                        <div class="row">

                                            <?php if (isset($_GET['id'])){?>
                                            <div class="col-md-12 pr-1">
                                              <div class="form-group">
                                                <label>Id Usuario</label>
                                                <input type="text" name="id" class="form-control" 
                                                value="<?=$usuario->getId() ?>" readonly>
                                              </div>
                                            </div>
                                            <?php } ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input type="text" class="form-control" placeholder="Nombre" required name="nombre" 
                                                    <?php if(isset($_GET["id"])){ ?>
                                                                value="<?=$usuario->getNombre()?>"
                                                       <?php }?>
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Apellido paterno</label>
                                                    <input type="text" class="form-control" placeholder="Apellido paterno" required name="apellidoP" 
                                                    <?php if(isset($_GET["id"])){ ?>
                                                                value="<?=$usuario->getApellidoP()?>"
                                                       <?php }?>
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Apellido materno</label>
                                                    <input type="text" class="form-control" placeholder="Apellido materno" required name="apellidoM" 
                                                    <?php if(isset($_GET["id"])){ ?>
                                                                value="<?=$usuario->getApellidoM()?>"
                                                       <?php }?>
                                                    >
                                                </div>
                                            </div>

                                        </div>
                                        
                                        <div class="row">

                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Tipo de usuario</label>
                                                    <select name="id_tipoUsuario" class="form-control" required="">
                                                    <?php if(isset($_GET["id"])){?>
                                                            <option value="<?=$usuario->getId_tipoUsuario()?>">
                                                                <?php $esta= $tipo->getTipoUsuario()?>
                                                                <?=$tipo->getTipoUsuario()?> 
                                                            </option>
                                                    <?php }else{?>
                                                            <option value=""> Selecciona un tipo de usuario</option>
                                                    <?php } ?>
                                                        
                                                         
                                                    <?php 
                                                        foreach ($tipos as $tipo){
                                                            if(isset($_GET["id"])){ ?>
                                                                <?php if($esta != $tipo->getTipoUsuario()){ ?>
                                                                    <option value="<?=$tipo->getId()?>">
                                                                        <?=$tipo->getTipoUsuario()?> 
                                                                    </option>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                
                                                                <option value="<?=$tipo->getId()?>">
                                                                    <?=$tipo->getTipoUsuario()?> 
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>

                                            <!-- -->
                                            <?php 
                                            if($estado == false){ ?>

                                                
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label>Nombre de usuario</label>
                                                        <input type="text" class="form-control" placeholder="Nombre" required name="user">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label>Contrase&ntilde;a</label>
                                                        <input type="password" class="form-control" placeholder="Contrase&ntilde;a" required name="pass">
                                                    </div>
                                                </div>
                                            
                                            
                                            <?php }else{?>

                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label>Nombre de usuario</label>
                                                        <input type="text" class="form-control" placeholder="Nombre" required name="user" 
                                                        value="<?=$usuario->getUsuario()?>">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                             

                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill btn-round"><?=isset($_GET["id"])?"Editar":"Agregar"?> usuario</button>
                                        <div class="clearfix"></div>
                                    </form>

                                </div>
                            </div>
                             
                        <?php 
                        if($estado == true){ ?>
                            <br>
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-dark">
                                                <div class="card-header">
                                                    <h3 class="card-title">Cambiar contrase&ntilde;a</h3>
                                                </div>

                                                <div class="card-body">
                                                    <form action="editarPass.php" method="post" accept-charset="utf-8">

                                                         <input type="hidden" name="id" 
                                                            value="<?=$usuario->getId()?>">
                                                        <div class="row">
                                                                    
                                                            <div class="col-md-4 pr-1">
                                                                <div class="form-group">
                                                                    <label>Contrase&ntilde;a actual</label>
                                                                    <input type="password" class="form-control" placeholder="Contrase&ntilde;a " required name="contraAc">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 pr-1">
                                                                <div class="form-group">
                                                                    <label>Nueva contrase&ntilde;a</label>
                                                                    <input type="password" class="form-control" placeholder="Nombre" required name="newContra1">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4 pr-1">
                                                                <div class="form-group">
                                                                    <label>Confirmar contrase&ntilde;a</label>
                                                                    <input type="password" class="form-control" placeholder="Nombre" required name="newContra2">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <button type="submit" class="btn btn-info btn-fill btn-round">Editar contrase&ntilde;a</button>
                                                        <div class="clearfix"></div>
                                                        
                                                    </form>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                            
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
        
   <?php } ?>

<?php 
include($ruta.'footer/footer_dashboard.php');
 ?>
