<?php
     require_once '../BO/Usuario.php';     
     
     $url = 'http://localhost/TokenForceAPI/usuarios/'. filter_input(INPUT_POST, 'itUsuario_id',FILTER_SANITIZE_NUMBER_INT);
     
     if ($_POST['itCampoClave'] == 'R') // R = Read Consultar un Usuario
     {
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");           
     }                  
     elseif ($_POST['itCampoClave'] == 'D') // D = Delete Eliminar un Usuario
     {
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");       
     }    
     else // Create o Update
     {
        $usuario = new Usuario();
        $usuario->setUsuario_id(filter_input(INPUT_POST, 'itUsuario_id',FILTER_SANITIZE_NUMBER_INT));
        $usuario->setNombres(filter_input(INPUT_POST, 'itNombres',FILTER_SANITIZE_STRING));
        $usuario->setApellidos(filter_input(INPUT_POST, 'itApellidos',FILTER_SANITIZE_STRING));     
                
        $ch = curl_init('http://localhost/TokenForceAPI/usuarios');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($usuario));        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");             
     }
        
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                     
     $response = curl_exec($ch);
     curl_close($ch);  
     
     if ($_POST['itCampoClave'] == 'R')
     {
           $obj = json_decode($response);
            if ($obj!=NULL)
            {   
                $nombres = $obj->{'nombres'};
                echo "Nombres: <input type='text' value=$nombres>";
                echo '<br><br>';         
                $apellidos = $obj->{'apellidos'}; 
                echo "Apellidos: <input type='text' value=$apellidos>";
            }
            else
            {
                echo 'Usuario no existe';
            }
     }     
     else
     {
         $obj = json_decode($response);
         print $obj->{'status'}; 
         echo '<br><br>';
         print $obj->{'message'};
     }
