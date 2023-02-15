<?php
require_once "clases/usuario.php";
require_once "clases/producto.php";

class GestionBBDD {

    public static function realizarConexion() {   
        try {
            $conexion = new PDO("mysql:host=localhost; dbname=dwes","root","123456");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }
        catch(Exception $e)
        {
          echo "Error al realizar la conexión: " . $e->getMessage();
        }    	
    }

    public static function buscarUsuario($nombre, $password) {
        $sql = "select * from usuarios where usuario = :n_nombre and contrasena = MD5(:n_contrasena);";
        $conexion=self::realizarConexion();
        $resultado=$conexion->prepare($sql);
		$resultado->execute(array(":n_nombre"=>$nombre,":n_contrasena"=>$password));
        $fila=$resultado->fetch();
        $usuario = new Usuario($fila);
        $resultado->closeCursor();
		$conexion=null;
        return ($usuario);
    }

    public static function productos() {
        $sql="select * from producto;";
        $conexion=self::realizarConexion();
		$resultado=$conexion->query($sql);
	    $arra_productos=array();
        while ($fila=$resultado->fetch()){
            $arra_productos[]= new Producto($fila);
        }
        $resultado->closeCursor();
		$conexion=null;
		return ($arra_productos);
    }

}

?>