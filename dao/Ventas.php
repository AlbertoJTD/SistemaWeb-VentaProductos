<?php

	/**
	 * Esta es la clase deventas
	 */
	class Ventas
	{
		private $id;
		private $total;
		private $fecha;


		//____________________________________________________________Modelo

		function __construct($id,$total,$fecha)
		{
			$this->id=$id;
			$this->total=$total;
			$this->fecha=$fecha;
		}


		//SETTERS
		public function setId($id){
			$this->id=$id;
		}

		public function setTotal($total){
			$this->total=$total;
		}

		public function setFecha($fecha){
			$this->fecha=$fecha;
		}


		//GETTERS
		public function getId(){
			return $this->id;
		}

		public function getTotal(){
			return $this->total;
		}

		public function getFecha(){
			return $this->fecha;
		}


		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}	



		public function createVenta(){
			$query=
			"INSERT INTO 
				ventas
			SET 
				total=:total";

			$stmt=$this->conexion->prepare($query);

			$this->total=htmlspecialchars($this->total);
			$stmt->bindParam(":total",$this->total);


			if($stmt->execute()){
				return true;
			}else{
				//echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readVenta(){
			$venta= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM ventas";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($venta, new Ventas($id,$total,$fecha));
				}
				return $venta;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readVentaID(){
			$ventas= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM ventas
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->id=$id;
				$this->total=$total;
				$this->fecha=$fecha;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function updateVenta(){
			$query=
			"UPDATE  
				ventas
			SET 
				total=:total

			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->total=htmlspecialchars($this->total);
			$stmt->bindParam(":total",$this->total);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deleteVenta(){
			$query=
			"DELETE FROM 
				ventas
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function maxID(){
			$query=
			"SELECT 
				MAX(id) AS maximo
			FROM ventas";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return $maximo;
			}else{
				return false;
			}
		}


		public function totalVentas(){
			$query=
			"SELECT COUNT(id) as total 
			FROM ventas";

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