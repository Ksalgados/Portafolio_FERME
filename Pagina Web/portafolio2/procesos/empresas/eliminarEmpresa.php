<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Empresas.php";

	$obj= new empresas();

	
	echo $obj->eliminarEmpresa($_POST['idusuario']);
 ?>