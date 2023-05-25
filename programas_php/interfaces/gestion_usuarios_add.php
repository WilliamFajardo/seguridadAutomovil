<?php
// PROGRAMA DE MENU ADMINISTRADOR
include "conexion.php";

session_start();
if ($_SESSION["autenticado"] != "SIx3") {
    header('Location: index.php?mensaje=3');
} else {
    $mysqli = new mysqli($host, $user, $pw, $db);
    $sqlusu = "SELECT * from tipo_usuario where id='1'"; //CONSULTA EL TIPO DE USUARIO CON ID=1, ADMINISTRADOR
    $resultusu = $mysqli->query($sqlusu);
    $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
    $desc_tipo_usuario = $rowusu[1];
    if ($_SESSION["tipo_usuario"] != $desc_tipo_usuario)
        header('Location: index.php?mensaje=4');
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <link rel="stylesheet" href="css/estilos_virtual.css" type="text/css">
    <title>Gesti&oacute;n Usuarios Adicionar</title>
    <meta charset="utf-8">
    <title>Sistema de monitoreo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', Arial, sans-serif;
      background-color: #FFFFFF;
      margin: 0;
      padding: 0;
    }
    
    #header {
      background-color: #1F618D;
      text-align: center;
      padding: 20px;
    }
    
    #header img {
      max-width: 100%;
      height: auto;
    }
    
    #content {
      background-color: #D4E6F1;
      display: flex;
      justify-content: space-between;
      margin: 20px;
      padding: 20px;
      border-radius: 10px;
    }
    
    #sidebar {
      width: 30%;
      background-color: #1F618D;
      color: white;
      padding: 20px;
      border-radius: 10px;
    }
    
   
    
    #sidebar form {
      margin-bottom: 20px;
    }
    
    #sidebar label {
      display: block;
      color: white;
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    #sidebar input[type="text"],
    #sidebar input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: none;
    }
    
    #sidebar input[type="submit"] {
      background-color: #2980B9;
      color: white;
      padding: 8px 20px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
    }
    
    #sidebar input[type="submit"]:hover {
      background-color: #1F618D;
    }
    
    #error-message {
      background-color: #FFDDDD;
      color: #FF0000;
      font-weight: bold;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
    }
    
    #content-container {
      width: 65%;
      border-radius: 10px;
      background-color: #FFFFFF;
      padding: 20px;
    }
    
    #content h2 {
      font-size: 24px;
      margin-top: 0;
      margin-bottom: 10px;
      font-weight: bold;
    }
    
    #content ul {
      margin-bottom: 10px;
      padding-left: 20px;
    }
    
    #content ul li {
      margin-bottom: 5px;
    }
    
    .logo-container {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }
    
    .logo-container img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    
    /* Encabezado */
    #header {
      background-color: #1F618D;
      padding: 20px;
      color: white;
    }
    
    #header h1 {
      text-align: center;
      margin: 0;
      font-size: 24px;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 20px;
    }
    
    /* Menú de navegación */
    #navigation {
      background-color: #2980B9;
      padding: 10px;
    }
    
    #navigation ul {
      margin: 0;
      padding: 0;
      list-style: none;
      display: flex;
    }
    
    #navigation li {
      margin-right: 20px;
    }
    
    #navigation a {
      text-decoration: none;
      color: white;
      font-weight: bold;
      font-size: 16px;
    }
    
    /* Contenido principal */
    #content {
      padding: 20px;
    }
    
    #content h2 {
      font-size: 24px;
      margin: 0 0 10px 0;
      font-weight: bold;
    }
    
    #content p {
      margin-bottom: 10px;
    }
    
    /* Pie de página */
    #footer {
      background-color: #1F618D;
      padding: 20px;
      color: white;
      text-align: center;
    }
    h1 {
      text-align: center;
      margin: 0;
      font-size: 24px;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
<!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-lg-5">
            
        </div>
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <img class="logo" src="logo.jpeg" alt="Logo de la empresa" style="width: 200px; height: auto;">
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Horas de atencion</h6>
                        <p class="m-0">8.00AM - 9.00PM</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Correo electronico</h6>
                        <p class="m-0">info@monitoreoSatelital.com</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Llamanos</h6>
                        <p class="m-0">+57 3105192099</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
  
  <div id="navigation">
    <ul>
      
      <li>
        <form method=POST action="gestion_usuarios.php">
         <input style="background-color: #CACFD2" type=submit color="#FFFFFF" value="Atras" name="Atras">
        </form>
      </lil>
      
      <li><a href="#">Inicio</a></li>
      <li><a href="gestion_usuarios.php">Usuarios</a></li>
      <li><a href="#"></a></li>
      <li><a href="#"></a></li>
      <li><a href="#"></a></li>
    </ul>
    
  </div>
  
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
        <tr>
            <td valign="top" align=right>
                <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php echo "Nombre Usuario</u>:   " . $_SESSION["nombre_usuario"]; ?></b></font><br>
                <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php echo "Tipo Usuario</u>:   " . $desc_tipo_usuario; ?></b></font><br>
                <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u><a href="cerrar_sesion.php"> Cerrar Sesion</a></u></b></font>
            </td>
        </tr>
    </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
        <?php
        ?>
        <tr valign="top">
            <td height="20%" align="left" bgcolor="#FFFFFF" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold">
                <h1>Crear nuevo usuario</h1>
            </td>
        </tr>
    </table>
    <?php
    if ((isset($_POST["enviado"]))) {
        //echo "grabar cambios modificación";
        $nombre_completo = $_POST["nombre_completo"];
        $nombre_completo = str_replace("ñ", "n", $nombre_completo);
        $nombre_completo = str_replace("Ñ", "N", $nombre_completo);
        $cedula = $_POST["cedula"];
        $tipo_usuario = $_POST["tipo_usuario"];
        $login = $_POST["login"];
        $estado = $_POST["estado"];
        $password = $_POST["password"];
        $id_dis = $_POST["id_dis"];
	   $id_veh = $_POST["id_veh"];
        $password_enc = md5($password);
        $mysqli = new mysqli($host, $user, $pw, $db);
        $sqlcon = "SELECT * from usuarios where cedula='$cedula'";
        $resultcon = $mysqli->query($sqlcon);
        $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
        $numero_filas = $resultcon->num_rows;

        if ($numero_filas > 0) {
            header('Location: gestion_usuarios.php?mensaje=5');
        } else {
            $sql = "INSERT INTO usuarios(tipo_usuario, nombre_completo, cedula, passwd, login, estado, id_dis, id_veh) 
                    VALUES ('$tipo_usuario','$nombre_completo','$cedula','$password_enc','$login','$estado','$id_dis', '$id_veh')";
            //echo "sql es...".$sql;
            $result1 = $mysqli->query($sql);

            if ($result1 == 1) {
                header('Location: gestion_usuarios.php?mensaje=3');
                exit;
            } else {
                header('Location: gestion_usuarios.php?mensaje=4');
            }
        }
    } else {
        ?>
        <tr valign="top">
            <td width="50%" height="20%" align="right"
                bgcolor="#FFFFFF" class="_espacio_celdas"
                style="color: #FFFFFF;
                font-weight: bold">

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
                            <td bgcolor="#1A5276 " align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Nombre Completo</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="text" name=nombre_completo value="" required>
                            </td>
                        </tr>

                        <tr>
                            <td bgcolor="#1A5276 " align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Cedula</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="number" name=cedula value="" required>
                            </td>
                        </tr>

				<tr>
                            <td bgcolor="#1A5276 " align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Nombre Usuario</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="text" name=login value="" required>
                            </td>
                        </tr>

                        <tr>
                            <td bgcolor="#1A5276" align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Contrase&ntilde;a</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="password" name=password value="" required>
                            </td>
                        </tr>

                        <tr>
                            <td bgcolor="#1A5276" align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Tipo Usuario</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <select name=tipo_usuario required>
                                    <?php
                                    $sql6 = "SELECT * from tipo_usuario order by id DESC";
                                    $result6 = $mysqli->query($sql6);
                                    while ($row6 = $result6->fetch_array(MYSQLI_NUM)) {
                                        $tipo_usuario_con = $row6[0];
                                        $desc_tipo_usuario_con = $row6[1];
                                    ?>
                                        <option value="<?php echo $tipo_usuario_con; ?>"><?php echo $desc_tipo_usuario_con; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        
				<tr>
                            <td bgcolor="#1A5276" align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Estado Dispositivo</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <select name=estado required>
                                    <option value="1">1 (Activo)</option>
                                    <option value="0">0 (Inactivo)</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td bgcolor="#1A5276 " align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Id Tarjeta</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="number" name=id_dis value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#1A5276 " align=center>
                                <font FACE="arial" SIZE=2 color="#FFFFFF"><b>Id Vehiculo</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="text" name=id_veh value="" required>
                            </td>
                        </tr>
                        
                    </table>
                    </br>
                    <input type="hidden" value="S" name="enviado">
                    <table width=50% align=center border=0>
                        <tr>
                            <td width=50%></td>
                            <td align=center><input style="background-color: #58D68D" type=submit color="#FFFFFF" value="Grabar" name="Grabar">
                                </form>
                            </td>
                            <td align=left>
                                <form method=POST action="gestion_usuarios.php">
                                    <input style="background-color: #CACFD2" type=submit color="#FFFFFF" value="Volver" name="Volver">
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
<div id="footer">
    <p>&copy; 2023 Nombre de la Empresa. Todos los derechos reservados.</p>
  </div>
</body>
</html>
