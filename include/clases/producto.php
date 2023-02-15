<?php

class Producto {
    private $codigo;
	private $nombre;
    private $abreviatura;
	private $descripcion;
    private $pvp;
	private $categoria;

    function __Construct ($registro){
        $this->codigo = $registro['cod'];
        $this->nombre = $registro['nombre'];
        $this->abreviatura = $registro['nombre_corto'];
        $this->descripcion = $registro['descripcion'];
        $this->pvp = $registro['PVP'];
        $this->categoria = $registro['familia'];
    }

    function getCodigoProducto(){
        return $this->codigo;
    }
    function getNombreProducto(){
        return $this->nombre;
    }
    function getAbreviaturaProducto(){
        return $this->abreviatura;
    }
    function getDescripcionProducto(){
        return $this->descripcion;
    }
    function getPvpProducto(){
        return $this->pvp;
    }
    function getCategoriaProducto(){
        return $this->categoria;
    }
    
    function setCodigoProducto($codigo){
        $this->codigo=$codigo;
    }
    function setNombreProducto($nombre){
        $this->nombre=$nombre;
    }
    function setAbreviaturaProducto($abreviatura){
        $this->abreviatura=$abreviatura;
    }
    function setDescripcionProducto($descripcion){
        $this->descripcion=$descripcion;
    }
    function setPvpProducto($pvp){
        $this->pvp=$pvp;
    }
    function setCategoriaProducto($categoria){
        $this->categoria=$categoria;
    }
}

?>