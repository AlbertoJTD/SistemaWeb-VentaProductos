<?php 
  $ruta='';
  include($ruta.'config/Precarga.php');
  include($ruta.'dao/Usuarios.php');
  //include($ruta.'dao/TipoUsuario.php');

  $usuario = new Usuarios('','','','','','','');
  $usuario->setConexion($bd);
  $numUsu=$usuario->numUsuarios();

  $sinUsuario=false;
  if($numUsu>0){
  	$existe=$usuario->existeAdmin();
  	if($existe == true){
  		//echo "Si hay un usuario de tipo administrador";
  	}else{
  		//echo "No hay un usuario de tipo administrador";
  	}
  }else{
  	$sinUsuario=true;
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesi&oacute;n</title>
	<link rel="stylesheet" type="text/css" href="<?=$ruta?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$ruta?>assets/css/estilo-login.css">
</head>
<body>

	<div class="modal-dialog text-center">
		<div class="col-sm-8 main-section">
			<div class="modal-content">
				<div class="col-12 user-img">
					<img src="assets/img/user-1.png" alt="">
				</div>

				<h3 style="color: white;"> ¡Bienvenido a Miscelanea Mary! </h3>

				<form action="<?=$ruta?>dash/existeUsuario.php" method="post" class="col-12">
					<div class="form-group" id="user-group">
						<input class="form-control" type="text" placeholder="Nombre de usuario" name="user" required="">
					</div>

					<div class="form-group" id="contrasena-group">
						<input class="form-control" type="password" placeholder="Contrase&ntilde;a" name="pass" required="">
					</div>

					<button type="submit" class="btn btn-primary btn-round">
						<img src="<?=$ruta?>assets/img/login.png" alt="" width="20" height="20">  Iniciar sesi&oacute;n
					</button>
				</form>

				<?php if($sinUsuario == true || $existe == false){?>
				<div class="col-12 forgot">
					<a href="<?=$ruta?>registroUsuario.php" title="">¿No tienes cuenta?</a>
				</div>
			<?php } ?>

			<?php  

			if(isset($_GET['val'])){
				?>

				<div class="alert alert-success" role="alert">
  					<strong>AVISO: </strong> La contrase&ntilde;a ha sido actualizada..
				</div>

				<?php
			}

			?>

				<div class="col-12 forgot">
					<a href="restablecerContra.php" title="">¿Olvidaste la contrase&ntilde;a?</a>
				</div>

				
			</div>
		</div>
	</div>

</body>
<script src="<?=$ruta?>assets/js/jquery.js"></script>
<script src="<?=$ruta?>assets/js/popper.min.js"></script>
<script src="<?=$ruta?>assets/js/bootstrap.min.js"></script>
</html>
