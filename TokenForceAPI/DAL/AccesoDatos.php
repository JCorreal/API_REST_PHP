<?php // DAL: Data Access Layer - Capa Acceso Datos

require_once 'Conexion.php';
require_once 'BO/Usuario.php';
require_once 'IAccesodatos.php';

class AccesoDatos implements IAccesodatos{
    
    private $cn = NULL;      // Alias para la Conexion
    private $vecr = array(); // Vector con Resultados
  
   private static function BuscarRegistro($DatoBuscar)
   { // Funcion para buscar un registro especifico             
     try 
     {           
        $cn = Conexion::ObtenerConexion();
        $rs= $cn->query("CALL spr_Listados('" . $DatoBuscar . "')");
        $vecresultado = array(); // Recorremos el resultado de la consulta y lo almacenamos en el array
        while ($fila = $rs->fetch_row()) {
               array_push($vecresultado, $fila);                
        }
        mysqli_free_result($rs);
        mysqli_close($cn);
        return $vecresultado;
     }
     catch (Exception $ex)
     { 
       mysqli_close($cn);
       echo $ex;     
     }
   }
  
    public function ListaUsuarios() {
     $cn = Conexion::ObtenerConexion();
     $DatoBuscar = 0;
     $ListaUsuarios = array();
     $vecr = array(); 
     try
        {
             $rs= $cn->query("CALL spr_Listados('" . $DatoBuscar . "')");  
             $i=0;
             while ($fila = $rs->fetch_row()) {
                    array_push($vecr, $fila);   
                    $usuario = new Usuario();
                    $usuario->setUsuario_id($vecr[$i][0]);
                    $usuario->setNombres($vecr[$i][1]);
                    $usuario->setApellidos($vecr[$i][2]); 
                    array_push($ListaUsuarios, $usuario);
                    $i++;
             }
             mysqli_free_result($rs);
             mysqli_close($cn);
             return $ListaUsuarios;
       }
       catch (Exception $ex)
       {
           echo $ex;
       }   
  }

    public function GuardarUsuario($usuario) {
     $cn = Conexion::ObtenerConexion();    
     try
     {        
        $cn->query("SET @result = 1");
        $cn->query("CALL spr_IUUsuarios('" . $usuario->getUsuario_id() . "', 
                                        '" . $usuario->getNombres() . "', 
                                        '" . $usuario->getApellidos() . "',                                               
                                        @result)");

          $res = $cn->query("SELECT @result AS result");
          $row = $res->fetch_assoc();
          mysqli_close($cn);
          if($row['result'] == 0) {
            return 0;
          }
          else {
              return -1;
          }
   }
   catch (Exception $ex)
   {
       mysqli_close($cn);
       echo $ex;
   }     
 } 
  
    public function ObtenerUsuario($DatoBuscar) {  
     try
        {         
          $vecr = AccesoDatos::BuscarRegistro($DatoBuscar);
          if ($vecr!= NULL)
          {
            $usuario = new Usuario();
            $usuario->setUsuario_id($vecr[0][0]);
            $usuario->setNombres($vecr[0][1]);
            $usuario->setApellidos($vecr[0][2]); 
            $vecr = NULL;
            return $usuario;
          }
          else
          {
              return NULL;
          }
       }
       catch (Exception $ex)
       {
           echo $ex;
       }   
    }

    public function EliminarUsuario($DatoEliminar)
    {
     try
     {   
        $cn = Conexion::ObtenerConexion();    
        $cn->query("SET @result = 1");
        $cn->query("CALL spr_DUsuario('" . $DatoEliminar . "',  @result)");

        $res = $cn->query("SELECT @result AS result");
        $row = $res->fetch_assoc();
        mysqli_close($cn);
        return $row['result'];
     }
     catch (Exception $ex)
     {
        mysqli_close($cn);
        echo $ex;
     }  
    }
}

?>


