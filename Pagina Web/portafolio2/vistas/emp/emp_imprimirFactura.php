<?php
  include '../../clases/configuracion.php';
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
?>
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
	$idVenta= mysqli_real_escape_string($conexion,$_REQUEST['idVenta']??'');
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
		$pdf->stream("Factura_compra_".$idVenta.".pdf");
?>