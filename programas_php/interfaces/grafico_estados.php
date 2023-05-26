<?php
include("conexion.php");
session_start();
if ($_SESSION["autenticado"] != "SIx3")
      {
      header('Location: index.php?mensaje=3');
      }
else
      {      
            $mysqli = new mysqli($host, $user, $pw, $db);
    	  $sqlusu = "SELECT * from tipo_usuario where id='2'"; //CONSULTA EL TIPO DE USUARIO CON ID=2, TIPO CONSULTA
        $resultusu = $mysqli->query($sqlusu);
        $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
  	    $desc_tipo_usuario = $rowusu[1];
        if ($_SESSION["tipo_usuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
      }


if(isset($_POST["fecha-inicial"], $_POST["fecha-inicial"])) {
  $fecha_inicial = $_POST["fecha-inicial"];
  $fecha_final = $_POST["fecha-final"];
    $nombre_usuario=$_SESSION["nombre_usuario"];
        $sql1 = "SELECT * from usuarios where nombre_completo = '$nombre_usuario'";
        $result1 = $mysqli->query($sql1);
        
        // Contador para numerar los resultados
        $contador = 0;
    
        // Ciclo while para recorrer los resultados de la consulta
        while ($row1 = $result1->fetch_array(MYSQLI_NUM)) {
            
            $id_veh = $row1[8];
            $id_dis = $row1[7];
            $nombre_completo=$row1[1];
            $contador++;
        }
 

    $sql1 = "SELECT COUNT(CASE WHEN estado_vehiculo='Encendido_detenido' THEN 1 END) AS Encendido_det, fecha
            FROM datos_medidos 
            WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND idDis = '$id_dis' 
            GROUP BY fecha";
  $result = $mysqli->query($sql1);
  
      $sql2 = "SELECT COUNT(CASE WHEN estado_vehiculo='Encendido_movimiento' THEN 1 END) AS Encendido_mov, fecha
            FROM datos_medidos 
            WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND idDis = '$id_dis' 
            GROUP BY fecha";
  $result1 = $mysqli->query($sql2);
  
    $sql3 = "SELECT COUNT(CASE WHEN estado_vehiculo='Apagado' THEN 1 END) AS Apagado, fecha
            FROM datos_medidos 
            WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND idDis = '$id_dis' 
            GROUP BY fecha";
  $result2 = $mysqli->query($sql3);
  

  $data_Apagado = array();
  $data_Encendidodet = array();
  $data_Encendidomov = array();
  $data_fecha = array();


  
    while($row = $result->fetch_assoc()) {
    $data_Encendidodet[] = intval($row["Encendido_det"]);
    $data_fecha[] = $row["fecha"];
  }
      while($row1 = $result1->fetch_assoc()) {
    $data_Encendidomov[] = intval($row1["Encendido_mov"]);
    $data_fecha[] = $row1["fecha"];
  }
  
  while($row2 = $result2->fetch_assoc() ) {
    $data_Apagado[] = intval($row2["Apagado"]);
    $data_fecha[] = $row2["fecha"];
  }

  $result->free();
  $mysqli->close();

  // Codificar los datos como un objeto JSON
    $data_Encendidodet = json_encode($data_Encendidodet);
    $data_Encendidomov = json_encode($data_Encendidomov);
  $data_Apagado = json_encode($data_Apagado);
  $data_fecha = json_encode($data_fecha);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Gráfico de Temperatura y Humedad</title>
	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
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
             <form method=POST action="inicial_propietario.php">
             <input style="background-color: #CACFD2" type=submit color="#FFFFFF" value="Atras" name="Atras">
             </form>
          </li> 
         <li><a href="#"></a></li>
         <li><a href="#"></a></li>
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
                <h1>Graficos estados de vehiculo</h1>
                <p>Selecciona el rango de fechas en el cual deseas visualizar la informacion de tu vehiculo</p>
            </td>
        </tr>
    </table>
    
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="fecha-inicial">Fecha inicial:</label>
    <input type="date" id="fecha-inicial" name="fecha-inicial">
    <label for="fecha-final">Fecha final:</label>
    <input type="date" id="fecha-final" name="fecha-final">
    <input type="submit" value="Generar Gráfico">
  </form>
  <?php if(isset($_POST["fecha-inicial"], $_POST["fecha-final"])) { ?>
  <br>
  <br>
  <div id="grafico"></div>

  <script>
    // Crear el gráfico usando Highcharts
    Highcharts.chart('grafico', {
      title: {
        text: 'Estados del vehiculo'
      },
      xAxis: {
        categories: <?php echo $data_fecha; ?>
      },
      yAxis: [{
        title: {
          text: '.'
        }
      }, {
        title: {
          text: '.'
        },
        opposite: true
      }],

      series: [{
        name: 'Encendido detenido',
        type: 'column',
        data: <?php echo $data_Encendidodet; ?>,
      }, {
        name: 'Encendido en movimiento',
        type: 'column',
        data: <?php echo $data_Encendidomov; ?>,
          },{
        name: 'Apagado',
        type: 'column',
        data: <?php echo $data_Apagado; ?>,
      }],
      exporting: {
        enabled: true
      }
    });
  </script>

  <?php } ?>
  <div id="footer">
    <p>&copy; 2023 Nombre de la Empresa. Todos los derechos reservados.</p>
  </div>

</body>
</html
