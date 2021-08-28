<?php 
$ruta="../../";
include($ruta.'config/Precarga.php');
include($ruta.'dao/Productos.php');

$producto = new Productos($_POST["id"],$_POST['nombre'],$_POST['precio'],$_POST['id_estado']);

$producto->setConexion($bd);
if($producto->updateProducto()){
	header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}

?>