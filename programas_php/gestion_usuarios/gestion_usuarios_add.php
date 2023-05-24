<?php

// PROGRAMA DE MENU ADMINISTRADOR
include "conexion.php";


?>


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
          <link rel="stylesheet" href="css/estilos_virtual.css" 			type="text/css">
           <title> Gesti&oacute;n Usuarios Adicionar </title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="img/invernadero.jpg" border=0 width=350 height=80> 
             	    </td>
                  <td valign="top" align=center width=60%>
                     <h1><font color=green>Sistema de Invernadero Automatizado </font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>  
              <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>  
           </td>
	     </tr>
<?php
include "menu_admin.php";


if ((isset($_POST["enviado"])))
  {
   //echo "grabar cambios modificaci�n";
   $nombre_usuario = $_POST["nombre_usuario"];
   $nombre_usuario = str_replace("�","n",$nombre_usuario);
   $nombre_usuario = str_replace("�","N",$nombre_usuario);
   $num_id = $_POST["num_id"];
   $login = $_POST["login"];
   $estado = $_POST["estado"];
   $password = $_POST["password"];
   $tipo_usuario = $_POST["tipo_usuario"];
   $id_dis = $_POST["id_dis"];
   $id_veh = $_POST["id_veh"]; 
   $mysqli = new mysqli($host, $user, $pw, $db);
   $sqlcon = "SELECT * from usuarios where cedula='$num_id'";
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;
  
   if ($numero_filas > 0)
     { 
     
         header('Location: gestion_usuarios.php?mensaje=5');
     }
   else
    {
      $sql = "INSERT INTO usuarios(nombre_usuario, cedula, login, password, tipo_usuario,  estado, id_dis, id_veh) 
      VALUES ('$nombre_usuario','$num_id','$login','$password','$tipo_usuario','$estado','$id_dis', '$id_veh')";
      //echo "sql es...".$sql;
      $result1 = $mysqli->query($sql);
      
      if ($result1 == 1) 
        {
          header('Location: gestion_usuarios.php?mensaje=3');
        }
      else
         header('Location: gestion_usuarios.php?mensaje=4');
      
    }
}

else

{

   ?>
	
	   <tr valign="top">
                <td width="50%" height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			    <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Gesti&oacute;n Usuarios </h1>  Adici&oacute;n Usuario</b></font>  
          

		       </td>
	          <td width="50%" height="20%" align="right" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			  <img src="img/gestion_usuarios.jpg" border=0 width=115 height=115>    
		       </td>
		     </tr>
   	     <tr>
                  <td colspan=2 width="25%" height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">

                   <form method=POST action="gestion_usuarios_add.php">
                   <table width=50% border=1 align=center>
			    <tr>	
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Nombre Usuario</b></font>  
				</td>	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=nombre_usuario value="" required>  
				</td>	
       </tr>
	     <tr>
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>C&eacute;dula</b></font>  
				</td> 	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="number" name=num_id value="" required>  
				</td>	
			     </tr>
		     <tr>
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Tipo Usuario</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
			    <select name=tipo_usuario required> 
           <?php 	
           $sql6 = "SELECT * from tipo_usuario order by id DESC";
           $result6 = $mysqli->query($sql6);
           while($row6 = $result6->fetch_array(MYSQLI_NUM))
            {
              $tipo_usuario_con = $row6[0];
              $desc_tipo_usuario_con = $row6[1];
           ?>   
              <option value="<?php echo $tipo_usuario_con; ?>"> <?php echo $desc_tipo_usuario_con; ?></option>  
           <?php
            }
           ?>           
          </select>
				</td>	
			     </tr>
	     <tr>
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Usuario</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=login value="" required>  
				</td>	
	     </tr>

	     <tr>
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Contraseña</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="password" name=password value="" required>  
				</td>	
	     </tr>

			 <tr>
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Id Dispositivo</b></font>  
				</td>
			     <td bgcolor="#EEEEEE" align=center> 
				  <input type="number" name=id_dis value="" required>  
				</td>	
       </tr>

       <tr>
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Placa</b></font>  
				</td>
			     <td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=id_veh value="" required>  
				</td>	
       </tr>

	     <tr>
				<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Activo (S/N)</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
          <select name=estado required> 
            <option value="1"> S (Activo)</option>  
            <option value="0"> N (Inactivo)</option>  
          </select>
				</td>	
	     </tr>
      </table>
         </br>
         <input type="hidden" value="S" name="enviado">
         <table width=50% align=center border=0>
           <tr>  
             <td width=50%></td>                                                                       
             <td align=center><input style="background-color: #DBA926" type=submit color= blue value="Grabar" name="Modificar">
                  </form> 
             </td>  
             <td align=left>
                  <form method=POST action="gestion_usuarios.php">                   
                  <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">              
                  </form> 
             </td>  
           </tr>
                   </table>
                  </form> 
<br><br><hr>
                  </td>
                </tr>  

<?php
 }
?>

        </table>
        
       </body>
      </html>


   
