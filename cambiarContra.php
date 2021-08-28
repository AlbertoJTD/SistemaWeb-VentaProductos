<?php 
	$ruta="";
	include($ruta.'config/Precarga.php');
	include($ruta.'dao/Usuarios.php');

	$user=$_POST['usuario'];
	$pass1=$_POST['pass1'];
	$pass2=$_POST['pass2'];

	
	$usuario = new Usuarios('','','','',$_POST['usuario'],'','');
	$usuario->setConexion($bd);

	$valor=0;

	//Nuevas contra iguales
	if($pass1 == $pass2){

		//Entra si existe el usuario
		if($usuario->existeNombreUsuario()){

			$usuario2 = new Usuarios('','','','',$_POST['usuario'],$_POST['pass1'],'');
			$usuario2->setConexion($bd);

			if($usuario2->updateNombreContra()){
				//echo "Contraseña actualizada";
				$valor=1;
				header("location: ".$ruta."index.php?val=$valor");
				
			}else{
				//echo "No se pudo actualizar la contra";
				$valor=2;
				header("location: ".$ruta."restablecerContra.php?val=$valor");
				
			}
			
		
		//No existe el usuario
		}else{
			$valor=3;
			header("location: ".$ruta."restablecerContra.php?val=$valor");
		}



	//Las nuevas contras son distintas
	}else{
		header("location: ".$ruta."restablecerContra.php?val=$valor");
	}
	

	?>
