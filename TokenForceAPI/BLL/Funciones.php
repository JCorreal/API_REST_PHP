<?php // Esta es una clase transversal, desde donde se instancia el Factory Method
     require_once 'BLL/Controlador.php';
     require_once 'BLL/AccesoDatosFactory.php';
     
class Funciones
{   
   
   public static function CrearControlador()
   {
        $accesodatos = new AccesoDatos();
        $accesodatos = AccesoDatosFactory::GetAccesoDatos($accesodatos);       
        return new Controlador($accesodatos);
    }
}