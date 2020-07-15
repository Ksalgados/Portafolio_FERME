<?php
  include '../clases/configuracion.php';
  include '../template/carrito.php';
	
	require_once "../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	
	$detalle="";
	$total=0;
	
	$status = $_GET['collection_status'];
	
	if($status=="approved"){
		
             foreach($_SESSION['CARRITO'] as $indice=>$producto){
					
				$name=$producto['NOMBRE'];
				$idp=$producto['ID'];
				$brand=$producto['MARCA'];
				$desc=$producto['DESC'];
				$cant=$producto['CANTIDAD'];
				$price=$producto['PRECIO'];
				$id = $_GET['collection_id'];
				
				$total=$total+($producto['PRECIO']*$producto['CANTIDAD']); 
			} 
		date_default_timezone_set('America/Santiago');
		$hoy = date("Y-m-d"); 
			
		$usuariomail=$_SESSION['usuario'];
		$sqlcliente="SELECT a.idcliente,
							a.id_user, 
							b.id_user 
					FROM cliente a JOIN usuarios b 
					on a.id_user=b.id_user 
					WHERE b.email='$usuariomail'";
		$resultcliente=mysqli_query($conexion,$sqlcliente);
			
			while($ver=mysqli_fetch_row($resultcliente)):
				if($ver[1]==$ver[2]){
					
					$result=mysqli_query($conexion,"SELECT count(id_pago) as total from boleta where id_pago='$id'");
					$data=mysqli_fetch_assoc($result);
					$count=$data['total'];
					
						if($count>0){
							
							?><table style="width:100%"><tbody><tr><th class="text-center">COMPRA YA REALIZADA</th></tr></tbody></table> <?php
							
						}else{
							
							$query2="INSERT INTO boleta(fecha_emision, idcliente, total, id_pago) VALUES ('$hoy','$ver[0]','$total',$id);";
							$resDetalle=mysqli_query($conexion,$query2);
							
							$countboleta=mysqli_query($conexion,"SELECT count(n_boleta) as nboleta from boleta where id_pago='$id'");
							$databoleta=mysqli_fetch_assoc($countboleta);
							$countboletar=$databoleta['nboleta'];
							
								if($countboletar>0){
									
									$sqlboleta="SELECT n_boleta
												FROM boleta
												where id_pago='$id'";
									$resultboleta=mysqli_query($conexion,$sqlboleta);
									
										while($ver3=mysqli_fetch_row($resultboleta)):
											
												foreach($_SESSION['CARRITO'] as $indice=>$producto){
							
													$name=$producto['NOMBRE'];
													$idp=$producto['ID'];
													$brand=$producto['MARCA'];
													$desc=$producto['DESC'];
													$cant=$producto['CANTIDAD'];
													$price=$producto['PRECIO'];
													$id = $_GET['collection_id'];
													
													$detalle=$detalle."('".$name."','".$idp."','".$brand."','".$desc."','".$cant."','".$price."','".$ver3[0]."'),"; 
													
													$sqlup="UPDATE producto set stock=stock-'$cant' where id_produc='$idp'";
													$resupdate=mysqli_query($conexion,$sqlup);
												} 
											$detalle=rtrim($detalle,",");
											
											$sql3="INSERT INTO detalleboleta(nombre, id, marca, descripcion, cantidad, precio, n_boleta) values $detalle;";
											$resDetalle=mysqli_query($conexion,$sql3);
										
										endwhile;
										?><table style="width:100%"><tbody><tr><th class="text-center">GRACIAS POR COMPRAR EN FERME</th></tr></tbody></table><?php
									
										
										
									
								}else{
									
									echo "no hay boletas";
									
								}
							
						
						}
					
				}elseif($ver[1]!==$ver[2]){
					
					echo "no hay cliente";
					
				}
			
			endwhile;
	}elseif($status=="failure"){
		
		echo "La compra del producto ha fallado";
		
	}elseif($status=="pending"){
		
		echo "El pago se esta verificando";
		
	}else{
		
		echo "no hay pago";
		
	}
	

?>

<!DOCTYPE html>
<head>
    <title>Detalle de Compra - FERME</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	
   
	<style>
		table, th, td {
			border: none;
			border-collapse: collapse;
		}
		th, td {
			border: 1px solid black;
			padding: 15px;
		}
		.button {
		  background-color: #4CAF50;
		  border: none;
		  color: white;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 2px;
		  cursor: pointer;
		}
		.button1 {background-color: #4CAF50;}
		.button2 {background-color: #008CBA;}
		.button3 {background-color: #f44336;}
		.button4 {background-color: #e7e7e7; color: black;}
		.button5 {background-color: #555555;}
	</style>
</head>

<body>

	<?php
	$id = $_GET['collection_id'];
	$result=mysqli_query($conexion,"SELECT count(id_pago) as total from boleta where id_pago='$id'");
	$data=mysqli_fetch_assoc($result);
	$count=$data['total'];
	
	if($count>0){
		$sqlpdf="SELECT a.nombre as name,
							a.apellido,
							a.direccion,
							a.telefono,
							b.n_boleta,
							b.fecha_emision,
							b.total,
							b.id_pago,
							c.nombre,
							c.id,
							c.marca,
							c.cantidad,
							c.precio
							
							
					FROM cliente a JOIN boleta b
					on  a.idcliente=b.idcliente
					JOIN detalleboleta c
					on b.n_boleta=c.n_boleta
					WHERE b.id_pago='$id'";
		$resultpdf=mysqli_query($conexion,$sqlpdf);
		$rowpdf1=mysqli_fetch_assoc($resultpdf);
		?> 
		<table style="width:45%" align="center">
			<br>
			<tr>
				<th colspan="3" class="text-center">Boleta</th>
			</tr>
		
		</table>
		<br>
		<table style="width:45%" align="center">
		
			<tr>
				<th colspan="2" class="text-center">Detalle Cliente</th>
			</tr>
			<tr>
				<th width="50%" class="text-center">Datos del Cliente</th>
				<th width="50%" class="text-center">Direccion de Entrega</th>
			</tr>
			<tr>
				<td width="50%" class="text-center">Nombre: <?php  echo $rowpdf1['name'];?> <?php  echo $rowpdf1['apellido'];?><br>Telefono: <?php  echo $rowpdf1['telefono'];?><br>E-mail: <?php  echo $_SESSION['usuario'];?></td>
				<td width="50%" class="text-center">Direccion: <?php  echo $rowpdf1['direccion'];?><br><br>Advertencia:<br>Si no vives en nuestra comuna, deberas retirar tus productos en tienda</td>
			</tr>
		</table>
		<br>
		<table style="width:45%" align="center">
			<tr>
				<th colspan="3" class="text-center">Detalle Venta</th>
			</tr>
			<tr>
				<th class="text-center">Codigo</th>
				<th class="text-center">Articulo</th>
				<th class="text-center">Precio</th>
			</tr>
		<?php
		$sqlpdf="SELECT a.nombre as name,
							a.apellido,
							a.direccion,
							a.telefono,
							b.n_boleta,
							b.fecha_emision,
							b.total,
							b.id_pago,
							c.nombre,
							c.id,
							c.marca,
							c.cantidad,
							c.precio
							
							
					FROM cliente a JOIN boleta b
					on  a.idcliente=b.idcliente
					JOIN detalleboleta c
					on b.n_boleta=c.n_boleta
					WHERE b.id_pago='$id'";
		$resultpdf=mysqli_query($conexion,$sqlpdf);
			
			while($ver4=mysqli_fetch_assoc($resultpdf)){?>
				
				
					<tr>
						<td class="text-center"><?php  echo $ver4['id'];?></td>
						<td class="text-center">(<?php  echo $ver4['marca'];?>) <?php  echo $ver4['nombre'];?> x<?php  echo $ver4['cantidad'];?></td>
						<td align="center">$<?php  echo $ver4['precio'];?></td>
					</tr>
				
	<?php	}
		$sqlpdf="SELECT a.nombre as name,
							a.apellido,
							a.direccion,
							a.telefono,
							b.n_boleta,
							b.fecha_emision,
							b.total,
							b.id_pago,
							c.nombre,
							c.id,
							c.marca,
							c.cantidad,
							c.precio
							
							
					FROM cliente a JOIN boleta b
					on  a.idcliente=b.idcliente
					JOIN detalleboleta c
					on b.n_boleta=c.n_boleta
					WHERE b.id_pago='$id'";
		$resultpdf=mysqli_query($conexion,$sqlpdf);
		$rowpdf=mysqli_fetch_assoc($resultpdf);?>
	
					<tr>
						<td width="20%" class="text-center">Boleta N°: <?php  echo $rowpdf['n_boleta'];?><br>Pago N°: <?php  echo $rowpdf['id_pago'];?></td>
						<td width="60%" align="center">Fecha de Emisión: <?php  echo $rowpdf['fecha_emision'];?></td>
						<th width="20%" class="text-center">Total Venta:<br>$<?php  echo $rowpdf['total'];?></th>
					</tr>
	</table> 
	<?php
	}else{
		
		echo "No hay boleta";
		
	}
	?>
	<br>
    <div style="width:100%;" align="center">
		<div style="float:left; width:50%">
			<form action="inicio.php" method="post" type="hidden">
				<button
					class="button" 
					type="submit" 
					name="btnAction" 
					value="Empty">
					Regresar
				</button>
			</form>
		</div>
		<div style="float:right; width:50%">
			<form action="imprimirBoleta.php?idVenta=<?php echo $id; ?>" method="post" target="_blank" type="hidden" >
				<button
					class="button button4" 
					type="submit" 
					name="imprimir" 
					value="Imprimir">Imprimir Boleta
				</button>
			</form>
		</div>
	</div>
</body>
</html>

<?php ob_start(); ?>
<!DOCTYPE html>
<head>
    <title>Detalle de compra - FERME</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	
   
	<style>
		table, th, td {
		  border: 1px solid black;
		  border-collapse: collapse;
		}
		th, td {
		  padding: 15px;
		}
	</style>
</head>

<body>


<?php
	$idVenta= $_GET['collection_id'];
	$sqlpdf="SELECT a.nombre as name,
							a.apellido,
							a.direccion,
							a.telefono,
							b.n_boleta,
							b.fecha_emision,
							b.total,
							b.id_pago,
							c.nombre,
							c.id,
							c.marca,
							c.cantidad,
							c.precio,
							d.email
					FROM usuarios d JOIN cliente a
					on d.id_user=a.id_user
					JOIN boleta b
					on  a.idcliente=b.idcliente
					JOIN detalleboleta c
					on b.n_boleta=c.n_boleta
					WHERE b.id_pago='$idVenta'";
	$resultpdf=mysqli_query($conexion,$sqlpdf);
	$rowpdf1=mysqli_fetch_assoc($resultpdf);
?> 
		<table style="width:80%" align="center">
			<tr>
				<th colspan="3" class="text-center" >FERRETERIA FERME</th>
			</tr>
		</table>
		<br>
		<table style="width:100%" align="center">
			<tr>
				<th colspan="3" class="text-center">Boleta</th>
			</tr>
		</table>
		<br>
		<table style="width:100%" align="center">
			<tr>
				<th colspan="2" class="text-center">Detalle Cliente</th>
			</tr>
			<tr>
				<th width="50%" class="text-center">Datos del Cliente</th>
				<th width="50%" class="text-center">Direccion de Entrega</th>
			</tr>
			<tr>
				<td width="50%" class="text-center">Nombre: <?php  echo $rowpdf1['name'];?> <?php  echo $rowpdf1['apellido'];?><br>Telefono: <?php  echo $rowpdf1['telefono'];?><br>E-mail: <?php  echo $rowpdf1['email'];?></td>
				<td width="50%" class="text-center">Direccion: <?php  echo $rowpdf1['direccion'];?><br><br>Advertencia:<br>Si no vives en nuestra comuna, deberas retirar tus productos en tienda</td>
			</tr>
		</table>
		<br>
		<table style="width:100%" align="center">
			<tr>
				<th colspan="3" class="text-center">Detalle Venta</th>
			</tr>
			<tr>
				<th class="text-center">Codigo</th>
				<th class="text-center">Articulo</th>
				<th class="text-center">Precio</th>
			</tr>
<?php
	$sqlpdf="SELECT a.nombre as name,
						a.apellido,
						a.direccion,
						a.telefono,
						b.n_boleta,
						b.fecha_emision,
						b.total,
						b.id_pago,
						c.nombre,
						c.id,
						c.marca,
						c.cantidad,
						c.precio
					FROM cliente a JOIN boleta b
					on  a.idcliente=b.idcliente
					JOIN detalleboleta c
					on b.n_boleta=c.n_boleta
					WHERE b.id_pago='$idVenta'";
	$resultpdf=mysqli_query($conexion,$sqlpdf);
		while($ver4=mysqli_fetch_assoc($resultpdf)){?>
			<tr>
				<td class="text-center"><?php  echo $ver4['id'];?></td>
				<td class="text-center">(<?php  echo $ver4['marca'];?>) <?php  echo $ver4['nombre'];?> x<?php  echo $ver4['cantidad'];?></td>
				<td align="center">$<?php  echo $ver4['precio'];?></td>
			</tr>
				
<?php	}
	$sqlpdf="SELECT a.nombre as name,
						a.apellido,
						a.direccion,
						a.telefono,
						b.n_boleta,
						b.fecha_emision,
						b.total,
						b.id_pago,
						c.nombre,
						c.id,
						c.marca,
						c.cantidad,
						c.precio
					FROM cliente a JOIN boleta b
					on  a.idcliente=b.idcliente
					JOIN detalleboleta c
					on b.n_boleta=c.n_boleta
					WHERE b.id_pago='$idVenta'";
	$resultpdf=mysqli_query($conexion,$sqlpdf);
	$rowpdf=mysqli_fetch_assoc($resultpdf);?>
		<tr>
			<td width="25%" class="text-center">Boleta N°: <?php  echo $rowpdf['n_boleta'];?><br>Pago N°: <?php  echo $rowpdf['id_pago'];?></td>
			<td width="55%" align="center">Fecha de Emisión: <?php  echo $rowpdf['fecha_emision'];?></td>
			<th width="20%" class="text-center">Total Venta:<br>$<?php  echo $rowpdf['total'];?></th>
		</tr>
		</table> 
<?php $html= ob_get_clean(); ?>
<?php
		include_once "../dompdf/autoload.inc.php";
		use Dompdf\Dompdf;
		$pdf=new Dompdf();
		$pdf->loadHtml($html);
		$pdf->setPaper("A4","landingscape");
		$pdf->render();
		$content = $pdf->output();
		file_put_contents('../boletasPDF/Boleta_compra_'.$idVenta.'.pdf', $content);
?>