<?php 
	require_once "../clases/Conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where email='admin'";
	$result=mysqli_query($conexion,$sql);
	$validar=0;
	if(mysqli_num_rows($result) > 0){
		$validar=1;
	}
 ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Seleccion Usuario - FERME</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
    <script>
        window.jQuery || document.write('<script src="../js/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="../js/modernizr.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">
	<script src="../librerias/jquery-3.2.1.min.js"></script>
	<script src="../js/funciones.js"></script>
</head>

<body class="text-center">
    <form class="form-signin">
        <img class="mb-4" src="https://icon-icons.com/icons2/1090/PNG/72/settings_78352.png" width="72"
            height="72">
        <h1 class="h3 mb-3 font-weight-normal">Ingrese a su cuenta</h1>
        <button class="btn btn-lg border-dark btn-block"><a href="../vistas/emp/login_emp.php" >Ingresar Empresa</a></button>
        <br>
        <button class="btn btn-lg border-dark btn-block"><a href="login.php">Ingresar Cliente</a></button>
        <br>
        <a href="../index.php">Volver</a>
    </form>
</body>

</html>