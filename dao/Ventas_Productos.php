<?php 
	/**
	 * 
	 */
	class Ventas_Productos
	{
		private $id_producto;
		private $id_venta;
		private $unidades;
		private $precio;

		//________________________________________________Modelo

		function __construct($id_producto,$id_venta,$unidades,$precio)
		{
			$this->id_producto=$id_producto;
			$this->id_venta=$id_venta;
			$this->unidades=$unidades;
			$this->precio=$precio;
		}

		//Getters
		public function setId_producto($id_producto){
			$this->id_producto=$id_producto;
		}

		public function setId_venta($id_venta){
			$this->id_venta=$id_venta;
		}

		public function setUnidades($unidades){
			$this->unidades=$unidades;
		}

		public function setPrecio($precio){
			$this->precio=$precio;
		}


		//Setters

		public function getId_producto(){
			return $this->id_producto;
		}

		public function getId_venta(){
			return $this->id_venta;
		}

		public function getUnidades(){
			return $this->unidades;
		}

		public function getPrecio(){
			return $this->precio;
		}


		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}

		//C = create, R = read, U = update, D = delete

		public function createVentaProducto(){
			$query=
			"INSERT INTO 
				ventas_productos
			SET 
				id_producto=:id_producto,
				id_venta=:id_venta,
				unidades=:unidades,
				precio=:precio";

			$stmt=$this->conexion->prepare($query);
			
			$this->id_producto=htmlspecialchars($this->id_producto);
			$stmt->bindParam(":id_producto",$this->id_producto);

			$this->id_venta=htmlspecialchars($this->id_venta);
			$stmt->bindParam(":id_venta",$this->id_venta);

			$this->unidades=htmlspecialchars($this->unidades);
			$stmt->bindParam(":unidades",$this->unidades);

			$this->precio=htmlspecialchars($this->precio);
			$stmt->bindParam(":precio",$this->precio);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function readVentaProducto(){
			$ventaProducto= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM ventas_productos";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($ventaProducto, new Ventas_Productos($id_producto,$id_venta,$unidades,$precio));
				}
				//echo "bien";
				return $ventaProducto;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readVentaProductoID(){
			$ventaProducto= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM ventas_productos
			WHERE id_venta=$this->id_venta";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($ventaProducto, new Ventas_Productos($id_producto,$id_venta,$unidades,$precio));
				}
				return $ventaProducto;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}



		//pendiente
		public function updateVentaProducto(){
			$query=
			"UPDATE  
				ventas_productos
			SET 
				unidades=:unidades

			WHERE id_venta=$this->id_venta AND id_producto=$this->id_producto";

			$stmt=$this->conexion->prepare($query);

			$this->unidades=htmlspecialchars($this->unidades);
			$stmt->bindParam(":unidades",$this->unidades);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deleteVentaProducto(){
			$query=
			"DELETE FROM 
				ventas_productos
			where id_venta=$this->id_venta";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}


		//Eliminar un producto de una venta
		public function deleteProductoVenta(){
			$query=
			"DELETE FROM 
				ventas_productos
			where id_venta=$this->id_venta AND id_producto=$this->id_producto";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function existeProducto(){
			$query=
			"SELECT * FROM 
				ventas_productos
			where id_producto=$this->id_producto";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount() > 0){
					return true;
				}else{
					return false;
				}
				
			}else{
				return false;
			}
		}

		/*public function mostrarVentaProductos(){
			$query=
			"SELECT 
				producto,
				precio,
				unidades
			FROM productos,
				 ventas_productos
			WHERE id=id_producto
				AND id_venta=$this->id_venta";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->unidades= $unidades;
				return $produc,$preci;
			}else{
				return false;
			}
		}*/

		public function distinc(){
			$distintos= array();//nombre de la variable y su valor
			$query=
			"SELECT DISTINCT
				id as id_producto
			FROM productos, ventas_productos
			WHERE id_venta = $this->id_venta
			ORDER BY id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($distintos, new Ventas_Productos($id_producto,'','',''));
				}
				//echo "bien";
				return $distintos;
			}else{
				//echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}



		public function existeProductoEnVentaID(){
			$query=
			"SELECT 
				* 
			FROM ventas_productos
			WHERE id_producto=$this->id_producto AND id_venta=$this->id_venta";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				if($stmt->rowcount() > 0){
					return true;
				}else{
					return false;
				}
				
			}else{
				return false;
			}
		}



		public function obtenerUnidadesID(){
			$query=
			"SELECT 
				unidades
			FROM ventas_productos
			WHERE id_producto=$this->id_producto AND id_venta=$this->id_venta";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return $unidades;
			}else{
				return false;
			}
		}


	}
?>