<?php 
$ruta="../../";
include($ruta.'config/Precarga.php');
include($ruta.'dao/Categoria.php');

//print_r($_POST);
$categoria = new Categoria($_GET["id"],'');

$categoria->setConexion($bd);
if($categoria->deleteCategoria()){
	header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}

?>