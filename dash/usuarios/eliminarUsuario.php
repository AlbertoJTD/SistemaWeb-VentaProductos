<?php 
	$ruta="../../";
	include($ruta.'config/Precarga.php');
	include($ruta.'dao/Usuarios.php');

//print_r($_POST);
$usuario = new Usuarios($_GET["id"],'','','','','','');

$usuario->setConexion($bd);
if($usuario->deleteUsuario()){
	header("location: index.php");
}else{
	echo "Lo siento chavo no se pudo :c";
}

?>