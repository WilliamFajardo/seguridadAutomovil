<?php
// PROGRAMA DE MENU ADMINISTRADOR
include "conexion.php";
session_start();
if ($_SESSION["autenticado"] != "SIx3") {
    header('Location: index.php?mensaje=3');
    exit();
} else {
    $mysqli = new mysqli($host, $user, $pw, $db);
    $sqlusu = "SELECT * from tipo_usuario where id='1'"; //CONSULTA EL TIPO DE USUARIO CON ID=1, ADMINISTRADOR
    $resultusu = $mysqli->query($sqlusu);
    $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
    $desc_tipo_usuario = $rowusu[1];
    if ($_SESSION["tipo_usuario"] != $desc_tipo_usuario) {
        header('Location: index.php?mensaje=4');
        exit();
    }
}

// Termina codigo php para validaciones.

if (isset($_POST['eliminar_id'])) {
    $idEliminar = $_POST['eliminar_id'];

    // Realizar la eliminación en la base de datos
    $sqlEliminar = "DELETE FROM usuarios WHERE id = '$idEliminar'";
    if ($mysqli->query($sqlEliminar)) {
        // Eliminación exitosa

        // Redireccionar a la página actual para mostrar la tabla actualizada
        header("Location: gestion_usuarios.php");
        exit();
    } else {
        // Error al eliminar el usuario
        echo "Error al eliminar el usuario: " . $mysqli->error;
    }
}

if (isset($_POST["id_con"]) || isset($_POST["nom_con"])) {
    $idCon = $_POST["id_con"];
    $nomCon = $_POST["nom_con"];

    if (!empty($idCon) && !empty($nomCon)) {
        $sqlbus = "SELECT * FROM usuarios WHERE cedula LIKE '%" . $idCon . "%' AND nombre_completo LIKE '%" . $nomCon . "%' ORDER BY nombre_completo ASC";
    } elseif (!empty($idCon)) {
        $sqlbus = "SELECT * FROM usuarios WHERE cedula LIKE '%" . $idCon . "%' ORDER BY nombre_completo ASC";
    } elseif (!empty($nomCon)) {
        $sqlbus = "SELECT * FROM usuarios WHERE nombre_completo LIKE '%" . $nomCon . "%' ORDER BY nombre_completo ASC";
    } else {
        $sqlbus = "SELECT * FROM usuarios ORDER BY nombre_completo ASC";
    }
} else {
    $sqlbus = "SELECT * FROM usuarios ORDER BY nombre_completo ASC";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Gestion De Usuarios</title>
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
    /* Pie de página */
    #footer {
      background-color: #1F618D;
      padding: 20px;
      color: white;
      text-align: center;
    }
    
    #sidebar {
      width: 30%;
      background-color: #1F618D;
      color: white;
      padding: 20px;
      border-radius: 10px;
    }
    
    #sidebar h2 {
      margin: 0;
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
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
    
    #content p {
      line-height: 1.5;
      margin-bottom: 10px;
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
    h1 {
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
                <h1>Gestión Usuarios</h1>
            </td>
        </tr>
    </table>
    <table width="90%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
        <tr>
            <td align=left width=50%>
                <form action="gestion_usuarios.php" method="POST">
                    <table border=0 width=100%>
                        <tr>
                            <td align=left>
                                <font FACE="arial" SIZE=2 color="#000000">Consulta por Cedula: <input type="number" name=id_con value="" size=6 maxlength=6></font>
                            </td>
                            <td align=left>
                                <font FACE="arial" SIZE=2 color="#000000">Consulta por Nombre: <input type="text" name=nom_con value="" size=25 maxlength=40></font>
                            </td>
                            <td align=left>
                                <input type="submit" value="Consultar"></font>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            <td align=right width=50%>
                <?php
                if (isset($_GET["mensaje"])) {
                    if ($_GET["mensaje"] == "1") {
                        echo "<b><font color='red'>Se ha registrado el Usuario correctamente</font></b><br>";
                    }
                    if ($_GET["mensaje"] == "2") {
                        echo "<b><font color='red'>El Usuario ya se encuentra registrado</font></b><br>";
                    }
                    if ($_GET["mensaje"] == "3") {
                        echo "<b><font color='red'>No ha iniciado sesion. Debe autenticarse</font></b><br>";
                    }
                }
                ?>
                <a href="gestion_usuarios_add.php"> <b><font color="#FF0000">Agregar Usuario</font></b></a>
            </td>
        </tr>
    </table>

    <table width="90%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
        <tr bgcolor="#1A5276">
            <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>ID Usuario</b></font></th>
            <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>Nombre Completo</b></font></th>
            <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>Cedula</b></font></th>
            <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>Nombre Usuario</b></font></th>
	      <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>Tipo Usuario</b></font></th>
   	      <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>Estado Dispositivo</b></font></th>
	      <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>ID Tarjeta</b></font></th>
	      <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>ID Vehiculo</b></font></th>
     	      <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>Editar</b></font></th>
            <th><font FACE="arial" SIZE=2 color="#FFFFFF"><b>Eliminar</b></font></th>
        </tr>
        <?php
        $resultado = $mysqli->query($sqlbus);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_array(MYSQLI_NUM)) {
                echo "<tr>";
                echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[0] . "</font></td>";
                echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[1] . "</font></td>";
                echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[2] . "</font></td>";
                echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[3] . "</font></td>";
		    echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[5] . "</font></td>";
		    echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[6] . "</font></td>";
		    echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[7] . "</font></td>";
		    echo "<td><font FACE='arial' SIZE=2 color='#000000'>" . $row[8] . "</font></td>";
        
   echo '<td><a href="gestion_usuarios_mod.php?id=' . $row[0] . '">';
    echo '<img src="img/icono_modificar.jpg" alt="Editar"></a></td>';

    $idUsuario = $row[0];
    echo '<td>';
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="eliminar_id" value="' . $idUsuario . '">';
    echo '<button type="submit">Eliminar</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
            }
        } else {
            echo "<tr><td colspan='5'><font FACE='arial' SIZE=2 color='#000000'>No se encontraron resultados</font></td></tr>";
        }
        $mysqli->close();
        ?>
    </table>
    <br>
    <br>
    <div id="footer">
    <p>&copy; 2023 Nombre de la Empresa. Todos los derechos reservados.</p>
  </div>
</body>
</body>
</html>