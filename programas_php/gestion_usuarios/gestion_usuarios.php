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

    // Recuperar el número de tarjeta asociado al usuario que se va a eliminar
    $sqlTarjeta = "SELECT id_dis FROM usuarios WHERE id = '$idEliminar'";
    $resultTarjeta = $mysqli->query($sqlTarjeta);

    if ($resultTarjeta->num_rows > 0) {
        $rowTarjeta = $resultTarjeta->fetch_assoc();
        $idDis = $rowTarjeta['id_dis'];

        // Realizar la eliminación en la base de datos
        $sqlEliminar = "DELETE FROM usuarios WHERE id = '$idEliminar'";
        if ($mysqli->query($sqlEliminar)) {
            // Actualizar el estado de la tarjeta a "disponible"
            $sqlUpdate = "UPDATE tarjetas SET estado = 'disponible' WHERE id = '$idDis'";
            if ($mysqli->query($sqlUpdate)) {
                // Eliminación y actualización exitosas

                // Redireccionar a la página actual para mostrar la tabla actualizada
                header("Location: gestion_usuarios.php");
                exit();
            } else {
                // Error al actualizar el estado de la tarjeta
                echo "Error al actualizar el estado de la tarjeta: " . $mysqli->error;
            }
        } else {
            // Error al eliminar el usuario
            echo "Error al eliminar el usuario: " . $mysqli->error;
        }
    } else {
        // No se encontró el número de tarjeta asociado al usuario
        echo "Error: no se encontró el número de tarjeta asociado al usuario.";
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
                    </tr>
                </table>
            </td>
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
                <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Gesti&oacute;n Usuarios </h1></b></font>
            </td>
        </tr>
    </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
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

    <table width="100%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
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
</body>
</html>