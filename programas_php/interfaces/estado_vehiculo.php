<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

       <head>
           <title> Estado del vehiculo </title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="img/monitoreo.png" border=0 width=350 height=80> 
             	    </td>
                         <td valign="top" align=center width=60%>
            <h1><font color=black>Sistema de Seguridad Vehicular </font></h1>
        </td>
        <td valign="top" align=right>
            <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Nombre Usuario</u>:".$_SESSION["nombre_usuario"];?> </b></font><br>
            <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>  
             <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="inicio_sesion.php"> Cerrar Sesion </a></u></b></font>  
        </td>

           	    </tr>
         	    </table>
           </td>
	     </tr>
     </table>
     
         <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
               <a href="https://invernaderom.000webhostapp.com/programasSERVIDOR_php/interfaces/inicial_propietario.php">
            <button>Volver</button>
            </a>
                <?php
                        include "menu_propietario.php";
                        ?>
           
	  	    <tr valign="top">
             <td height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			    <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Estado del vehiculo </h1></b></font>  


		       </td>
		     </tr>
		    </table>

	
</head>

<body>

    
    <!-- El resto del contenido de la página aquí -->
    
  
    <meta http-equiv="refresh" content="15" />
<table width=80% border=1 align=center>
			 <tr>	
				<td bgcolor="#1A5276" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Id del Vehículo</b></font>  
				</td>	
				<td bgcolor="#1A5276" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Estado vehiculo</b></font>  
				</td> 	
				<td bgcolor="#1A5276" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Estado Dispositivo</b></font>  
				</td> 
				<td bgcolor="#1A5276" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Fecha</b></font>  
				</td> 	
				<td bgcolor="#1A5276" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Hora</b></font>  
				</td>
			</tr>
        




<tr>	
            <?php
            // Consulta SQL para obtener los últimos 5 datos de estado del vehículo con ID 1
            $sql1 = "SELECT * from datos_medidos where idVeh=2 order by id DESC LIMIT 1";
            $result1 = $mysqli->query($sql1);

            // Contador para numerar los resultados
            $contador = 0;

            // Ciclo while para recorrer los resultados de la consulta
            while ($row1 = $result1->fetch_array(MYSQLI_NUM)) {
                $estado_vehiculo = $row1[2];
                $estado_dispositivo=$row1[4];
                $fecha = $row1[7];
                $hora = $row1[8];
                $idVeh = 1;
                $contador++;
            ?>
				<td bgcolor="FFFFFF" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b> <?php echo $idVeh; ?></b></font>  
				</td>	
				<td bgcolor="FFFFFF" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $estado_vehiculo; ?></b></font>  
				</td>	
				<?php 
				if ($estado_dispositivo == '1') {
				    $estado_dispositivo = "Activo";
				}
				else{
				   $estado_dispositivo = "Inactivo";  
				}
				?>
				<td bgcolor="FFFFFF" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $estado_dispositivo; ?></b></font>  
				</td>
			
				<td bgcolor="FFFFFF" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $fecha; ?></b></font>  
				</td> 	
				<td bgcolor="FFFFFF" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $hora; ?></b></font>  
				</td>
				</tr>
            <?php
            }
            ?>
        
    </table>
</body>

</html>