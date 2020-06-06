<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new Empresa();

    $pass=sha1($_POST['password']);
    $id_tip=40;
	$datos=array(
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['usuario'],
        $pass,
        $id_tip,
				);

	echo $obj->registroUsuario($datos);

?>