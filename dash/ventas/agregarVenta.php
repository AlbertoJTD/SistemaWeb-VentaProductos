<?php 
	$ruta="../../";
	include($ruta.'config/Precarga.php');
	include($ruta.'dao/Ventas.php');

	$venta = new Ventas('',$_POST[],$_POST[]);

	$venta->setConexion($bd);

	if($venta->createProducto()){
		header("location: formProducto.php");
	}else{
		echo "Lo siento chavo no se pudo :c";
	}
?>