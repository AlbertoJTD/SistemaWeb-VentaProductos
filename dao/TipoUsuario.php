<?php

	/**
	 * 
	 */
	class TipoUsuario
	{
		private $id;
		private $tipoUsuario;

		//________________________________________________Modelo
		
		function __construct($id,$tipoUsuario)
		{
			$this->id=$id;
			$this->tipoUsuario=$tipoUsuario;
		}

		//SETTERS
		public function setId($id){
			$this->id=$id;
		}

		public function setTipoUsuario($tipoUsuario){
			$this->tipoUsuario=$tipoUsuario;
		}


		//GETTERS
		public function getId(){
			return $this->id;
		}

		public function getTipoUsuario(){
			return $this->tipoUsuario;
		}


		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}

		public function createTipoUsuario(){
			$query=
			"INSERT INTO 
				tipousuario
			SET 
				tipoUsuario=:tipoUsuario";

			$stmt=$this->conexion->prepare($query);
			
			$this->tipoUsuario=htmlspecialchars($this->tipoUsuario);
			$stmt->bindParam(":tipoUsuario",$this->tipoUsuario);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function readTipoUsuario(){
			$tipoUsuarios= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM tipousuario";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($tipoUsuarios, new TipoUsuario($id,$tipoUsuario));
				}
				return $tipoUsuarios;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function readTipoUsuarioID(){
			//$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM tipousuario
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->tipoUsuario = $tipoUsuario;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function updateTipoUsuario(){
			$query=
			"UPDATE  
				tipousuario
			SET 
				tipoUsuario=:tipoUsuario
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->tipoUsuario=htmlspecialchars($this->tipoUsuario);
			$stmt->bindParam(":tipoUsuario",$this->tipoUsuario);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deleteTipoUsuario(){
			$query=
			"DELETE FROM 
				tipousuario
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}


	}

?>