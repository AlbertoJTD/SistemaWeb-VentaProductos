<?php 
	$ruta="../../";
	include($ruta.'config/Precarga.php');
	include($ruta.'dao/Usuarios.php');

	$usuario = new Usuarios($_POST['id'],$_POST['nombre'],$_POST['apellidoP'],$_POST['apellidoM'],
	$_POST['user'],'',$_POST['id_tipoUsuario']);

	$usuario->setConexion($bd);
	if($usuario->updateUsuario()){
		header("location: index.php");
	}else{
		echo "Lo siento chavo no se pudo :c";
	}

?>