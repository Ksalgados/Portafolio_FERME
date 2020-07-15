<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new empresa();

    $pass=sha1($_POST['password']);
	$datos=array(
		$_POST['usuario'],
		$pass
				);

	echo $obj->registroUsuario($datos);
 ?>