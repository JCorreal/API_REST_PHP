<?php
     require_once '../BO/Usuario.php';     
     
     if ($_POST['itCampoClave'] == 'R') // R=Read Consultar un Usuario
     {
         $DatoBuscar = filter_input(INPUT_POST, 'itUsuario_id',FILTER_SANITIZE_NUMBER_INT);  
         $url = 'http://localhost:83/TokenForceAPI/usuarios/'.$DatoBuscar; 
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");           
     }                  
     elseif ($_POST['itCampoClave'] == 'D') // D=Delete Eliminar un Usuario
     {
         $DatoBuscar = filter_input(INPUT_POST, 'itUsuario_id',FILTER_SANITIZE_NUMBER_INT);  
         $url = 'http://localhost:83/TokenForceAPI/usuarios/'.$DatoBuscar ; 
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");       
     }    
     else // Create o Update
     {
        $usuario = new Usuario();
        $usuario->setUsuario_id(filter_input(INPUT_POST, 'itUsuario_id',FILTER_SANITIZE_NUMBER_INT));
        $usuario->setNombres(filter_input(INPUT_POST, 'itNombres',FILTER_SANITIZE_STRING));
        $usuario->setApellidos(filter_input(INPUT_POST, 'itApellidos',FILTER_SANITIZE_STRING));     
        
        $url = 'http://localhost:83/TokenForceAPI/usuarios'; 
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($usuario));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");             
     }
        
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                     
     $response = curl_exec($ch);
     curl_close($ch);  
     echo $response;         
