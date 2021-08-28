<?php 
$ruta="../../";
include($ruta.'config/Precarga.php');
include($ruta.'dao/Categoria.php');

$categoria = new Categoria($_POST["id"],$_POST["categoria"]);

$categoria->setConexion($bd);
if($categoria->updateCategoria()){
	header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}

?>