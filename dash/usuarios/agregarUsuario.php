<?php 
	$ruta="../../";
	include($ruta.'config/Precarga.php');
	include($ruta.'dao/Usuarios.php');

	$usuario = new Usuarios('',$_POST['nombre'],$_POST['apellidoP'],$_POST['apellidoM'],
		$_POST['user'],$_POST['pass'],$_POST['id_tipoUsuario']);

	$usuario->setConexion($bd);

	if($usuario->createUsuario()){
		header("location: ".$ruta."dash/usuarios");
	}else{
		echo "Lo siento chavo no se pudo :c";
	}
?>