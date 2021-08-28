<?php
	//Finalizar la sesion que fue creada
	session_start();

	$ruta="../";
	unset($_SESSION['id']);
	unset($_SESSION['nombre']);
	unset($_SESSION['tipoUsuario']);

	session_destroy();

	header("location: ".$ruta."index.php");
?>