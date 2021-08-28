<?php

	/**
	 * Esta es la clase de usuarios
	 */
	class Usuarios
	{
		private $id;
		private $nombre;
		private $apellidoP;
		private $apellidoM;
		private $usuario;
		private $contra;
		private $id_tipoUsuario;
		
		//________________________________________________Modelo

		function __construct($id,$nombre,$apellidoP,$apellidoM,$usuario,$contra,$id_tipoUsuario)
		{
			$this->id=$id;
			$this->nombre=$nombre;
			$this->apellidoP=$apellidoP;
			$this->apellidoM=$apellidoM;
			$this->usuario=$usuario;
			$this->contra=$contra;
			$this->id_tipoUsuario=$id_tipoUsuario;
		}

		//SETTERS
		public function setId($id){
			$this->id=$id;
		}

		public function setNombre($nombre){
			$this->nombre=$nombre;
		}

		public function setApellidoP($apellidoP){
			$this->apellidoP=$apellidoP;
		}

		public function setApellidoM($apellidoM){
			$this->apellidoM=$apellidoM;
		}

		public function setUsuario($usuario){
			$this->usuario=$usuario;
		}

		public function setContra($contra){
			$this->contra=$contra;
		}

		public function setId_tipoUsuario($id_tipoUsuario){
			$this->id_tipoUsuario=$id_tipoUsuario;
		}

		//GETTERS
		public function getId(){
			return $this->id;
		}

		public function getNombre(){
			return $this->nombre;
		}

		public function getApellidoP(){
			return $this->apellidoP;
		}

		public function getApellidoM(){
			return $this->apellidoM;
		}

		public function getUsuario(){
			return $this->usuario;
		}

		public function getContra(){
			return $this->contra;
		}

		public function getId_tipoUsuario(){
			return $this->id_tipoUsuario;
		}


		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}


		//C = create, R = read, U = update, D = delete

		public function createUsuario(){
			$query=
			"INSERT INTO 
				usuarios
			SET 
				nombre=:nombre,
				apellidoP=:apellidoP,
				apellidoM=:apellidoM,
				usuario=:usuario,
				contra=MD5(:contra),
				id_tipoUsuario=:id_tipoUsuario";

			$stmt=$this->conexion->prepare($query);
			
			$this->nombre=htmlspecialchars($this->nombre);
			$stmt->bindParam(":nombre",$this->nombre);

			$this->apellidoP=htmlspecialchars($this->apellidoP);
			$stmt->bindParam(":apellidoP",$this->apellidoP);

			$this->apellidoM=htmlspecialchars($this->apellidoM);
			$stmt->bindParam(":apellidoM",$this->apellidoM);

			$this->usuario=htmlspecialchars($this->usuario);
			$stmt->bindParam(":usuario",$this->usuario);

			$this->contra=htmlspecialchars($this->contra);
			$stmt->bindParam(":contra",$this->contra);

			$this->id_tipoUsuario=htmlspecialchars($this->id_tipoUsuario);
			$stmt->bindParam(":id_tipoUsuario",$this->id_tipoUsuario);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function numUsuarios(){
			//$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				count(id) AS numUsuarios
			FROM usuarios";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return $numUsuarios;
			}else{
				//echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readUsuarios(){
			$usuarios= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM usuarios";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($usuarios, new Usuarios($id,$nombre,$apellidoP,$apellidoM,$usuario,$contra,
						$id_tipoUsuario));
				}
				return $usuarios;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readUsuarioID(){
			//$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM usuarios
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->nombre = $nombre;
				$this->apellidoP = $apellidoP;
				$this->apellidoM = $apellidoM;
				$this->usuario = $usuario;
				$this->contra = $contra;
				$this->id_tipoUsuario = $id_tipoUsuario;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function existeAdmin(){
			//$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM usuarios
			WHERE id_tipoUsuario=1";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount()>0){
					return true;
				}else{
					return false;
				}
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function existeUsuario(){
			$query=
			"SELECT 
				*
			FROM usuarios
			WHERE usuario='$this->usuario' AND contra=MD5('$this->contra')";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount()>0){
					return true;
				}else{
					return false;
				}
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function existeNombreUsuario(){
			$query=
			"SELECT 
				*
			FROM usuarios
			WHERE usuario='$this->usuario'";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount()>0){
					return true;
				}else{
					return false;
				}
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function updateNombreContra(){
			$query=
			"UPDATE 
				usuarios
			SET
				contra=MD5('$this->contra')
			WHERE usuario='$this->usuario'";

			$stmt=$this->conexion->prepare($query);

			$this->contra=htmlspecialchars($this->contra);
			$stmt->bindParam(":contra",$this->contra);

			if($stmt->execute()){
				return true;
			}else{
				print_r($stmt->errorInfo());
				return false;
			}
			
		}

		public function obtenerIdUser(){
			$query=
			"SELECT 
				id as idUser
			FROM usuarios
			WHERE usuario='$this->usuario' AND contra=MD5('$this->contra')";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount()>0){
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					extract($row);
					return $idUser;
				}else{
					return false;
				}
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function obtenerNombreID(){
			$query=
			"SELECT 
				nombre
			FROM usuarios
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount()>0){
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					extract($row);
					return $nombre;
				}else{
					return false;
				}
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function usuarioEsAdmin(){
			//$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM usuarios
			WHERE id_tipoUsuario=1";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount()>0){
					return true;
				}else{
					return false;
				}
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function updateUsuario(){
			$query=
			"UPDATE  
				usuarios
			SET 
				nombre=:nombre,
				apellidoP=:apellidoP,
				apellidoM=:apellidoM,
				usuario=:usuario,
				id_tipoUsuario=:id_tipoUsuario

			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->nombre=htmlspecialchars($this->nombre);
			$stmt->bindParam(":nombre",$this->nombre);

			$this->apellidoP=htmlspecialchars($this->apellidoP);
			$stmt->bindParam(":apellidoP",$this->apellidoP);

			$this->apellidoM=htmlspecialchars($this->apellidoM);
			$stmt->bindParam(":apellidoM",$this->apellidoM);

			$this->usuario=htmlspecialchars($this->usuario);
			$stmt->bindParam(":usuario",$this->usuario);

			$this->id_tipoUsuario=htmlspecialchars($this->id_tipoUsuario);
			$stmt->bindParam(":id_tipoUsuario",$this->id_tipoUsuario);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deleteUsuario(){
			$query=
			"DELETE FROM 
				usuarios
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}


		public function contraCorrecta(){
			$query=
			"SELECT 
				*
			FROM usuarios
			WHERE id=$this->id AND contra=MD5('$this->contra')";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount()>0){
					return true;
				}else{
					return false;
				}
			}else{
				//echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function actualizarContra(){
			$query=
			"UPDATE 
				usuarios
			SET
				contra=MD5(:contra)
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->contra=htmlspecialchars($this->contra);
			$stmt->bindParam(":contra",$this->contra);

			if($stmt->execute()){
				return true;
			}else{
				//echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function totalUsuarios(){
			$query=
			"SELECT COUNT(id) as total FROM usuarios";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return $total;
			}else{
				return false;
			}
		}



	}

?>