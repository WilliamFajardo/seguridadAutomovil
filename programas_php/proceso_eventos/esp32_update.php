<?php

include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.


//Read the database
if (isset($_POST['check_LED_status'])) {
	$led_id = $_POST['check_LED_status'];	
	$sql = "SELECT * FROM datos_dispositivo WHERE id = '$led_id';";
	$result   = mysqli_query($mysqli, $sql);
	$row  = mysqli_fetch_assoc($result);
	if($row['estado_dispositivo'] == 0){
		echo "LED_is_off";
	}
	else{
		echo "LED_is_on";
	}	
}	

//Update the database
if (isset($_POST['cambiar_estado'])) {
	$led_id = $_POST['cambiar_estado'];	
	$sql = "SELECT * FROM datos_dispositivo WHERE id = '$led_id';";
	$result   = mysqli_query($mysqli, $sql);
	$row  = mysqli_fetch_assoc($result);
	if($row['estado_dispositivo'] == 0){
		$update = mysqli_query($conn, "UPDATE datos_dispositivo SET estado_dispositivo = 1 WHERE id = 1;");
		echo "LED_is_on";
	}
	else{
		$update = mysqli_query($mysqli, "UPDATE datos_dispositivo SET estado_dispositivo = 0 WHERE id = 1;");
		echo "LED_is_off";
	}	
}	
?>