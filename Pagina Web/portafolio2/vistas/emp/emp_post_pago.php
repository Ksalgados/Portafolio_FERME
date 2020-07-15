<?php
  include '../../clases/configuracion.php';
  include 'emp_carrito.php';
	
	require_once "../../clases/Conexion.php";
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
		$sqlcliente="SELECT a.rut_empresa,
							a.id_user, 
							b.id_user 
					FROM empresa a JOIN usuarios b 
					on a.id_user=b.id_user 
					WHERE b.email='$usuariomail'";
		$resultcliente=mysqli_query($conexion,$sqlcliente);
			
			while($ver=mysqli_fetch_row($resultcliente)):
				if($ver[1]==$ver[2]){
					
					$result=mysqli_query($conexion,"SELECT count(id_pago) as total from factura where id_pago='$id'");
					$data=mysqli_fetch_assoc($result);
					$count=$data['total'];
					
						if($count>0){
							
							?><table style="width:100%"><tbody><tr><th class="text-center">COMPRA YA REALIZADA</th></tr></tbody></table> <?php
							
						}else{
							
							$desctotal=0;	
							$desctotal=0;
							$totalfinal=0;
							$total2=0;
							$iva=0;
											
												foreach($_SESSION['CARRITO'] as $indice=>$producto){
													if($producto['CANTIDAD']>9){
														
														$desc=($producto['PRECIO']*$producto['CANTIDAD'])*0.1;
														
														$total=($producto['PRECIO']*$producto['CANTIDAD']);
													}else{
														
														$desc=0;
														$total=($producto['PRECIO']*$producto['CANTIDAD']);
														
													}
														
														$desctotal=$desctotal+$desc;;
														$totalfinal= $totalfinal+$total;
														
												} 
												$iva=$totalfinal*0.19;
												$total2= $totalfinal-$desctotal;
												
							$query2="INSERT INTO factura(fecha_emision, rut_emp, iva, descuento, total, id_pago) VALUES ('$hoy','$ver[0]', '$iva', '$desctotal','$total2','$id');";
							$resDetalle=mysqli_query($conexion,$query2);
							
							$countfactura=mysqli_query($conexion,"SELECT count(n_factura) as nfactura from factura where id_pago='$id'");
							$databoleta=mysqli_fetch_assoc($countfactura);
							$countfacturar=$databoleta['nfactura'];
							
								if($countfacturar>0){
									
									$sqlfactura="SELECT n_factura
												FROM factura
												where id_pago='$id'";
									$resultfactura=mysqli_query($conexion,$sqlfactura);
									
										while($ver3=mysqli_fetch_row($resultfactura)):
											
												foreach($_SESSION['CARRITO'] as $indice=>$producto){
							
													$name=$producto['NOMBRE'];
													$idp=$producto['ID'];
													$brand=$producto['MARCA'];
													$desc=$producto['DESC'];
													$cant=$producto['CANTIDAD'];
													$price=$producto['PRECIO']*$producto['CANTIDAD'];
													$id = $_GET['collection_id'];
													
													$detalle=$detalle."('".$name."','".$idp."','".$brand."','".$desc."','".$cant."','".$price."','".$ver3[0]."'),"; 
													
													$sqlup="UPDATE producto set stock=stock-'$cant' where id_produc='$idp'";
													$resupdate=mysqli_query($conexion,$sqlup);
												} 
											$detalle=rtrim($detalle,",");
											
											$sql3="INSERT INTO detallefactura(nombre, cod_producto, marca, descripcion, cantidad, precio_cantidad, n_factura)
																	values $detalle;";
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
    <title>Detalle de compra - FERME</title>
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
	$result=mysqli_query($conexion,"SELECT count(id_pago) as total from factura where id_pago='$id'");
	$data=mysqli_fetch_assoc($result);
	$count=$data['total'];
	
	if($count>0){
		$sqlpdf="SELECT a.Nombre as name,
							a.rut_empresa,
							a.direccion,
							a.telefono,
							a.email,
							a.rubro,
							b.n_factura,
							b.fecha_emision,
							b.iva,
							b.descuento,
							b.total,
							b.id_pago,
							c.nombre,
							c.cod_producto,
							c.marca,
							c.cantidad,
							c.precio_cantidad
							
							
					FROM empresa a JOIN factura b
					on  a.rut_empresa =b.rut_emp
					JOIN detallefactura c
					on b.n_factura=c.n_factura
					WHERE b.id_pago='$id'";
		$resultpdf=mysqli_query($conexion,$sqlpdf);
		$rowpdf1=mysqli_fetch_assoc($resultpdf);
		?> 
		<table style="width:45%" align="center">
			<br>
			<tr>
				<th colspan="3" class="text-center">Factura</th>
			</tr>
		
		</table>
		<br>
		<table style="width:45%" align="center">
		
			<tr>
				<th colspan="2" class="text-center">Detalle Empresa</th>
			</tr>
			<tr>
				<th width="50%" class="text-center">Datos de la Empresa</th>
				<th width="50%" class="text-center">Direccion de Entrega</th>
			</tr>
			<tr>
				<td width="50%" class="text-center">Nombre: <?php  echo $rowpdf1['name'];?><br><?php  echo $rowpdf1['rut_empresa'];?><br>Telefono: <?php  echo $rowpdf1['telefono'];?><br>E-mail: <?php  echo $rowpdf1['email'];?><br>Rubro: <?php  echo $rowpdf1['rubro'];?></td>
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
		$sqlpdf="SELECT a.Nombre as name,
							a.rut_empresa,
							a.direccion,
							a.telefono,
							a.email,
							a.rubro,
							b.n_factura,
							b.fecha_emision,
							b.iva,
							b.descuento,
							b.total,
							b.id_pago,
							c.nombre,
							c.cod_producto,
							c.marca,
							c.cantidad,
							c.precio_cantidad
							
							
					FROM empresa a JOIN factura b
					on  a.rut_empresa =b.rut_emp
					JOIN detallefactura c
					on b.n_factura=c.n_factura
					WHERE b.id_pago='$id'";
		$resultpdf=mysqli_query($conexion,$sqlpdf);
			
			while($ver4=mysqli_fetch_assoc($resultpdf)){?>
				
			<?php if($ver4['cantidad']>9){ ?>
				
					<tr>
						<td class="text-center"><?php  echo $ver4['cod_producto'];?></td>
						<td class="text-center">(<?php  echo $ver4['marca'];?>) <?php  echo $ver4['nombre'];?> x<?php  echo $ver4['cantidad'];?><br>
						Unidad: &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						$<?php  echo number_format(($ver4['precio_cantidad']/$ver4['cantidad']),0,",",".");?></td>
						<td align="center">$<?php  echo number_format($ver4['precio_cantidad'],0,",",".");?><br>-$<?php  echo number_format(($ver4['precio_cantidad']*0.1),0,",",".");?></td>
					</tr>
			
		<?php	}else{ ?>
				
					<tr>
						<td class="text-center"><?php  echo $ver4['cod_producto'];?></td>
						<td class="text-center">(<?php  echo $ver4['marca'];?>) <?php  echo $ver4['nombre'];?> x<?php  echo $ver4['cantidad'];?><br>
						Unidad: &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						$<?php  echo number_format(($ver4['precio_cantidad']/$ver4['cantidad']),0,",",".");?></td>
						<td align="center">$<?php  echo number_format($ver4['precio_cantidad'],0,",",".");?><br>-$0</td>
					</tr>
				
		<?php	} ?>
					
				
	<?php	}
		$sqlpdf="SELECT a.Nombre as name,
							a.rut_empresa,
							a.direccion,
							a.telefono,
							a.email,
							a.rubro,
							b.n_factura,
							b.fecha_emision,
							b.iva,
							b.descuento,
							b.total,
							b.id_pago,
							c.nombre,
							c.cod_producto,
							c.marca,
							c.cantidad,
							c.precio_cantidad
							
							
					FROM empresa a JOIN factura b
					on  a.rut_empresa =b.rut_emp
					JOIN detallefactura c
					on b.n_factura=c.n_factura
					WHERE b.id_pago='$id'";
		$resultpdf=mysqli_query($conexion,$sqlpdf);
		$rowpdf=mysqli_fetch_assoc($resultpdf);?>
	
					<tr>
						<td width="20%" class="text-center">Factura N°: <?php  echo $rowpdf['n_factura'];?><br>Pago N°: <?php  echo $rowpdf['id_pago'];?></td>
						<td width="60%" align="center">Fecha de Emisión: <?php  echo $rowpdf['fecha_emision'];?></td>
						<th width="20%" class="text-center">Total Venta:<br>$<?php  echo number_format($rowpdf['total'],0,",",".");?></th>
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
			<form action="emp_inicio.php" method="post" type="hidden">
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
			<form action="emp_imprimirFactura.php?idVenta=<?php echo $id; ?>" method="post" target="_blank" type="hidden" >
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
	$sqlpdf="SELECT a.Nombre as name,
							a.rut_empresa,
							a.direccion,
							a.telefono,
							a.email,
							a.rubro,
							b.n_factura,
							b.fecha_emision,
							b.iva,
							b.descuento,
							b.total,
							b.id_pago,
							c.nombre,
							c.cod_producto,
							c.marca,
							c.cantidad,
							c.precio_cantidad
					FROM empresa a JOIN factura b
					on  a.rut_empresa =b.rut_emp
					JOIN detallefactura c
					on b.n_factura=c.n_factura
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
			<br>
			<tr>
				<th colspan="3" class="text-center">Factura</th>
			</tr>
		</table>
		<br>
		<table style="width:100%" align="center">
			<tr>
				<th colspan="2" class="text-center">Detalle Empresa</th>
			</tr>
			<tr>
				<th width="50%" class="text-center">Datos de la Empresa</th>
				<th width="50%" class="text-center">Direccion de Entrega</th>
			</tr>
			<tr>
				<td width="50%" class="text-center">Nombre: <?php  echo $rowpdf1['name'];?><br><?php  echo $rowpdf1['rut_empresa'];?><br>Telefono: <?php  echo $rowpdf1['telefono'];?><br>E-mail: <?php  echo $rowpdf1['email'];?><br>Rubro: <?php  echo $rowpdf1['rubro'];?></td>
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
	$sqlpdf="SELECT a.Nombre as name,
							a.rut_empresa,
							a.direccion,
							a.telefono,
							a.email,
							a.rubro,
							b.n_factura,
							b.fecha_emision,
							b.iva,
							b.descuento,
							b.total,
							b.id_pago,
							c.nombre,
							c.cod_producto,
							c.marca,
							c.cantidad,
							c.precio_cantidad
					FROM empresa a JOIN factura b
					on  a.rut_empresa =b.rut_emp
					JOIN detallefactura c
					on b.n_factura=c.n_factura
					WHERE b.id_pago='$idVenta'";
	$resultpdf=mysqli_query($conexion,$sqlpdf);
		while($ver4=mysqli_fetch_assoc($resultpdf)){?>
			<?php if($ver4['cantidad']>9){ ?>
				
					<tr>
						<td class="text-center"><?php  echo $ver4['cod_producto'];?></td>
						<td class="text-center">(<?php  echo $ver4['marca'];?>) <?php  echo $ver4['nombre'];?> x<?php  echo $ver4['cantidad'];?><br>
						Unidad: &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						$<?php  echo number_format(($ver4['precio_cantidad']/$ver4['cantidad']),0,",",".");?></td>
						<td align="center">$<?php  echo number_format($ver4['precio_cantidad'],0,",",".");?><br>-$<?php  echo number_format(($ver4['precio_cantidad']*0.1),0,",",".");?></td>
					</tr>
			
		<?php	}else{ ?>
				
					<tr>
						<td class="text-center"><?php  echo $ver4['cod_producto'];?></td>
						<td class="text-center">(<?php  echo $ver4['marca'];?>) <?php  echo $ver4['nombre'];?> x<?php  echo $ver4['cantidad'];?><br>
						Unidad: &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
						$<?php  echo number_format(($ver4['precio_cantidad']/$ver4['cantidad']),0,",",".");?></td>
						<td align="center">$<?php  echo number_format($ver4['precio_cantidad'],0,",",".");?><br>-$0</td>
					</tr>
				
		<?php	} ?>
				
<?php	}
	$sqlpdf="SELECT a.Nombre as name,
							a.rut_empresa,
							a.direccion,
							a.telefono,
							a.email,
							a.rubro,
							b.n_factura,
							b.fecha_emision,
							b.iva,
							b.descuento,
							b.total,
							b.id_pago,
							c.nombre,
							c.cod_producto,
							c.marca,
							c.cantidad,
							c.precio_cantidad
					FROM empresa a JOIN factura b
					on  a.rut_empresa =b.rut_emp
					JOIN detallefactura c
					on b.n_factura=c.n_factura
					WHERE b.id_pago='$idVenta'";
	$resultpdf=mysqli_query($conexion,$sqlpdf);
	$rowpdf=mysqli_fetch_assoc($resultpdf);?>
		<tr>
			<td width="20%" class="text-center">Factura N°: <?php  echo $rowpdf['n_factura'];?><br>Pago N°: <?php  echo $rowpdf['id_pago'];?></td>
			<td width="60%" align="center">Fecha de Emisión: <?php  echo $rowpdf['fecha_emision'];?></td>
			<th width="20%" class="text-center">Total Venta:<br>$<?php  echo number_format($rowpdf['total'],0,",",".");?></th>
		</tr>
		</table> 
<?php $html= ob_get_clean(); ?>
<?php
		include_once "../../dompdf/autoload.inc.php";
		use Dompdf\Dompdf;
		$pdf=new Dompdf();
		$pdf->loadHtml($html);
		$pdf->setPaper("A4","landingscape");
		$pdf->render();
		$content = $pdf->output();
		file_put_contents('../../boletasPDF/Factura_compra_'.$idVenta.'.pdf', $content);
?>