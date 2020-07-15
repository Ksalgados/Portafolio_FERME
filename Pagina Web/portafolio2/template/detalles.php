<?php
  include '../clases/configuracion.php';
  include '../clases/conn.php';
  include '../template/carrito.php';
?>
<html>
<head>
<?php
require_once "../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT * FROM producto WHERE id_produc='$id' LIMIT 1";
	$result = mysqli_query($conexion,$sql);
	$productCount = mysqli_num_rows($result);
	if($productCount>0){
		
		while($row = mysqli_fetch_array($result)){
			$name = $row["nombre"];
			$price = $row["precio"];
			$details = $row["descripcion"];
			$brand = $row["marca"];
			$image = $row["imagen"];
			$id = $row["id_produc"];
		}
		
	}else{
		echo "That item does not exist.";
		exit();
	}
}else{
	echo "No product in the system with that ID.";
	exit();
}
?>

    <title><?php echo $name; ?> - FERME</title>
    <?php
  include '../php/links.php';
?>
<style>
p.padding {
  padding-top: 2cm;
}

p.padding2 {
  padding-top: 5%;
}
p.padding3 {
	padding-left: 2%;
}
td.border2 {
	border-left: 3px double;
}
</style>
</head>
<body>
    <?php
  include 'navbar_temp.php';
?>


<?php

			echo 
	'<div  align="center" id="mainWrapper" padding-top=50px >
	<p class="padding2">
	<table width="70%" border="4px" cellspacing="0" cellpadding="10">
  <tr>
    <td  width="20%" valign="top">
      <img
                title=' .$name. '
                alt='.$name.'
                src="data:image/jpeg; base64,'. base64_encode($image).'"
                data-toggle="popover"
                data-trigger="hover"
                style="float:left;width:100%;"
                id="imagen"
                name="imagen"
                ></td>
    <td class="border2" width="50%" Style="background:#FFEDEA" valign="top"><h3>Latest Designer Fashions</h3>
	<p class="padding3">
      <span>Precio: ' .$price. '</span>
			<br>
			<span>Nombre: ' .$name. '</span>
			<br>
			<span>Marca: ' .$brand. '</span>
			<br>
			<span>Codigo: ' .$id. '</span>
			<br>
			<br>
			<br>
			<span>' .$details. '</span>
			</p></td>
			
  </tr>
</table>
</p>
</div>';
			


?>

</body>
</html>
