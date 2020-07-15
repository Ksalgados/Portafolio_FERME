<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();


	$datos=array(
			$_POST['nombreU'],
			$_POST['apellidoU'],
			$_POST['direccionU'],
			$_POST['telefonoU']);

	echo $obj->agregaCliente($datos);

	
	
 ?>