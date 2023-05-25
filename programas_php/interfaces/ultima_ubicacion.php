<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
         <title> Ultima ubicacion de su vehiculo:</title>
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
                 <td valign="top" align=center width=100%>
			    <font FACE="arial" SIZE=2 color="#1a5276" align=left> <b><h1>Última ubicación  </h1></b></font>  


		       </td>
		     </tr>
		    </table>

	
</head>
<body>
    


<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 50%;
       }
    </style>
  </head>
  <body>
<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
$sqlubi = "SELECT * from datos_medidos where idVeh=2 order by id DESC LIMIT 1"; //CONSULTA LA ULTIMA UBICACION AGREGADA A LA TABLA UBICACIONES
$resultubi = $mysqli->query($sqlubi);
$rowubi = $resultubi->fetch_array(MYSQLI_NUM);
$latitud = $rowubi[5];
$longitud = $rowubi[6];

?>

    
    <div id="map"></div>
    <script>
      function initMap() {
        var latit= <?php echo $latitud ?>;
        var longi= <?php echo $longitud ?>;
        var uluru = {lat: latit, lng: longi};
        
       
        
        
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
          center: uluru
          
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"> <!-- Se deben reemplazar el espacio vacio por la API Key de Google MAPS, si se quiere ver el mapa sin el mensaje de "For development purposes only"-->
    </script>
  </body>
</html>