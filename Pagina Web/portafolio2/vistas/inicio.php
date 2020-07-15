<?php 
	session_start();
	include '../template/carrito.php';
	if(isset($_SESSION['usuario'])){
		
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio - FERME</title>
	<?php require_once "index_vist.php"; ?>
</head>
<body>


</body>
</html>
<?php 
	}else{
		header("location:index_vist.php");
	}
 ?>