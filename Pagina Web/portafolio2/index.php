<?php
  include 'clases/configuracion.php';
  include 'clases/Conexion.php';
  include 'template/carrito.php';
  include 'clases/conn.php';
  require __DIR__ .  '/extensiones/vendor/autoload.php';
	
	$c=new conectar();
	$conexion=$c->conexion();
	date_default_timezone_set('America/Santiago');
	$horario="";
	$hoy = date("l");
	$time = date("G");
	if($time>5 and $time<11){
		$horario="mañana";
	}
	if($time>10 && $time<20){
		$horario="tarde";
	}
	if($time>19 and $time<24 || $time>=0 && $time<6){
		$horario="noche";
	}
	
	if($hoy=='Monday'){
		$hoy="Lunes";
		if($horario=="mañana"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="tarde"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="noche"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
	}
	if($hoy=='Tuesday'){
		$hoy="Martes";
		if($horario=="mañana"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="tarde"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="noche"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
	}
	if($hoy=='Wednesday'){
		$hoy="Miercoles";
		if($horario=="mañana"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="tarde"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="noche"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
	}
	if($hoy=='Thursday'){
		$hoy="Jueves";
		if($horario=="mañana"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="tarde"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="noche"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
	}
	if($hoy=='Friday'){
		$hoy="Viernes";
		if($horario=="mañana"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="tarde"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="noche"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
	}
	if($hoy=='Saturday'){
		$hoy="Sabado";
		if($horario=="mañana"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="tarde"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="noche"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
	}
	if($hoy=='Sunday'){
		$hoy="Domingo";
		if($horario=="mañana"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="tarde"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
		if($horario=="noche"){
			$sqlcount="UPDATE `informeestadis` SET `contador_visit`= contador_visit + 1 where `dias-mas_acce`='$hoy' AND `horario`='$horario'";
			$result=mysqli_query($conexion,$sqlcount);
		}
	}
	
	
	
	
  
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ferreteria FERME</title>
    <?php
  include 'php/links.php';
?>
</head>

<body>
    <?php
  include 'php/navbar.php';
?>
    <?php
  include 'php/carrusel.php';
?>
<br><br>
<hr class="featurette-divider">
<div class="col-lg-15">
<center><h2>Lo más vendido</h2></center>
</div>

    <?php
  include 'php/galeria.php';
?>

<img src="https://www.sodimac.cl/static/MEJORAS/2020/images/banner-especial-seguridad.jpg" class="img-fluid" alt="Responsive image">

<?php
  include 'php/footer.php';
?>

</body>

</html>