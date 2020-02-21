<?php

        $url = 'http://localhost/TokenForceAPI/usuarios';         
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                     
        $response = curl_exec($ch);
        curl_close($ch);  
        
        $a = json_decode($response, true);

        $s = '<table border="1"> 
            <tr>                         
              <th>ID</th>
              <th>Nombres</th>
              <th>Apellidos</th>
            </tr>';
        
        foreach ( $a as $r ) {
                $s .= '<tr>';
                foreach ( $r as $v ) {
                        $s .= '<td>'.$v.'</td>';
                }
                $s .= '</tr>';
        }
        $s .= '</table>';

        echo $s;

