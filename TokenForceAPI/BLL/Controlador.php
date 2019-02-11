<?php
     require_once 'DAL/AccesoDatos.php';       
     
 class Controlador  {
    
    protected $iaccesoDatos;
    public $usuario;
        
    public function __construct(IAccesodatos $iaccesoDatos)
    {
        $this->iaccesoDatos=new AccesoDatos();
    }             
  
    public function ObtenerListadoUsuarios() 
    {
       return $this->iaccesoDatos->ListaUsuarios();
    }
    
    public function ObtenerUsuario($DatoBuscar)
    {
        return $this->iaccesoDatos->ObtenerUsuario($DatoBuscar);
    }
    
    public function GuardarUsuario ($Object)
    {
       return $this->iaccesoDatos->GuardarUsuario($Object); 
    }
    
    public function EliminarUsuario ($DatoEliminar)
    {
       return $this->iaccesoDatos->EliminarUsuario($DatoEliminar); 
    }
 }
