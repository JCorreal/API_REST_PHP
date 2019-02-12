<?php // ESte es el servicio Rest como tal, quien recibe las peticiones desde el exterior
     require_once 'Funciones.php';       
     
     
class TokenForceAPI {
    
    protected $accesoDatos;
        
    public function __construct(){}
             
    public function API(){
        header('Content-Type: application/JSON');                
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET':
             $this->ObtenerInformacion();
             break;     
        case 'POST':
             $this->AgregarUsuario();
             break;                
        case 'PUT':
             $this->AgregarUsuario();
             break;                         
        case 'DELETE':
             $this->EliminarUsuario();
             break;
        default: 
                echo 'Metodo No Valido';
                break;
        }
    }
    
    
 function ObtenerInformacion(){
  if(isset($_GET['action']))
  {       
     $DatoBuscar=NULL;
     if(isset($_GET['id']))
     {
        $DatoBuscar = $_GET['id'];
     }
    
     if ($_GET['action']=='usuarios')
     {
        $controlador = Funciones::CrearControlador(); 
        $ad = new AccesoDatos();
        if ($DatoBuscar!= NULL) 
        {
         $response = $controlador->ObtenerUsuario($DatoBuscar);             
        }    
        else
        {
           $response = $controlador->ObtenerListadoUsuarios();              
        }   
        echo json_encode($response, JSON_PRETTY_PRINT);
     }         
  }
 }
 
 function AgregarUsuario(){
     $obj = json_decode( file_get_contents('php://input') );   
     $objArr = (array)$obj;        
     if (empty($objArr))
     {
        $this->response(422,"Error","No hay datos json");                           
     }
     else
     {
                $usuario = new Usuario();    
                $usuario->setUsuario_id($obj->usuario_id);
                $usuario->setNombres($obj->nombres);
                $usuario->setApellidos($obj->apellidos);
                $controlador = Funciones::CrearControlador();
                $Resultado = $controlador->GuardarUsuario($usuario); 
                if ($Resultado == 0)
                {
                   if ($usuario->getUsuario_id() == 0)
                   {
                     $this->response(200,"Exito", "El nuevo registro ha sido grabado");
                   }
                   else 
                   {
                     if ($Resultado == 0)
                     {  
                       $this->response(200,"Exito", "El registro ha sido actualizado");                         
                     }
                     else if ($Resultado == -2)
                     {             
                       $this->response(200,"Error","No existe este usuario");
                     }  
                     else
                     {
                       $this->response(200,"Error","Se ha producido un error accesando la base de datos");                         
                     }                  
                   }
                }                
                else 
                {
                 $this->response(200,"Error","Se ha producido un error accesando la base de datos");
                }                             
     }
 }
 
 
 function EliminarUsuario(){
  if(isset($_GET['action']))
  {       
     $DatoBuscar=NULL;
     if(isset($_GET['id']))
     {
        $DatoBuscar = $_GET['id'];
     }
    
     if ($_GET['action']=='usuarios')
     {
         $controlador = Funciones::CrearControlador();
         $Resultado = $controlador->EliminarUsuario($DatoBuscar);
         if ($Resultado == 0)
         {
           $this->response(200,"Exito", "El registro ha sido eliminado");
         }
         else if ($Resultado == -2)
         {             
            $this->response(200,"Error","No existe este usuario");
         }
         else
         {             
            $this->response(200,"Error","Se ha producido un error accesando la base de datos");
         }
     }         
  }
 }
 
 
    function response($code=200, $status="", $message="") {
    http_response_code($code);
    if( !empty($status) && !empty($message) ){
        $response = array("status" => $status ,"message"=>$message);  
        echo json_encode($response,JSON_PRETTY_PRINT);    
    }            
 }   
}
