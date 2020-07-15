<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes;

	$datos=array(
			$_POST['idUsuario'],
			$_POST['nombreU'],
			$_POST['apellidoU'],
			$_POST['direccionU'],
			$_POST['telefonoU']
				);

	echo $obj->actualizaCliente($datos);

	
	
 ?>