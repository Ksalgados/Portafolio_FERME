<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio - FERME</title>
	<?php require_once "produc_vist.php"; ?>
</head>
<body>


</body>
</html>
<?php 
	}else{
		header("location:../template/productos.php");
	}
 ?>