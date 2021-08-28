<?php 
  $ruta='';
  include($ruta.'config/Precarga.php');
  include($ruta.'dao/TipoUsuario.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesi&oacute;n</title>
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
				<h4 style="color: white; text-align: center;"> Crea tu cuenta para acceder </h4>

				<form action="<?=$ruta?>dash/usuarios/agregar.php" method="post" class="col-12">
					<div class="" style="text-align: left">
						<label style="text">Nombre: </label>
						<input class="form-control" type="text" placeholder="Nombre" name="nombre" required>
						<br>
					</div>

					<div class="" style="text-align: left">
						<label>Apellido paterno: </label>
						<input class="form-control" type="text" placeholder="Apellido paterno" name="apellidoP" required>
						<br>
					</div>

					<div class="" style="text-align: left">
						<label>Apellido materno: </label>
						<input class="form-control" type="text" placeholder="Apellido materno" name="apellidoM" required>
						<br>
					</div>

					<div class="" style="text-align: left">
						<label>Nombre de usuario: </label>
						<input class="form-control" type="text" placeholder="Nombre de usuario" name="user" required>
						<br>
					</div>

					<div class="" style="text-align: left">
						<label>Contrase&ntilde;a: </label>
						<input class="form-control" type="password" placeholder="Contrase&ntilde;a" name="pass" required>
						<br>
					</div>

					<div class="" style="text-align: left">
						<label>Tipo de usuario: </label>
						<select name="tipoUsuario" class="form-control" required>
							
							<?php
							$tipoUsuario = new TipoUsuario('','');
  							$tipoUsuario->setConexion($bd);
  							$tipoUsu=$tipoUsuario->readTipoUsuario();
							?>

							<option value="">Selecciona el tipo de usuario </option>
							<?php
							foreach ($tipoUsu as $tipo){

								?>
								<option value="<?=$tipo->getId()?>"> <?=$tipo->getTipoUsuario()?></option>
								<?php
							}
							?>
						</select>
						<br>
					</div>

					<button type="submit" class="btn btn-success btn-round">
						<img src="<?=$ruta?>assets/img/login.png" alt="" width="20" height="20">  Iniciar sesi&oacute;n
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