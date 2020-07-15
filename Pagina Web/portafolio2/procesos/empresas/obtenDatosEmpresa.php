<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Empresas.php";

	$obj= new empresas();

	echo json_encode($obj->obtenDatosEmpresa($_POST['idusuario']));

 ?>