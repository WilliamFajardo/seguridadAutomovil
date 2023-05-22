<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>Últimos datos de estado</title>
    <meta http-equiv="refresh" content="15" />
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        /* Eliminar bordes predeterminados de la tabla */
        table {
         border-collapse: collapse;
        }

        /* Añadir un borde a la tabla */
        table {
         border: 1px solid #ccc;
        }

        /* Añadir un color de fondo a las filas pares */
        tr:nth-child(even) {
         background-color: #f2f2f2;
        }

        /* Establecer el ancho de la tabla */
        table {
         width: 100%;
        }

        /* Establecer la alineación del texto en las celdas */
        td {
         text-align: center;
        }

        /* Añadir un padding interno a las celdas */
        td {
         padding: 8px;
        }

        /* Establecer un color de fondo para el encabezado de la tabla */
        th {
         background-color: #ddd;
        }

        /* Establecer un color de fuente para el encabezado de la tabla */
        th {
         color: #333;
        }

        th {
            background-color: #E1E1E1;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
        }

        td {
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
        }

        .header {
            background-color: #808080;
            text-align: center;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        .header h1 {
            color: #fff;
            margin: 0;
            padding: 10px 0;
        }

        img {
         display: block;
         margin: 0 auto;
        }
    </style>
</head>

<body>
    <img src="img/encabezado.png" alt="Foto de encabezado" width="90%" />
    <div class="header">
        <h1>Últimos datos de estado del vehiculo</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Id del vehículo</th>
                <th>Estado vehículo</th>
                <th>Fecha</th>
                <th>Hora</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            // Consulta SQL para obtener los últimos 5 datos de estado del vehículo con ID 1
            $sql1 = "SELECT * from datos_medidos where idveh=1 order by id DESC LIMIT 5";
            $result1 = $mysqli->query($sql1);

            // Contador para numerar los resultados
            $contador = 0;

            // Ciclo while para recorrer los resultados de la consulta
            while ($row1 = $result1->fetch_array(MYSQLI_NUM)) {
                $estado_vehiculo = $row1[2];
                $fecha = $row1[7];
                $hora = $row1[8];
                $idveh = 1;
                $contador++;
            ?>
                <tr>
                    <td><?php echo $contador; ?></td>
                    <td><?php echo $idveh; ?></td>
                    <td><?php echo $estado_vehiculo; ?></td>
                    <td><?php echo $fecha; ?></td>
                    <td><?php echo $hora; ?></td>
                    
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>
