<?php
	$ruta="../../";
	include($ruta.'config/Precarga.php');
	include($ruta.'dao/Usuarios.php');

	$usuario = new Usuarios('',$_POST['nombre'],$_POST['apellidoP'],$_POST['apellidoM'],
		$_POST['user'],$_POST['pass'],$_POST['tipoUsuario']);

	$usuario->setConexion($bd);

	if($usuario->createUsuario()){

		$_SESSION['id']=$usuario->getId();
		$_SESSION['nombre']=$usuario->getNombre();
		$_SESSION['tipoUsuario']=$usuario->getId_tipoUsuario();
		header("location: ".$ruta."dash/");
	}else{
		echo "Lo siento chavo no se pudo :c";
	}
?>