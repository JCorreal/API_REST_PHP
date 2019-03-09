<?php

        $url = 'http://localhost:83/TokenForceAPI/usuarios';         
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                     
        $response = curl_exec($ch);
        curl_close($ch);  
        echo $response;
     
