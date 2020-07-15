<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Empresas.php";

	$obj= new empresas();


	$datos=array(
			$_POST['rutU'],
			$_POST['nombreU'],
			$_POST['direccionU'],
			$_POST['telefonoU'],
			$_POST['rubroU']);

	echo $obj->agregaEmpresa($datos);

	
	
 ?>