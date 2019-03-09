<?php
     require_once '../BO/Usuario.php';     
      
     if ($_POST['itCampoClave'] == 'C')
     {        
        $usuario = new Usuario();
        $usuario->setUsuario_id(0);
        $usuario->setNombres(filter_input(INPUT_POST, 'itNombres',FILTER_SANITIZE_STRING));
        $usuario->setApellidos(filter_input(INPUT_POST, 'itApellidos',FILTER_SANITIZE_STRING));
        
        $url = 'http://localhost:83/TokenForceAPI/usuarios'; 
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($usuario));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                
        $response = json_decode(curl_exec($ch), true);                         
        curl_close($ch);  

        if ($response['status'] == 'Exito')  
        {
            echo 'Servicio consumido con exito y datos fueron grabados';
        }
        else 
        {         
            echo 'Error. Servicio no pudo ser ejecutado';
        }
     }
     else 
     {
        if ($_POST['itCampoClave'] == 'R') 
        {
         $DatoBuscar = filter_input(INPUT_POST, 'itUsuario_id');  
         $url = 'http://localhost:83/TokenForceAPI/usuarios/'.$DatoBuscar; 
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");           
       }             
       elseif ($_POST['itCampoClave'] == 'U') 
       {  
           $DatoBuscar = filter_input(INPUT_POST, 'itUsuario_id'); 
           $url = 'http://localhost:83/TokenForceAPI/usuarios/'.$DatoBuscar;
           $usuario = new Usuario();
           $usuario->setUsuario_id(filter_input(INPUT_POST, 'itUsuario_id',FILTER_SANITIZE_NUMBER_INT));
           $usuario->setNombres(filter_input(INPUT_POST, 'itNombres',FILTER_SANITIZE_STRING));
           $usuario->setApellidos(filter_input(INPUT_POST, 'itApellidos',FILTER_SANITIZE_STRING));       
           $ch = curl_init($url);
           curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($usuario));
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
       }
       elseif ($_POST['itCampoClave'] == 'D') 
       {
         $DatoBuscar = filter_input(INPUT_POST, 'itUsuario_id');  
         $url = 'http://localhost:83/TokenForceAPI/usuarios/'.$DatoBuscar ; 
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");       
       }     
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                     
          $response = curl_exec($ch);
          curl_close($ch);  
          echo $response;
     
     }
      


 