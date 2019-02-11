<?php

class Conexion {
 
 public static function ObtenerConexion()
 {
    try
    {       
         $Conexion = new mysqli("localhost", "root", "", "ApiRest_DB");
         if (mysqli_connect_errno()){       
            die("No se puede conectar a la base de datos:");
        }
        else 
        {
           return($Conexion);
        }         
    }
    catch (Exception $ex)
    { 
       echo $ex;     
    }
 }

}

?>
