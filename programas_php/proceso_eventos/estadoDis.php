<?php
include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.

// Conexión a la base de datos
//$conn = mysqli_connect($host, $user, $password, $dbname);
$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

// Verificar la conexión
if (!$conn) {
  die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta para obtener el estado del dispositivo según su ID
$id = $_GET["idDis"];; // ID del dispositivo a consultar
$sql = "SELECT estado_dispositivo FROM dispositivo WHERE idDis = $id";
$result = mysqli_query($conn, $sql);

// Verificar si la consulta fue exitosa
if (!$result) {
  die("Error al ejecutar la consulta: " . mysqli_error($conn));
}

// Obtener el estado del dispositivo
$row = mysqli_fetch_assoc($result);
$estado = $row['estado'];

// Enviar el estado del dispositivo a Arduino
echo $estado; //
