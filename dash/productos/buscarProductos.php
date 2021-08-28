<?php 
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['nombre'])){
        header("location: ../index.php");
    }else{
        //Verificar que el nombre del usuario seal el mismo, sino cambiarlo
        //Verificar que el el tipo de usuario sea el mismo,sino cambiarlo
        
    }
?>

<?php 
 $menu='productos';
 $titulo='Productos';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  //include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Productos.php');
  
  $producto = new Productos('','','','','','');
  $producto->setConexion($bd);
  $productos=$producto->readProducto();

  include($ruta.'dao/Categoria.php');
  include($ruta.'dao/EstadoProducto.php');
  include($ruta.'dao/Ventas_Productos.php');


    //Buscar productos
  $categoriaForm=$_POST['categoria'];
  $nombre=$_POST['buscar'];

  //include($ruta.'dao/Categoria.php');
  $categoria = new Categoria('','');
  $categoria->setConexion($bd);
  
  
  if($categoriaForm != 'vacio' ){
    $categoria->setId($categoriaForm); 
    $categoria->readCategoriaID();
    $nombreCategoria=$categoria->getCategoria();
  }

  $categorias=$categoria->readCategoria();


  //Si ambas variables se mantienen en false, significa que tienen un valor
  $categoriaVacia=false;
  $nombreVacio=false;


  //No se selecciono ningun valor
  if($categoriaForm == 'vacio' && $nombre == ''){
    //echo "Ambos estan vacios<br>";
    $categoriaVacia=true;
    $nombreVacio=true;
  }

  //Solo el nombre tiene un valor
  if($categoriaForm == 'vacio' ){
    //echo "La categoria esta vacia<br>";
    $categoriaVacia=true;
  }

  //Solo se ha seleccionado una categoria
  if($nombre == ''){
    //echo "El nombre esta vacio";
    $nombreVacio=true;
  }

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$ruta?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?=$ruta?>assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>New York Cafe ☕</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?=$ruta?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=$ruta?>assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?=$ruta?>assets/css/demo.css" rel="stylesheet" />

    <style type="text/css" media="screen">
        #titulo1{
          font-family: 'Courgette', cursive;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="<?=$ruta?>assets/img/comida.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="<?=$ruta?>dash/" class="simple-text">
                        NEW YORK CAFE
                    </a>
                </div>
                <ul class="nav">


                    <?php if($menu == 'dashboard'){?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?=$ruta?>dash/">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                <?php }else{ ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?=$ruta?>dash/">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                <?php } ?>



                 <?php if($menu == 'resumen'){?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?=$ruta?>dash/resumen/">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Resumen</p>
                        </a>
                    </li>
                <?php }else{ ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?=$ruta?>dash/resumen/">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Resumen</p>
                        </a>
                    </li>
                <?php } ?>


                    <?php if($menu == 'productos'){?>
                    <li class="active">
                        <a class="nav-link" href="<?=$ruta?>dash/productos/">
                            <i class="nc-icon nc-layers-3"></i>
                            <p>Productos</p>
                        </a>
                    </li>
                <?php }else{ ?>

                    <li>
                        <a class="nav-link" href="<?=$ruta?>dash/productos/">
                            <i class="nc-icon nc-layers-3"></i>
                            <p>Productos</p>
                        </a>
                    </li>
                <?php } ?>


                <?php if($menu == 'categoria'){?>
                    <li class="active">
                        <a class="nav-link" href="<?=$ruta?>dash/categoria/">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Categorias</p>
                        </a>
                    </li>
                <?php }else{ ?>
                    <li>
                        <a class="nav-link" href="<?=$ruta?>dash/categoria/">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Categorias</p>
                        </a>
                    </li>
                <?php } ?>


                <?php if($menu == 'ventas'){?>
                    <li class="active">
                        <a class="nav-link" href="<?=$ruta?>dash/ventas/">
                            <i class="nc-icon nc-notes"></i>
                            <p>Ventas</p>
                        </a>
                    </li>
                <?php }else{ ?>
                    <li>
                        <a class="nav-link" href="<?=$ruta?>dash/ventas/">
                            <i class="nc-icon nc-notes"></i>
                            <p>Ventas</p>
                        </a>
                    </li>
                <?php } ?>


                 <?php if($menu == 'pedidos'){?>
                    <li class="active">
                        <a class="nav-link" href="<?=$ruta?>dash/pedidos/">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Pedidos</p>
                        </a>
                    </li>
                <?php }else{ ?>
                    <li>
                        <a class="nav-link" href="<?=$ruta?>dash/pedidos/">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Pedidos</p>
                        </a>
                    </li>
                <?php } ?>



               <?php  

                if(isset($_SESSION['tipoUsuario'])){
                    //echo "Si existe";
                    if($_SESSION['tipoUsuario'] == 1){
                        //echo "El tipo de usuario es-> ".$_SESSION['tipoUsuario'];
                        ?>

                        <?php if($menu == 'usuarios'){?>
                            <li class="active">
                                <a class="nav-link" href="<?=$ruta?>dash/usuarios/">
                                    <i class="nc-icon nc-single-02"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                        <?php }else{ ?>
                            <li>
                                <a class="nav-link" href="<?=$ruta?>dash/usuarios/">
                                    <i class="nc-icon nc-single-02"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                        <?php } ?>

                    <?php
                   }
                }
                ?>


                </ul>
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"> <?=$titulo?> </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i ></i>
                                    <span class="d-lg-none">
                                        <?=$titulo?>
                                    </span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <form action="<?=$ruta?>dash/productos/buscarProductos.php" method="post" class="form-inline my-2 my-lg-0">

                                    <select name="categoria" class="form-control" >
                                        <option value="vacio">Selecciona una categoría</option>
                                        <?php
                                        foreach ($categorias as $categoria3) {?>
                                            <option value="<?=$categoria3->getId()?>"><?=$categoria3->getCategoria()?></option>
                                        <?php } ?>
                                    </select>

                                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="buscar" value="">

                                    <button class="btn btn-primary" type="submit"><img src="<?=$ruta?>assets/img/lupa2.png" width="30" height="30"></button>
                                </form>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?=$ruta?>assets/img/usuario.png"  width="35" height="35">
                                     <span class="no-icon"> 
                                        <?php  
                                        echo $_SESSION['nombre'];
                                        ?>
                                    </span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="<?=$ruta?>dash/ayuda/ManualDeUsuario-NewYorkCafe.pdf">¿Necesitas ayuda?</a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="<?=$ruta?>dash/cerrarSesion.php">Cerrar sesion</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="no-icon"></span>
                                </a>
                            </li>
                        </ul>
                    </div>



                </div>
            </nav>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header " style="background-color: #B1E7FC;">
                                    

                                            <?php  
                                            //No tienen valor 1
                                            if($categoriaVacia == true && $nombreVacio == true){
                                                ?>
                                                <h4 class="card-title" style="text-align: center; font-weight: 600;"> <strong>Búsqueda de productos</strong></h4>
                                                <br>
                                                <?php

                                            //Ambas tienen un valor 2
                                            }else if($categoriaVacia == false && $nombreVacio == false){

                                                ?>
                                                <h4 class="card-title" style="text-align: center; font-weight: 600;"> <strong>Búsqueda de productos</strong></h4>
                                                <h4 class="card-title"> <strong style="font-weight: 600;">Categoria = </strong>  
                                                    <?=$nombreCategoria?></h4>
                                                <h4 class="card-title"> <strong style="font-weight: 600;">Nombre = </strong> <?=$nombre?></h4>
                                                <br>
                                                <?php

                                            //Solo la categoria tien un valor 3
                                            }else if($categoriaVacia == false && $nombreVacio == true){

                                                ?>
                                                <h4 class="card-title" style="text-align: center; font-weight: 600;"><strong>Búsqueda de productos</strong></h4>
                                                <h4 class="card-title"> <strong style="font-weight: 600;">Categoria = </strong> 
                                                    <?=$nombreCategoria?></h4>
                                                    <br>
                                                <?php

                                            //Solo el nombre tiene un valor 4
                                            }else if($categoriaVacia == true && $nombreVacio == false){

                                                ?>
                                               <h4 class="card-title" style="text-align: center; font-weight: 600;"><strong>Búsqueda de productos</strong></h4>
                                                <h4 class="card-title"><strong style="font-weight: 600;">Nombre = </strong> <?=$nombre?></h4>
                                                <br>
                                                <?php

                                            }
                                            ?>
                                   
                                </div>

                                <?php 
                                //No tienen valor 1
                                if($categoriaVacia == true && $nombreVacio == true){
                                    ?>

                                    <div class="jumbotron "  style="background-color: #FFFBB7;">
                                        <h1 class="display-4">¡Oops!</h1>
                                        <hr class="my-4">
                                        <h3>Al parecer no se ha seleccionado una categoria ni tampoco se ha escrito un nombre..</h3>
                                        <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                    </div>


                                    <?php
                                //Ambas tienen un valor 2
                                }else if($categoriaVacia == false && $nombreVacio == false){
                                    
                                    $producto1 = new Productos('',$nombre,'','',$categoriaForm,'');
                                    $producto1->setConexion($bd);
                                    $existe=$producto1->nombreCategoriaSolicitado();
                                    if($existe == true){
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
                                                    $productosNC=$producto1->buscarNombreCategoria();

                                                    foreach ($productosNC as $producto) {
                                                        $idC=$producto->getId_Categoria();

                                                        $categoria->setConexion($bd);

                                                        $categoria->setId($idC);
                                                        $categoria->readCategoriaID();


                                                        //Instanciar los estados
                                                        $idE=$producto->getId_Estado();
                                                        $estado = new EstadoProducto('','');
                                                        $estado->setConexion($bd);

                                                        $estado->setId($idE);
                                                        $estado->readEstadoID();


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

                                        <?php
                                    }else{
                                        ?>

                                        <div class="jumbotron "  style="background-color: #FFFBB7;">
                                            <h1 class="display-4">¡Oops!</h1>
                                            <hr class="my-4">
                                            <h3>No se han encontrado coincidencias con la categoria <i><?=$nombreCategoria?> </i> y con el nombre <i><?=$nombre?></i></h3>
                                            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                        </div>

                                        <?php
                                    }


                                //Solo la categoria tiene un valor 3
                                }else if($categoriaVacia == false && $nombreVacio == true){
                                    $producto1 = new Productos('','','','',$categoriaForm,'');
                                    $producto1->setConexion($bd);
                                    $existe=$producto1->categoriaSolicitada();
                                    if($existe == true){


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
                                                    $productosC=$producto1->buscarCategoria();

                                                    foreach ($productosC as $producto) {
                                                        $idC=$producto->getId_Categoria();

                                                        $categoria->setConexion($bd);

                                                        $categoria->setId($idC);
                                                        $categoria->readCategoriaID();


                                                        //Instanciar los estados
                                                        $idE=$producto->getId_Estado();
                                                        $estado = new EstadoProducto('','');
                                                        $estado->setConexion($bd);

                                                        $estado->setId($idE);
                                                        $estado->readEstadoID();


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

                                        <?php


                                    }else{
                                        ?>

                                        <div class="jumbotron "  style="background-color: #FFFBB7;">
                                            <h1 class="display-4">¡Oops!</h1>
                                            <hr class="my-4">
                                            <h3>No se han encontrado registros con la categoria <i><?=$nombreCategoria?> </i></h3>
                                            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                        </div>

                                        <?php
                                    }


                                //Solo el nombre tiene un valor 4
                                }else if($categoriaVacia == true && $nombreVacio == false){
                                    $producto1 = new Productos('',$nombre,'','','','');
                                    $producto1->setConexion($bd);
                                    $existe=$producto1->nombreSolicitado();

                                    if($existe == true){
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
                                                    $productosN=$producto1->buscarNombre();

                                                    foreach ($productosN as $producto) {
                                                        $idC=$producto->getId_Categoria();

                                                        $categoria->setConexion($bd);

                                                        $categoria->setId($idC);
                                                        $categoria->readCategoriaID();


                                                        //Instanciar los estados
                                                        $idE=$producto->getId_Estado();
                                                        $estado = new EstadoProducto('','');
                                                        $estado->setConexion($bd);

                                                        $estado->setId($idE);
                                                        $estado->readEstadoID();


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

                                        <?php


                                    }else{

                                        ?>

                                        <div class="jumbotron "  style="background-color: #FFFBB7;">
                                            <h1 class="display-4">Oops!</h1>
                                            <hr class="my-4">
                                            <h3>No se han encontrado registros con el nombre: <i><?=$nombre?> </i></h3>
                                            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                        </div>

                                        <?php
                                    }
                                }
                                
                                ?>

                                


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