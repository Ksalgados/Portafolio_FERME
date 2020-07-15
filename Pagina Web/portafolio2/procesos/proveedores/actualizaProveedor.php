<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedores.php";

	$obj= new proveedores;

	$datos=array(
			$_GET['status'],
			$_GET['orden']
			);

	echo $obj->actualizaProveedor($datos);

	
	
 ?>