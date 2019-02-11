<?php

class Usuario implements JsonSerializable
{
    protected $usuario_id = 0;
    protected $nombres;
    protected $apellidos;
    
    public function __construct() {}
        
    
    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    
    public function jsonSerialize() // Esto es para poder visualizar bien el objeto Usuario como JSON
    {
        return 
        [
            'usuario_id' => $this->getUsuario_id(),
            'nombres'    => $this->getNombres(),
            'apellidos'  => $this->getApellidos(),
        ];
    }
}