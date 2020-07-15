<?php 
	session_start();
	include 'emp_carrito.php';
	if(isset($_SESSION['usuario'])){
		
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "emp_index_vist.php"; ?>
</head>
<body>


</body>
</html>
<?php 
	}else{
		header("location:emp_index_vist.php");
	}
 ?>