<?php
     require_once '../BO/Usuario.php';
     
     $usuario = new Usuario();
     $usuario->setNombres(filter_input(INPUT_POST, 'itNombres',FILTER_SANITIZE_STRING));
     $usuario->setApellidos(filter_input(INPUT_POST, 'itApellidos',FILTER_SANITIZE_STRING));
             
     if ($usuario != NULL)
     {
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
