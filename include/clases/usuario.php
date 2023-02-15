<?php

class Usuario {
	private $nombre;
	private $password;

    function __Construct ($registro){
        $this->nombre = $registro['usuario'];
        $this->password = $registro['contrasena'];
    }
    
    function getNombreUsuario(){
        return $this->nombre;
    }
    function getPasswordUsuario(){
        return $this->password;
    }
    
    function setNombreUsuario($nombre){
        $this->nombre=$nombre;
    }
    function setPasswordUsuario($password){
        $this->password=$password;
    }
}

?>