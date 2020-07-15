<?php
  include '../clases/configuracion.php';
	require_once "../clases/Conexion.php";
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
		$pdf->stream("Boleta_compra_".$idVenta.".pdf");
?>