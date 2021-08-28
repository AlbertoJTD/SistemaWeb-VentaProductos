<?php
session_start();
	$ruta="../../";
	$menu='contraseña';
    $titulo='Contraseña';
	include($ruta.'config/Precarga.php');
	include ($ruta.'header/header_dashboard.php');
	include($ruta.'dao/Usuarios.php');
	
	$usuario = new Usuarios($_POST['id'],'','','','',$_POST['contraAc'],'');
	$usuario2 = new Usuarios($_POST['id'],'','','','',$_POST['newContra1'],'');

	$usuario->setConexion($bd);
	$usuario2->setConexion($bd);
	
	$actual= $_POST['contraAc'];
	$nueva1=$_POST['newContra1'];
	$nueva2=$_POST['newContra2'];


	//include ($ruta.'header/header_dashboard.php');

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
                                    <h3 class="card-title">Cambio de contrase&ntilde;a</h3>
                                </div>
                                <div class="card-body">
                                             
                                    <?php

									if($nueva1 == $nueva2){
										//echo "<h2>Las nueva contraseñas con iguales</h2>";

										if($usuario->contraCorrecta()){
											//echo "<h2>Correcto</h2>";

											
											if($usuario2->actualizarContra()){
												?>

												<div class="jumbotron " style="background-color: #9EE196;">
		                                          <h1 class="display-4">¡Éxito!</h1>
		                                          <hr class="my-4">
		                                          <h3>La contrase&ntilde;a ha sido actualizada correctamente</h3>
		                                          <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/usuarios/" role="button">Regresar al menú principal</a>
		                                    	</div>

												<?php
											}else{
												?>

												<div class="jumbotron " style="background-color: #FF9494;">
		                                          <h1 class="display-4">¡Error!</h1>
		                                          <hr class="my-4">
		                                          <h3>Ha ocurrido un error al intentar cambiar la contrase&ntilde;a</h3>
		                                          <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/usuarios/" role="button">Regresar al menú principal</a>
		                                    	</div>

												<?php
											}
										}else{
											//echo "<h2>Incorrecto</h2>";
											?>

											<div class="jumbotron "  style="background-color: #FFFBB7;">
	                                          <h1 class="display-4">¡Error!</h1>
	                                          <hr class="my-4">
	                                          <h3>La contrase&ntilde;a actual no coincide con la que fue registrada previamente</h3>
	                                          <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/usuarios/" role="button">Regresar al menú principal</a>
	                                    	</div>

											<?php
										}
									}else{
										//echo "<h2>Las nuevas contraseñas no coinciden</h2>";
										?>

										<div class="jumbotron "  style="background-color: #FFFBB7;">
                                          <h1 class="display-4">¡Error!</h1>
                                          <hr class="my-4">
                                          <h3>Las nuevas nuevas contrase&ntilde;as no coinciden</h3>
                                          <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/usuarios/" role="button">Regresar al menú principal</a>
                                    	</div>

										<?php
									}

									//contraseñas iguales
										//contra actual debe ser igual a la de la BD
											//Cambiar contraseña
									
									/*
									
									if($usuario->updateUsuario()){
										header("location: index.php");
									}else{
										echo "Lo siento chavo no se pudo :c";
									}*/

								?>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

<?php }else{
        ?>
        <div class="jumbotron " style="background-color: #FF9494;">
            <h1 class="display-4">¡Error!</h1>
            <hr class="my-4">
            <h3>No tienes permisos para ver esta sección</i></h3>
            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/" role="button">Regresar al menú principal</a>
        </div>
        
   <?php } ?>

        
<?php 
include($ruta.'footer/footer_dashboard.php');
 ?>