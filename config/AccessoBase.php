<?php  
class AccesoBase{
    
    private $host;
    private $bd_nombre;
    private $usuario;
    private $contra;
    public $conexion;

    function __construct($sistema){
        if($sistema=="prueba"){
            $this->host="localhost";
            $this->bd_nombre="miscelaneamary";
            $this->usuario="root";
            $this->contra="";
        }
    }
    
    function setHost($host) {
        $this->host = $host;
    }
    //.. de lectura
    function getHost() {
        return $this->host;
    }
    function setBd_nombre($bd_nombre) {
        $this->bd_nombre = $bd_nombre;
    }
    //.. de lectura
    function getBd_nombre() {
        return $this->bd_nombre;
    }
     function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    //.. de lectura
    function getUsuario() {
        return $this->usuario;
    }
    function setContra($contra) {
        $this->contra = $contra;
    }
    //.. de lectura
    function getContra() {
        return $this->contra;
    }
    function setConexion($conexion) {
        $this->conexion = $conexion;
    }
    //.. de lectura
    public function getConexion() {
         $this->conexion = null;
         try{
            $this->conexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->bd_nombre.";charset=utf8;COLLATE=utf8_spanish_ci", $this->usuario, $this->contra);
            //echo "Conexión Exitosa";
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conexion;
    }
}
?>