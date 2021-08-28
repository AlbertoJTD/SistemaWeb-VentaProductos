<?php 
$ruta="../../";
include($ruta.'config/Precarga.php');
include($ruta.'dao/Pedidos_Productos.php');

$pedidoProduc = new  Pedidos_Productos('',$_GET["id"],'','');
$pedidoProduc->setConexion($bd);
if($pedidoProduc->deletePedidoProductoID()){
	//header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}


include($ruta.'dao/Pedidos.php');

$pedido = new Pedidos($_GET["id"],'','','','','');

$pedido->setConexion($bd);
if($pedido->deletePedido()){
	header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}

?>