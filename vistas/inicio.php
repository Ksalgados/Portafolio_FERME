<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "index_vist.php"; ?>
</head>
<body>


</body>
</html>
<?php 
	}else{
		header("location:.index_vist.php");
	}
 ?>