<?php

// PROGRAMA DE MENU ADMINISTRADOR
include "conexion.php";
     
    // Termina codigo php para validaciones. listo

?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
           <title> Gestion De Usuarios </title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="img\logo_monitoreo.jpeg" border=0 width=350 height=80> 
             	    </td>
                  <td valign="top" align=center width=60%>
                     <h1><font color=black>Sistema de Seguridad Vehicular </font></h1>
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
     </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_admin.php";
?>
	  	    <tr valign="top">
             <td height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			    <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Gesti&oacute;n Usuarios </h1></b></font>  


		       </td>
	          <td height="20%" align="right" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			  <img src="img/gestion_usuarios.jpg" border=0 width=115 height=115>    
		       </td>
		     </tr>
		    </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
      <tr>
       <td align=left width=50%>
        <form action="gestion_usuarios.php" method="POST">
         <table border=0 width=100%>   
          <tr>
           <td align=left >
             <font FACE="arial" SIZE=2 color="#000000">Consulta por Cedula: <input type="number" name=id_con value=""></font>
           </td>
           <td align=right >
             <font FACE="arial" SIZE=2 color="#000000">Consulta por Placa: <input type="text" name=placa_con value=""></font>
           </td>
          </tr>
         </table>
        </td>
       <td align=left width=50%>
         <table border=0 width=100%>   
          <tr>
           <td align=right width=50%>
             <font FACE="arial" SIZE=2 color="#000000">Estado Usuario: 
             <select name=estado>
             <?php
             if (isset($_POST["estado"]))
              {
                $estado = $_POST["estado"];
                 if ($_POST["estado"]!="")
                  {  
                    if ($estado == "2")
                     {
                      echo "<option value=".$estado."> Todos los Usuarios</option>";
                      echo "<option value=1> Usuarios solo Activos</option>";
                      echo "<option value=0> Usuarios solo Inactivos</option>";
                     }
                    else if ($estado == "1")
                     {
                      echo "<option value=".$estado."> Usuarios solo Activos</option>";
                      echo "<option value=2> Todos los Usuarios</option>";
                      echo "<option value=0> Usuarios solo Inactivos</option>";
                     }
                    else if ($estado == "0")
                     { 
                      echo "<option value=".$estado."> Usuarios solo Inactivos</option>";
                      echo "<option value=2> Todos los Usuarios</option>";
                      echo "<option value=1> Usuarios solo Activos</option>";
                     }
                  }  
               }
              else
               {
                 ?>
                  <option value=2> Todos los Usuarios</option>
                  <option value=1> Usuarios solo Activos </option>
                  <option value=0> Usuarios solo Inactivos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
              <?php
               }
              ?>  
              </select>
           </td>
           <td align=center width=50%>
             <font FACE="arial" SIZE=2 color="#000000"><input type="submit" name=Consultar value="Consultar"></font>
           </td>
          </tr>
         </table>
          <input type="hidden" value="1" name="enviado">
         </form>
        </td>
      </tr>


      <tr>
       <td>
         &nbsp;&nbsp;&nbsp;
       </td>
      <td align=center>
        <a href="gestion_usuarios_add.php"> <b>Agregar Nuevo Usuario </b></a>    
      </td>
      </tr>
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
      
  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php 
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario actualizado correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue actualizado correctamente.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario creado correctamente.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Se present� un inconveniente";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Ya existe usuario con la misma c�dula.";
                      ?>
                    </td>
                   </tr>
                  </table>
              </td>
    		     </tr>
           <?php
            }
           }   
            ?>                         

	  	     <tr>
                  <td colspan=2 height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">

     <table width=80% border=1 align=center>
			 <tr>	
				<td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Nombre Completo</b></font>  
				</td>	
				<td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>C&eacute;dula</b></font>  
				</td> 	
				<td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Usuario</b></font>  
				</td>
				<td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Tipo Usuario</b></font>  
				</td>
				<td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Id Dispositivo</b></font>  
				</td>
        <td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Placa</b></font>  
				</td>
				<td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Activo (S/N)</b></font>  
				</td>
   	            <td bgcolor="#006699" align=center> 
				  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Modificar</b></font>  
				</td>
			</tr>
				  
<?php
         $mysqli = new mysqli($host, $user, $pw, $db);
		     if ((isset($_POST["enviado"])))
         {
           $id_con = $_POST["id_con"];
           $placa_con = $_POST["placa_con"];
           $estado = $_POST["estado"];
           $sql1 = "SELECT * from usuarios order by nombre_completo";
           if (($id_con == "") and ($placa_con == ""))
             {
              if ($estado != "2")
                $sql1 = "SELECT * from usuarios where estado='$estado' order by nombre_completo";
             }
           if (($id_con != "") and ($placa_con == ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuarios where cedula='$id_con'";
              else
                $sql1 = "SELECT * from usuarios where cedula='$id_con' and estado='$estado'";
             }
           if (($id_con == "") and ($placa_con != ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuarios where id_veh LIKE '%$placa_con%' order by nombre_completo";
              else
                $sql1 = "SELECT * from usuarios where id_veh LIKE '%$placa_con%' and estado='$estado' order by nombre_completo";
              }
           if (($id_con != "") and ($placa_con != ""))
             {
              if ($estado == "2")
                 $sql1 = "SELECT * from usuarios where id_veh LIKE '%$placa_con%' and cedula='$id_con'";
              else
                $sql1 = "SELECT * from usuarios where id_veh LIKE '%$placa_con%' and cedula='$id_con' and estado='$estado'";
             }      
          }
         else
             $sql1 = "SELECT * from usuarios order by nombre_completo";
             
         //echo "sql1 es...".$sql1;
         
         $result1 = $mysqli->query($sql1);
         while($row1 = $result1->fetch_array(MYSQLI_NUM))
         {
		   $id_usu  = $row1[0];
		   $id_usu_enc = md5($id_usu);
		   $nombre_usuario  = $row1[1];
	       $num_id = $row1[2];
	       $usuario = $row1[3];
           $tipo_usuario  = $row1[5];
           $id_dis = $row1[7];
           $id_veh = $row1[8];
	       $activo= $row1[6];
			    if ($activo == 1)
				    $desc_activo = "S";
			    else
				    $desc_activo = "N";

     	   $sql3 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
           $result3 = $mysqli->query($sql3);
           $row3 = $result3->fetch_array(MYSQLI_NUM);
			    $desc_tipo_usuario = $row3[1];

?>
		
		        <tr>	
				<td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b> <?php echo $nombre_usuario; ?></b></font>  
				</td>	
				<td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $num_id; ?></b></font>  
				</td>		
				<td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $usuario; ?></b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $desc_tipo_usuario; ?></b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $id_dis; ?></b></font>  
				</td>
        <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $id_veh; ?></b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $desc_activo; ?></b></font>  
				</td>
        <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <a href="gestion_usuarios_mod.php?id_usu=<?php echo $id_usu_enc; ?>"> <img src="img/icono_editar.jpg" border=0 width=40 height=30></a></font>  
				</td>
	     </tr>
		     
	     	         
<?php
			   }
?>


                   </table>
<br><br><hr>
                  </td>
                </tr>  
        </table>
        
       </body>
      </html>


   