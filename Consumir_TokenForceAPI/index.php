<html>
    <head>
        <meta charset="UTF-8">
        <title>Consumir TokenForceAPI</title>
    </head>
    <body>
        <form method="post" action="BLL/Controlador.php">
            <div style="align-content: center">
            <table border="1" >
                <thead>
                </thead>
                <tbody>
                    
                    <tr>
                        <th>Nombres *</th>
                        <th>        
                            <input type="text"                       
                                    id="itNombres" 
                                    name="itNombres" 
                                    required="required"
                                    maxLength="25"        
                                    placeholder="Nombres del Usuario">          
                            </input>
                        </th>
                    </tr>
                    <tr>
                        <th>Apellidos *</th>
                        <td>
                            <input type="text"                        
                                   id="itApellidos"
                                   name="itApellidos"                        
                                   required="required"             
                                   maxLength="25"
                                   placeholder="Apellidos del Usuario">                       
                            </input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Enviar"/>
                        </td>                    
                    </tr>
                </tbody>
            </table>

            </div>     

        </form>
    </body>
</html>
