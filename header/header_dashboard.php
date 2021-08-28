<?php 
    if(!isset($_SESSION['id']) || !isset($_SESSION['nombre'])){
        header("location: ../index.php");
    }else{
        //Verificar el el nombre del usuario seal el mismo, sino cambiarlo
        //Verificar que el el tipo de usuario sea el mismo,sino camiarlo

    }
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$ruta?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?=$ruta?>assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Miscelanea Mary</title>
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
        <div class="sidebar" data-color="green" data-image="<?=$ruta?>assets/img/productos1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="<?=$ruta?>dash/" class="simple-text">
                        Miscelanea Mary
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