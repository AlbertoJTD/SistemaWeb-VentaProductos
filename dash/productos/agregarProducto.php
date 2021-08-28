<?php 
	$ruta="../../";
	include($ruta.'config/Precarga.php');
	include($ruta.'dao/Productos.php');
	//print_r($_POST);
	//echo $_POST['carrera'];

	//Carrera::setConexion($bd);
	$producto = new Productos('',$_POST['nombre'],$_POST['precio'],$_POST['id_estado']);
	//$carrera->setNombre($_POST['carrera']);

	$producto->setConexion($bd);
//	$carrera->createCarrera();
	//echo $carrera;

	if($producto->createProducto()){
		header("location: index.php");
	}else{
		echo "Lo siento chavo no se pudo :c";
	}
?>