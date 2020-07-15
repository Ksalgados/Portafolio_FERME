<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();

	
	echo $obj->eliminarCliente($_POST['idusuario']);
 ?>