<?php 
$ruta="../../";
include($ruta.'config/Precarga.php');
include($ruta.'dao/Ventas_Productos.php');

$ventaProduc = new  Ventas_Productos('',$_GET["id"],'','');
$ventaProduc->setConexion($bd);
if($ventaProduc->deleteVentaProducto()){
	//header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}


include($ruta.'dao/Ventas.php');

$venta = new Ventas($_GET["id"],'','');

$venta->setConexion($bd);
if($venta->deleteVenta()){
	header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}

?>