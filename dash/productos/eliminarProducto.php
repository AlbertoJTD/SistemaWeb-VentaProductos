<?php 
$ruta="../../";
include($ruta.'config/Precarga.php');
include($ruta.'dao/Productos.php');

//print_r($_POST);
$producto = new Productos($_GET["id"],'','','','','');

$producto->setConexion($bd);
if($producto->deleteProducto()){
	header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}

?>