<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();


	$datos=array(
			$_POST['rut'],
			$_POST['nombre'],
			$_POST['apellidos'],
			$_POST['usuario'],
			$_POST['direccion'],
			$_POST['telefono'],
				);

	echo $obj->actualizaCliente($datos);

	
	
 ?>