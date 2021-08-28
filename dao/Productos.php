<?php 

	/**
	 * Esta es la clase de productos
	 */
	class Productos
	{
		private $id;
		private $producto;
		//private $contenido;
		private $precio;
		//private $id_categoria;
		private $id_estado;
		

		//____________________________________________________________Modelo

		function __construct($id,$producto,$precio,$id_estado)
		{
			$this->id=$id;
			$this->producto=$producto;
			$this->precio=$precio;
			$this->id_estado=$id_estado;
		}


		//SETTERS
		public function setId($id){
			$this->id=$id;
		}

		public function setProducto($producto){
			$this->producto=$producto;
		}

		public function setPrecio($precio){
			$this->precio=$precio;
		}

		public function setId_Estado($id_estado){
			$this->id_estado=$id_estado;
		}


		//GETTERS
		public function getId(){
			return $this->id;
		}

		public function getProducto(){
			return $this->producto;
		}

		public function getPrecio(){
			return $this->precio;
		}	

		public function getId_Estado(){
			return $this->id_estado;
		}


		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}	



		public function createProducto(){
			$query=
			"INSERT INTO 
				productos 
			SET 
				producto=:producto,
				precio=:precio,
				id_estado=:id_estado";

			$stmt=$this->conexion->prepare($query);

			$this->producto=htmlspecialchars($this->producto);
			$stmt->bindParam(":producto",$this->producto);

			$this->precio=htmlspecialchars($this->precio);
			$stmt->bindParam(":precio",$this->precio);

			$this->id_estado=htmlspecialchars($this->id_estado);
			$stmt->bindParam(":id_estado",$this->id_estado);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function readProducto(){
			$productos= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM productos";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($productos, new Productos($id,$producto,$precio,$id_estado));
				}
				return $productos;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readProductoID(){
			//$carreras= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM productos
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->producto = $producto;
				$this->precio = $precio;
				
				$this->id_estado = $id_estado;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function updateProducto(){
			$query=
			"UPDATE  
				productos
			SET 
				producto=:producto,
				precio=:precio,
				id_estado=:id_estado

			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->producto=htmlspecialchars($this->producto);
			$stmt->bindParam(":producto",$this->producto);

			$this->precio=htmlspecialchars($this->precio);
			$stmt->bindParam(":precio",$this->precio);

			$this->id_estado=htmlspecialchars($this->id_estado);
			$stmt->bindParam(":id_estado",$this->id_estado);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deleteProducto(){
			$query=
			"DELETE FROM 
				productos
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}


		public function totalProductos(){
			$query=
			"SELECT COUNT(id) as total 
			FROM productos";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return $total;
			}else{
				return false;
			}
		}


		//Buscar solo nombre
		public function nombreSolicitado(){
			//$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM productos
			WHERE producto LIKE '%$this->producto%'";

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


		public function buscarNombre(){
			$productos= array();
			$query=
			"SELECT 
				*
			FROM productos
			WHERE producto LIKE '%$this->producto%'";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($productos, new Productos($id,$producto,$contenido,$precio,$id_categoria,$id_estado));
				}
				return $productos;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


	}


?>