<?php 
  $ruta='';
  include($ruta.'config/Precarga.php');
  include($ruta.'dao/TipoUsuario.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Restablecer contrase&ntilde;a</title>
	<link rel="stylesheet" type="text/css" href="<?=$ruta?>assets/css/bootstrap.min.css">
    <!-- Iconos -->
    <link rel="stylesheet" type="text/css" href="<?=$ruta?>assets/css/estilo-login.css">
</head>
<body>

	<div class="modal-dialog text-center">
		<div class="col-sm-8 main-section2">
			<div class="modal-content">
				
				<button type="submit" class="btn btn-info btn-round">
					<img src="<?=$ruta?>assets/img/regresar.png" alt="" width="20" height="20"> 
					<a href="index.php" title="" style="color: white; text-decoration: none;"> Regresar</a>
				</button>
				<h4 style="color: white; text-align: center;"> Restablecer contrase&ntilde;a </h4>

				<?php  

				if(isset($_GET['val'])){
					$valor=$_GET['val'];

					//Se cambia la contra
					if($valor == 0){

						?>

						<div class="alert alert-warning" role="alert">
		  					<strong>ERROR: </strong> Las contrase&ntilde;as no coinciden..
						</div>

						<?php

					//No se puede actualizar la contra
					}else if($valor == 2){

						?>

						<div class="alert alert-danger" role="alert">
		  					<strong>ERROR: </strong> No se pudo actualizar la contrase&ntilde;a..
						</div>

						<?php

					//El usuario no existe
					}else if($valor == 3){

						?>

						<div class="alert alert-warning" role="alert">
		  					<strong>ERROR: </strong> El usuario no existe..
						</div>

						<?php

					}
					
				}

				?>

				<form action="cambiarContra.php" method="post" class="col-12">
					<div class="" style="text-align: left">
						<label style="text">Nombre de usuario: </label>
						<input class="form-control" type="text" placeholder="Usuario" name="usuario" required>
						<br>
					</div>

					<div class="" style="text-align: left">
						<label>Nueva contrase&ntilde;a: </label>
						<input class="form-control" type="password" placeholder="Contrase&ntilde;a" name="pass1" required>
						<br>
					</div>


					<div class="" style="text-align: left">
						<label>Confimar contrase&ntilde;a: </label>
						<input class="form-control" type="password" placeholder="Contrase&ntilde;a" name="pass2" required>
						<br>
					</div>

					<button type="submit" class="btn btn-success btn-round">
						<img src="<?=$ruta?>assets/img/recargar.png" alt="" width="20" height="20">  Cambiar contrase&ntilde;a
					</button>
				</form>
			</div>
		</div>
	</div>

</body>
<script src="<?=$ruta?>assets/js/jquery.js"></script>
<script src="<?=$ruta?>assets/js/popper.min.js"></script>
<script src="<?=$ruta?>assets/js/bootstrap.min.js"></script>
</html>